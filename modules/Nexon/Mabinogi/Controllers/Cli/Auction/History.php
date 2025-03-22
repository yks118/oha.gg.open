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
        $mAuctionHistoryDate = model(\Modules\Nexon\Mabinogi\Models\AuctionHistoryDate::class);
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
                $dataInsertAuctionHistoryDate = $dataInsertAuctionHistory = [];
                $dataInsertItemColorPart = $dataInsertItemOption = $dataInsertItem = [];

                $auctionItemCategory = $eAuctionHistoryStatus->auction_item_category;
                $checkTime = $eAuctionHistoryStatus->date_auction_buy->getTimestamp();
                $dateAuctionBuy = $checkDateTime = $eAuctionHistoryStatus->date_auction_buy->format('Y-m-d H:i:s');

                /** @var array{md5: array{serialize: string, uuid: string}} $md5s */
                $md5s = [];
                do
                {
                    $response = $api->getAuctionHistory($auctionItemCategory, '', $nextCursor);
                    if (isset($response['auction_history'][0]) && $dateAuctionBuy === $checkDateTime)
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

                        $dateTime = date('Y-m-d H:i:s', $time);
                        $date = date('Y-m-d', $time);

                        $rowItemTmp = $rowItem;
                        unset($rowItemTmp['auction_buy_id']);
                        unset($rowItemTmp['item_count']);
                        unset($rowItemTmp['auction_price_per_unit']);
                        unset($rowItemTmp['date_auction_buy']);

                        $serialize = serialize($rowItemTmp);
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
                                'date_auction_buy'          => $dateTime,
                            ];
                        }
                        else
                        {
                            $list = $mItem->md5FindAll($md5);
                            foreach ($list as $eItem)
                            {
                                $md5s[$md5] = [
                                    'serialize' => $eItem->serialize,
                                    'uuid'      => $eItem->uuid,
                                ];

                                if ($serialize === $eItem->serialize)
                                {
                                    if ($checkItem)
                                    {
                                        nexon_mabinogi_delete_item($eItem->uuid);
                                    }
                                    else
                                    {
                                        $checkItem = true;
                                        $dataInsertAuctionHistory[] = [
                                            'auction_buy_id'            => $rowItem['auction_buy_id'],
                                            'item_uuid'                 => $eItem->uuid,
                                            'item_count'                => $rowItem['item_count'],
                                            'auction_price_per_unit'    => $rowItem['auction_price_per_unit'],
                                            'date_auction_buy'          => $dateTime,
                                        ];
                                    }
                                }
                            }
                        }

                        if ($checkItem === false)
                        {
                            $data = nexon_mabinogi_insert_item_data($rowItem, $serialize, $md5, $keyItem);
                            $uuid = $data['uuid'];
                            $dataInsertItem[] = $data['item'];
                            $dataInsertItemOption = array_merge($dataInsertItemOption, $data['itemOption']);
                            $dataInsertItemColorPart = array_merge($dataInsertItemColorPart, $data['itemColorPart']);

                            $dataInsertAuctionHistory[] = [
                                'auction_buy_id'            => $rowItem['auction_buy_id'],
                                'item_uuid'                 => $uuid,
                                'item_count'                => $rowItem['item_count'],
                                'auction_price_per_unit'    => $rowItem['auction_price_per_unit'],
                                'date_auction_buy'          => $dateTime,
                            ];

                            if (! isset($md5s[$md5]))
                            {
                                $md5s[$md5] = [
                                    'serialize' => $serialize,
                                    'uuid'      => $uuid,
                                ];
                            }
                        }

                        // history date
                        $keyHistoryDate = $md5s[$md5]['uuid'] . '_' . $date;
                        if (! isset($dataInsertAuctionHistoryDate[$keyHistoryDate]))
                        {
                            $dataInsertAuctionHistoryDate[$keyHistoryDate] = [
                                'date'      => date('Y-m-d', $time),
                                'item_uuid' => $md5s[$md5]['uuid'],
                                'min'       => $rowItem['auction_price_per_unit'],
                                'max'       => $rowItem['auction_price_per_unit'],
                                'sum'       => $rowItem['auction_price_per_unit'] * $rowItem['item_count'],
                                'count'     => $rowItem['item_count'],
                            ];
                        }
                        else
                        {
                            $dataInsertAuctionHistoryDate[$keyHistoryDate]['min']    = min($dataInsertAuctionHistoryDate[$keyHistoryDate]['min'], $rowItem['auction_price_per_unit']);
                            $dataInsertAuctionHistoryDate[$keyHistoryDate]['max']    = max($dataInsertAuctionHistoryDate[$keyHistoryDate]['max'], $rowItem['auction_price_per_unit']);
                            $dataInsertAuctionHistoryDate[$keyHistoryDate]['sum']   += $rowItem['auction_price_per_unit'] * $rowItem['item_count'];
                            $dataInsertAuctionHistoryDate[$keyHistoryDate]['count'] += $rowItem['item_count'];
                        }
                    }

                    $nextCursor = $response['next_cursor']; // 마지막에 null 을 리턴
                }
                while ($nextCursor);

                $db = db_connect();
                $db->transException(true)->transStart();
                if (count($dataInsertAuctionHistory) > 0)
                {
                    $mAuctionHistory->insertBatch($dataInsertAuctionHistory);

                    $query = '
                        INSERT INTO
                            `' . $db->prefixTable($mAuctionHistoryDate->builder()->getTable()) . '`
                            (`date`, `item_uuid`, `min`, `max`, `sum`, `count`)
                        VALUES
                            (' . implode('), (', array_map(function($row) { return '"' . implode('", "', $row) . '"'; }, $dataInsertAuctionHistoryDate)) . ')
                        ON DUPLICATE KEY UPDATE
                            `min`   = `min` + VALUES(`min`),
                            `max`   = `max` + VALUES(`max`),
                            `sum`   = `sum` + VALUES(`sum`),
                            `count` = `count` + VALUES(`count`)
                    ';
                    $db->query($query);
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

                if (count($md5s) > 0)
                {
                    $mItem->builder()->upsertBatch($md5s);
                }

                $mAuctionHistoryStatus
                    ->set('date_auction_buy', $dateAuctionBuy)
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
                // update status
                $mAuctionHistoryStatus->update($eAuctionHistoryStatus->auction_item_category, [
                    'status'    => 'f',
                ]);

                die('[' . __FILE__ . '][' . $e->getLine() . ']' . $e->getMessage() . PHP_EOL);
            }
        }
    }
}
