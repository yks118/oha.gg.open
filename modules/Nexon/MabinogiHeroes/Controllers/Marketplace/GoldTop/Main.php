<?php
namespace Modules\Nexon\MabinogiHeroes\Controllers\Marketplace\GoldTop;

use Modules\Nexon\MabinogiHeroes\Controllers\BaseController;

class Main extends BaseController
{
    protected string $viewName = 'marketplace/gold-top/main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_heroes_marketplace_gold_top_main'));
        $this->html
            ->addTitle('거래소 정보 조회')
            ->addTitle('거래량 상위 정보')
        ;

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
                'list'  => [],
            ],
        ];

        if (! isset($data['data']['get']['type']) || empty($data['data']['get']['type']))
        {
            $data['data']['get']['type'] = 'buy';
        }

        if (! isset($data['data']['get']['date_start']) || empty($data['data']['get']['date_start']))
        {
            $data['data']['get']['date_start'] = date('Y-m-d', strtotime('-8 day'));
        }

        if (! isset($data['data']['get']['date_end']) || empty($data['data']['get']['date_end']))
        {
            $data['data']['get']['date_end'] = date('Y-m-d', strtotime('-1 day'));
        }

        $mMarketplaceGoldTop = model(\Modules\Nexon\MabinogiHeroes\Models\MarketplaceGoldTop::class);
        $data['data']['list'] = $mMarketplaceGoldTop
            ->where('date >=', $data['data']['get']['date_start'])
            ->where('date <=', $data['data']['get']['date_end'])
            ->where('type', substr($data['data']['get']['type'], 0, 1))
            ->orderBy('date', 'DESC')
            ->findAll()
        ;

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
