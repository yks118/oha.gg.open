<?php
namespace Modules\Nexon\Mabinogi\Controllers\Auction\History;

use Modules\Nexon\Mabinogi\Controllers\BaseController;

class View extends BaseController
{
    protected string $viewName = 'auction/history/view';

    public function index(string $key, string $value): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_auction_history_main'));
        $this->html->addTitle('경매장 정보 조회')->addTitle('거래 내역 조회')->addTitle($value);

        $data = [
            'data'  => [],
        ];

        $mItem = model(\Modules\Nexon\Mabinogi\Models\Item::class);
        $uuids = [];
        switch ($key)
        {
            case 'item_name':
            case 'item_display_name':
                $data['data']['eItem'] = $mItem->where($key, $value)->findAll(1)[0] ?? null;
                if (is_null($data['data']['eItem']))
                {
                    $this->show404();
                }

                $uuids = $mItem->where($key, $value)->findColumn('uuid');
                break;
            case 'uuid':
                $data['data']['eItem'] = $mItem->where($key, $value)->findAll(1)[0] ?? null;
                $uuids = [$value];
                break;
        }

        $mAuctionHistoryDate = model(\Modules\Nexon\Mabinogi\Models\AuctionHistoryDate::class);
        $data['data']['history']['list'] = $mAuctionHistoryDate
            ->select('date, item_uuid')
            ->selectMin('min', 'min')
            ->selectMax('max', 'max')
            ->selectSum('sum', 'sum')
            ->selectSum('count', 'count')
            ->where('date >=', date('Y-m-d', strtotime('-30 day')))
            ->whereIn('item_uuid', $uuids)
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->findAll(30)
        ;

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
