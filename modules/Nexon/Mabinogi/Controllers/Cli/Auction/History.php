<?php
namespace Modules\Nexon\Mabinogi\Controllers\Cli\Auction;

use Modules\Nexon\Mabinogi\Controllers\BaseController;

class History extends BaseController
{
    private int $limit = 5;

    public function index(): void
    {
        $api = nexon_mabinogi_services_api();

        $mAuctionHistoryStatus = model(\Modules\Nexon\Mabinogi\Models\AuctionHistoryStatus::class);
        $mAuctionHistory = model(\Modules\Nexon\Mabinogi\Models\AuctionHistory::class);
        $mItem = model(\Modules\Nexon\Mabinogi\Models\Item::class);
        $mItemOption = model(\Modules\Nexon\Mabinogi\Models\ItemOption::class);
        $mItemColorPart = model(\Modules\Nexon\Mabinogi\Models\ItemColorPart::class);

        $list = $mAuctionHistoryStatus
            ->where('status', 'f')
            ->orderBy('updated_at', 'ASC')
            ->findAll($this->limit)
        ;
        if (empty($list))
        {
            try
            {
                $cApi = nexon_mabinogi_config_api();
                $dataInsertAuctionHistoryStatus = [];
                foreach ($cApi->auctionItemCategories as $auctionItemCategory)
                {
                    $dataInsertAuctionHistoryStatus[] = [
                        'auction_item_category' => $auctionItemCategory,
                        'date_auction_buy'      => '0000-00-00 00:00:00',
                        'status'                => 'f',
                    ];
                }

                if (count($dataInsertAuctionHistoryStatus) > 0)
                {
                    $mAuctionHistoryStatus->insertBatch($dataInsertAuctionHistoryStatus);
                    $list = $mAuctionHistoryStatus->orderBy('updated_at', 'ASC')->findAll($this->limit);
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
            $mAuctionHistoryStatus
                ->set('status', 'f')
                ->where('status !=', 'f')
                ->where('updated_at <=', date('Y-m-d H:i:s', strtotime('-10 minutes')))
                ->update()
            ;

            $mAuctionHistoryStatus
                ->set('status', 'w')
                ->whereIn('auction_item_category', array_column($list, 'auction_item_category'))
                ->update()
            ;
        }
        catch (\ReflectionException $e)
        {
            die($e->getMessage());
        }

        foreach ($list as $eAuctionHistoryStatus)
        {
            try
            {
                // update status
                $mAuctionHistoryStatus->update($eAuctionHistoryStatus->auction_item_category, [
                    'status'    => 'i',
                ]);

                $nextCursor = '';
                $dataInsertAuctionHistory = [];
                $dataInsertItemColorPart = $dataInsertItemOption = $dataInsertItem = [];

                $auctionItemCategory = $eAuctionHistoryStatus->auction_item_category;
                $checkTime = $eAuctionHistoryStatus->date_auction_buy->getTimestamp();
                $dateAuctionBuy = '0000-00-00 00:00:00';

                /** @var array{md5: array{serialize: string, uuid: string}} $md5s */
                $md5s = [];
                do
                {
                    $response = $api->getAuctionHistory($auctionItemCategory, '', $nextCursor);
                    if (isset($response['auction_history'][0]))
                    {
                        $dateAuctionBuy = date('Y-m-d H:i:s', strtotime($response['auction_history'][0]['date_auction_buy']));
                    }

                    foreach ($response['auction_history'] as $keyItem => $rowItem)
                    {
                        $time = strtotime($rowItem['date_auction_buy']);
                        if ($checkTime >= $time)
                        {
                            $response['next_cursor'] = null;
                            break;
                        }

                        $serialize = serialize($rowItem);
                        $md5 = md5($serialize);
                        $checkItem = false;

                        if (isset($md5s[$md5]) && $md5s[$md5]['serialize'] === $serialize)
                        {
                            $checkItem = true;
                            $dataInsertAuctionHistory[] = [
                                'auction_buy_id'            => $rowItem['auction_buy_id'],
                                'item_uuid'                 => $md5s[$md5]['uuid'],
                                'item_count'                => $rowItem['item_count'],
                                'auction_price_per_unit'    => $rowItem['auction_price_per_unit'],
                                'date_auction_buy'          => date('Y-m-d H:i:s', $time),
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
                                if ($serialize === $eItem->serialize)
                                {
                                    $checkItem = true;
                                    $dataInsertAuctionHistory[] = [
                                        'auction_buy_id'            => $rowItem['auction_buy_id'],
                                        'item_uuid'                 => $eItem->uuid,
                                        'item_count'                => $rowItem['item_count'],
                                        'auction_price_per_unit'    => $rowItem['auction_price_per_unit'],
                                        'date_auction_buy'          => date('Y-m-d H:i:s', $time),
                                    ];
                                }
                            }
                        }

                        if ($checkItem === false)
                        {
                            $uuid = uuid();
                            $md5s[$md5] = [
                                'serialize' => $serialize,
                                'uuid'      => $uuid,
                            ];

                            $dataInsertAuctionHistory[] = [
                                'auction_buy_id'            => $rowItem['auction_buy_id'],
                                'item_uuid'                 => $uuid,
                                'item_count'                => $rowItem['item_count'],
                                'auction_price_per_unit'    => $rowItem['auction_price_per_unit'],
                                'date_auction_buy'          => date('Y-m-d H:i:s', $time),
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
                                        'option_desc'       => $rowItemOption['option_desc'] ?? '', // 마법가루에서 값이 null 로 날라오는 경우가 있음
                                    ];

                                    // Ex. 염색 앰플
                                    if ($rowItemOption['option_type'] === '색상')
                                    {
                                        list($r, $g, $b) = explode(',', $rowItemOption['option_value']);
                                        $dataInsertItemColorPart[$keyItem] = [
                                            'item_uuid' => $uuid,
                                            'a_r'       => $r,
                                            'a_g'       => $g,
                                            'a_b'       => $b,
                                        ];
                                    }
                                    // Ex. 염색된 아이템
                                    elseif (
                                        $rowItemOption['option_type'] === '아이템 색상'
                                        // 반짝이는 색상은 option_desc 에 "(반짝)" 이라고만 되어있음
                                        && $rowItemOption['option_value']
                                    )
                                    {
                                        $part = strtolower(mb_substr($rowItemOption['option_sub_type'], -1));
                                        list($r, $g, $b) = explode(',', $rowItemOption['option_value']);

                                        if (! isset($dataInsertItemColorPart[$keyItem]))
                                        {
                                            $dataInsertItemColorPart[$keyItem] = [
                                                'item_uuid' => $uuid,
                                                'a_r' => '', 'a_g' => '', 'a_b' => '',
                                                'b_r' => '', 'b_g' => '', 'b_b' => '',
                                                'c_r' => '', 'c_g' => '', 'c_b' => '',
                                                'd_r' => '', 'd_g' => '', 'd_b' => '',
                                                'e_r' => '', 'e_g' => '', 'e_b' => '',
                                                'f_r' => '', 'f_g' => '', 'f_b' => '',
                                            ];
                                        }

                                        $dataInsertItemColorPart[$keyItem][$part . '_r'] = $r;
                                        $dataInsertItemColorPart[$keyItem][$part . '_g'] = $g;
                                        $dataInsertItemColorPart[$keyItem][$part . '_b'] = $b;
                                    }

                                    $keyItemOption++;
                                }
                            }
                        }
                    }

                    $nextCursor = $response['next_cursor']; // 마지막에 null 을 리턴
                }
                while ($nextCursor);

                $db = db_connect();
                $db->transStart();
                if (count($dataInsertAuctionHistory) > 0)
                {
                    $mAuctionHistory->insertBatch($dataInsertAuctionHistory);
                }

                if (count($dataInsertItem) > 0)
                {
                    $mItem->insertBatch($dataInsertItem);

                    if (count($dataInsertItemOption) > 0)
                    {
                        $mItemOption->insertBatch($dataInsertItemOption);
                    }

                    if (count($dataInsertItemColorPart) > 0)
                    {
                        $mItemColorPart->insertBatch($dataInsertItemColorPart);
                    }
                }

                $mAuctionHistoryStatus
                    ->set('date_auction_buy', empty($dateAuctionBuy) ? $eAuctionHistoryStatus->date_auction_buy->format('Y-m-d H:i:s') : $dateAuctionBuy)
                    ->where('auction_item_category', $eAuctionHistoryStatus->auction_item_category)
                    ->update()
                ;
                $db->transComplete();

                // update status
                $mAuctionHistoryStatus->update($eAuctionHistoryStatus->auction_item_category, [
                    'status'    => 'f',
                ]);
            }
            catch (\Exception $e)
            {
                die('[' . $e->getLine() . ']' . $e->getMessage());
            }
        }
    }
}
