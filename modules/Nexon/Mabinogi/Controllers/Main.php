<?php
namespace Modules\Nexon\Mabinogi\Controllers;

class Main extends BaseController
{
    protected string $viewName = 'main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_main'));

        $data = [
            'data'  => [],
        ];

        $mAuctionListStatus = model(\Modules\Nexon\Mabinogi\Models\AuctionListStatus::class);
        $data['data']['listAuctionListStatus'] = $mAuctionListStatus->findAll();

        $mAuctionHistoryStatus = model(\Modules\Nexon\Mabinogi\Models\AuctionHistoryStatus::class);
        $data['data']['listAuctionHistoryStatus'] = $mAuctionHistoryStatus->findAll();

        $mNpcShopList = model(\Modules\Nexon\Mabinogi\Models\NpcShopList::class);
        $data['data']['eNpcShopList'] = $mNpcShopList->findAll()[0] ?? null;

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
