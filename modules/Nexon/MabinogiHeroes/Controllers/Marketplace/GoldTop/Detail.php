<?php
namespace Modules\Nexon\MabinogiHeroes\Controllers\Marketplace\GoldTop;

use Modules\Nexon\MabinogiHeroes\Controllers\BaseController;

class Detail extends BaseController
{
    protected string $viewName = 'marketplace/gold-top/detail';

    public function index(string $date): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_heroes_marketplace_gold_top_main'));
        $this->html
            ->addTitle('거래소 정보 조회')
            ->addTitle('거래량 상위 정보')
            ->addTitle($date)
        ;

        $data = [
            'data'  => [
                'list'  => [],
            ],
        ];

        $mMarketplaceGoldTop = model(\Modules\Nexon\MabinogiHeroes\Models\MarketplaceGoldTop::class);
        $data['data']['list'] = $mMarketplaceGoldTop
            ->where('date', $date)
            ->whereIn('type', ['b', 's'])
            ->findAll()
        ;

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
