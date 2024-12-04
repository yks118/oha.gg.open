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
        $mAuctionHistory = model(\Modules\Nexon\Mabinogi\Models\AuctionHistory::class);

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

        $data['data']['history']['list']        = $mAuctionHistory->whereIn('item_uuid', $uuids)->paginate(12);
        $data['data']['history']['pagination']  = $mAuctionHistory->pager->links(template: 'thema');
        $data['data']['history']['total']       = $mAuctionHistory->pager->getTotal();

        $row = $mAuctionHistory
            ->selectMin('auction_price_per_unit', 'min')
            ->selectAvg('auction_price_per_unit', 'avg')
            ->selectMax('auction_price_per_unit', 'max')
            ->whereIn('item_uuid', $uuids)
            ->limit(1)
            ->builder()
            ->get()
            ->getRowArray()
        ;
        $data['data']['history']['min']     = $row['min'];
        $data['data']['history']['avg']     = $row['avg'];
        $data['data']['history']['max']     = $row['max'];

        return $this->render($data);
    }
}
