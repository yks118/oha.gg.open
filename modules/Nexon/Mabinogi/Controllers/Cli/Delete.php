<?php
namespace Modules\Nexon\Mabinogi\Controllers\Cli;

use Modules\Nexon\Mabinogi\Controllers\BaseController;

class Delete extends BaseController
{
    private int $limit = 1000;

    public function index(): void
    {
        $db = db_connect();
        $mItem = model(\Modules\Nexon\Mabinogi\Models\Item::class);
        $dateCheck = date('Y-m-d H:i:s', strtotime('-30 days'));

        for ($i = 0; $i < 1; $i++)
        {
            $uuids = $mItem
                ->where('updated_at <', $dateCheck)
                ->orderBy('updated_at', 'ASC')
                ->limit($this->limit)
                ->findColumn('uuid')
            ;

            try
            {
                $db->transException(true)->transStart();

                $mAuctionHistory = model(\Modules\Nexon\Mabinogi\Models\AuctionHistory::class);
                $mAuctionHistory
                    ->where('date_auction_buy <', $dateCheck)
                    // ->whereIn('item_uuid', $uuids)
                    ->delete()
                ;

                $mAuctionHistoryDate = model(\Modules\Nexon\Mabinogi\Models\AuctionHistoryDate::class);
                $mAuctionHistoryDate
                    ->where('date <', $dateCheck)
                    // ->whereIn('item_uuid', $uuids)
                    ->delete()
                ;

                if (count($uuids) > 0)
                {
                    $mItemColorPart = model(\Modules\Nexon\Mabinogi\Models\ItemColorPart::class);
                    $mItemColorPart
                        ->whereIn('item_uuid', $uuids)
                        ->delete()
                    ;

                    $mItemOption = model(\Modules\Nexon\Mabinogi\Models\ItemOption::class);
                    $mItemOption
                        ->whereIn('item_uuid', $uuids)
                        ->delete()
                    ;

                    $mItem
                        ->whereIn('uuid', $uuids)
                        ->delete()
                    ;
                }

                $db->transComplete();
            }
            catch (\Exception $e)
            {
                echo $e->getMessage() . PHP_EOL;
                break;
            }
        }
    }
}
