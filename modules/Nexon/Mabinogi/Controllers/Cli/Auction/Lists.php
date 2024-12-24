<?php
namespace Modules\Nexon\Mabinogi\Controllers\Cli\Auction;

use Modules\Nexon\Mabinogi\Controllers\BaseController;

class Lists extends BaseController
{
    private int $limit = 1;

    public function index(): void
    {
        $api = nexon_mabinogi_services_api();

        $mAuctionListStatus = model(\Modules\Nexon\Mabinogi\Models\AuctionListStatus::class);
        $mAuctionList = model(\Modules\Nexon\Mabinogi\Models\AuctionList::class);
        $mItem = model(\Modules\Nexon\Mabinogi\Models\Item::class);
        $mItemOption = model(\Modules\Nexon\Mabinogi\Models\ItemOption::class);
        $mItemColorPart = model(\Modules\Nexon\Mabinogi\Models\ItemColorPart::class);

        $list = $mAuctionListStatus
            ->where('status', 'f')
            ->orderBy('updated_at', 'ASC')
            ->findAll($this->limit)
        ;
        if (empty($list))
        {
            try
            {
                $cApi = nexon_mabinogi_config_api();
                $dataInsertAuctionListStatus = [];
                foreach ($cApi->auctionItemCategories as $auctionItemCategory)
                {
                    $dataInsertAuctionListStatus[] = [
                        'auction_item_category' => $auctionItemCategory,
                        'status'                => 'f',
                    ];
                }

                if (count($dataInsertAuctionListStatus) > 0)
                {
                    $mAuctionListStatus->insertBatch($dataInsertAuctionListStatus);
                    $list = $mAuctionListStatus
                        ->orderBy('updated_at', 'ASC')
                        ->findAll($this->limit)
                    ;
                }
                else
                {
                    die('\Modules\Nexon\Mabinogi\Config\Api::$auctionItemCategories 데이터가 비어있습니다.');
                }
            }
            catch (\ReflectionException $e)
            {
                die($e->getMessage());
            }
        }

        try
        {
            $mAuctionListStatus
                ->set('status', 'f')
                ->where('status !=', 'f')
                ->where('updated_at <=', date('Y-m-d H:i:s', strtotime('-10 minutes')))
                ->update()
            ;

            $mAuctionListStatus
                ->set('status', 'w')
                ->whereIn('auction_item_category', array_column($list, 'auction_item_category'))
                ->update()
            ;
        }
        catch (\ReflectionException $e)
        {
            die($e->getMessage());
        }

        foreach ($list as $eAuctionListStatus)
        {
            try
            {
                // update status
                $mAuctionListStatus->update($eAuctionListStatus->auction_item_category, [
                    'status'    => 'i',
                ]);

                $keyAuctionList = 1;
                $nextCursor = '';
                $dataInsertAuctionList = [];
                $dataInsertItemColorPart = $dataInsertItemOption = $dataInsertItem = [];

                $auctionItemCategory = $eAuctionListStatus->auction_item_category;

                /** @var array{md5: array{serialize: string, uuid: string}} $md5s */
                $md5s = [];
                do
                {
                    $response = $api->getAuctionList($auctionItemCategory, '', $nextCursor);

                    foreach ($response['auction_item'] as $rowItem)
                    {
                        $rowItemTmp = $rowItem;
                        unset($rowItemTmp['item_count']);
                        unset($rowItemTmp['auction_price_per_unit']);
                        unset($rowItemTmp['date_auction_expire']);

                        $serialize = serialize($rowItemTmp);
                        $md5 = md5($serialize);
                        $checkItem = false;

                        $time = strtotime($rowItem['date_auction_expire']);
                        $dateTime = date('Y-m-d H:i:s', $time);

                        if (isset($md5s[$md5]) && $md5s[$md5]['serialize'] === $serialize)
                        {
                            $checkItem = true;
                            $dataInsertAuctionList[] = [
                                'auction_item_category'     => $auctionItemCategory,
                                'id'                        => $keyAuctionList,
                                'item_uuid'                 => $md5s[$md5]['uuid'],
                                'item_count'                => $rowItem['item_count'],
                                'auction_price_per_unit'    => $rowItem['auction_price_per_unit'],
                                'date_auction_expire'       => $dateTime,
                            ];
                        }
                        else
                        {
                            $list = $mItem
                                ->where('md5', $md5)
                                ->findAll()
                            ;
                            foreach ($list as $eItem)
                            {
                                $md5s[$md5] = [
                                    'serialize' => $serialize,
                                    'uuid'      => $eItem->uuid,
                                ];

                                if ($serialize === $eItem->serialize)
                                {
                                    $checkItem = true;
                                    $dataInsertAuctionList[] = [
                                        'auction_item_category'     => $auctionItemCategory,
                                        'id'                        => $keyAuctionList,
                                        'item_uuid'                 => $eItem->uuid,
                                        'item_count'                => $rowItem['item_count'],
                                        'auction_price_per_unit'    => $rowItem['auction_price_per_unit'],
                                        'date_auction_expire'       => $dateTime,
                                    ];
                                }
                            }
                        }

                        if ($checkItem === false)
                        {
                            $data = nexon_mabinogi_insert_item_data($rowItem, $serialize, $md5, $keyAuctionList);
                            $uuid = $data['uuid'];
                            $dataInsertItem[] = $data['item'];
                            $dataInsertItemOption = array_merge($dataInsertItemOption, $data['itemOption']);
                            $dataInsertItemColorPart = array_merge($dataInsertItemColorPart, $data['itemColorPart']);

                            $dataInsertAuctionList[] = [
                                'auction_item_category'     => $auctionItemCategory,
                                'id'                        => $keyAuctionList,
                                'item_uuid'                 => $uuid,
                                'item_count'                => $rowItem['item_count'],
                                'auction_price_per_unit'    => $rowItem['auction_price_per_unit'],
                                'date_auction_expire'       => $dateTime,
                            ];

                            /*
                            $uuid = uuid();
                            $md5s[$md5] = [
                                'serialize' => $serialize,
                                'uuid'      => $uuid,
                            ];

                            $dataInsertAuctionList[] = [
                                'auction_item_category'     => $auctionItemCategory,
                                'id'                        => $keyAuctionList,
                                'item_uuid'                 => $uuid,
                                'item_count'                => $rowItem['item_count'],
                                'auction_price_per_unit'    => $rowItem['auction_price_per_unit'],
                                'date_auction_expire'       => $dateTime,
                            ];

                            $dataInsertItem[] = [
                                'uuid'              => $uuid,
                                'md5'               => $md5,
                                'serialize'         => $serialize,
                                'item_name'         => $rowItem['item_name'],
                                'item_display_name' => $rowItem['item_display_name'],
                            ];

                            if (is_array($rowItem['item_option']))
                            {
                                $keyItemOption = 1;
                                foreach ($rowItem['item_option'] as $rowItemOption)
                                {
                                    $dataInsertItemOption[] = [
                                        'item_uuid'         => $uuid,
                                        'id'                => $keyItemOption,
                                        'option_type'       => $rowItemOption['option_type'],
                                        'option_sub_type'   => $rowItemOption['option_sub_type'] ?? '',
                                        'option_value'      => $rowItemOption['option_value'],
                                        'option_value2'     => $rowItemOption['option_value2'],
                                        'option_desc'       => $rowItemOption['option_desc'] ?? '',
                                    ];

                                    // Ex. 염색 앰플
                                    if ($rowItemOption['option_type'] === '색상')
                                    {
                                        list($r, $g, $b) = explode(',', $rowItemOption['option_value']);
                                        $dataInsertItemColorPart[$keyAuctionList] = [
                                            'item_uuid' => $uuid,
                                            'a_r'       => $r,
                                            'a_g'       => $g,
                                            'a_b'       => $b,
                                        ];
                                    }
                                    // Ex. 염색된 아이템
                                    elseif ($rowItemOption['option_type'] === '아이템 색상' && $rowItemOption['option_value'])
                                    {
                                        $part = strtolower(mb_substr($rowItemOption['option_sub_type'], -1));
                                        list($r, $g, $b) = explode(',', $rowItemOption['option_value']);
                                        if (! isset($dataInsertItemColorPart[$keyAuctionList]))
                                        {
                                            $dataInsertItemColorPart[$keyAuctionList] = [
                                                'item_uuid' => $uuid,
                                                'a_r' => '', 'a_g' => '', 'a_b' => '',
                                                'b_r' => '', 'b_g' => '', 'b_b' => '',
                                                'c_r' => '', 'c_g' => '', 'c_b' => '',
                                                'd_r' => '', 'd_g' => '', 'd_b' => '',
                                                'e_r' => '', 'e_g' => '', 'e_b' => '',
                                                'f_r' => '', 'f_g' => '', 'f_b' => '',
                                            ];
                                        }

                                        $dataInsertItemColorPart[$keyAuctionList][$part . '_r'] = $r;
                                        $dataInsertItemColorPart[$keyAuctionList][$part . '_g'] = $g;
                                        $dataInsertItemColorPart[$keyAuctionList][$part . '_b'] = $b;
                                    }

                                    $keyItemOption++;
                                }
                            }
                             */
                        }

                        $keyAuctionList++;
                    }

                    $nextCursor = $response['next_cursor']; // 마지막에 null 을 리턴
                }
                while ($nextCursor);

                db_connect()->transStart();
                if (count($dataInsertAuctionList) > 0)
                {
                    $mAuctionList->where('auction_item_category', $auctionItemCategory)->delete();
                    $mAuctionList->insertBatch($dataInsertAuctionList);
                }

                if (count($dataInsertItem) > 0)
                {
                    $mItem->insertBatch($dataInsertItem);

                    if (count($dataInsertItemOption) > 0)
                    {
                        $mItemOption->insertBatch($dataInsertItemOption);

                        if (count($dataInsertItemColorPart) > 0)
                        {
                            $mItemColorPart->insertBatch($dataInsertItemColorPart);
                        }
                    }
                }
                db_connect()->transComplete();

                // update status
                $mAuctionListStatus->update($eAuctionListStatus->auction_item_category, [
                    'status'    => 'f',
                ]);
            }
            catch (\Exception $e)
            {
                die('[' . $e->getLine() . '] ' . $e->getMessage());
            }
        }
    }
}
