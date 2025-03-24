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

        for ($i = 0; $i < 20; $i++)
        {
            $uuids = $mItem
                ->where('updated_at <', date('Y-m-d H:i:s', strtotime('-30 days')))
                ->limit($this->limit)
                ->findColumn('uuid')
            ;

            // $db->transException(true)->transStart(); // 를 사용하면 없는 데이터를 삭제하려고 할때 에러..
            $db->transStart();

            $mAuctionHistory = model(\Modules\Nexon\Mabinogi\Models\AuctionHistory::class);
            $mAuctionHistory
                ->whereIn('item_uuid', $uuids)
                ->delete()
            ;

            $mAuctionHistoryDate = model(\Modules\Nexon\Mabinogi\Models\AuctionHistoryDate::class);
            $mAuctionHistoryDate
                ->where('date !=', '')
                ->whereIn('item_uuid', $uuids)
                ->delete()
            ;

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

            $db->transComplete();

            sleep(1);
        }
    }
}
