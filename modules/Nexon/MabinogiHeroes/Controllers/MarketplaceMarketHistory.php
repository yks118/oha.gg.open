<?php
namespace Modules\Nexon\MabinogiHeroes\Controllers;

class MarketplaceMarketHistory extends BaseController
{
    protected string $viewName = 'marketplace-market-history';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_heroes_marketplace_market_history'));
        $this->html->addTitle('거래소 정보 조회');

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        if (isset($data['data']['get']['item_name']) && $data['data']['get']['item_name'])
        {
            try
            {
                $api = nexon_mabinogi_heroes_services_api();
                $response = $api->getMarketplaceMarketHistory($data['data']['get']['item_name']);
            }
            catch (\Exception $e)
            {
                $data['message'] = $e->getMessage();
                return $this->error($data);
            }

            krsort($response['item']);
            $data['data']['response'] = $response;
        }

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
