<?php
namespace Modules\Nexon\Mabinogi\Controllers\Auction;

use Modules\Nexon\Mabinogi\Controllers\BaseController;

class SalesCommission extends BaseController
{
    protected string $viewName = 'auction/sales-commission';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_auction_sales_commission'));
        $this->html->addTitle('경매장 정보 조회')->addTitle('판매 수수료 계산기');

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        try
        {
            $data['data']['items'] = nexon_mabinogi_sales_commission_api();
        }
        catch (\Exception $e)
        {
            $data['message'] = $e->getMessage();
            return $this->error($data);
        }

        if (isset($data['data']['get']['price'], $data['data']['get']['percent']))
        {
            $price = (int) $data['data']['get']['price'];
            $percent = (int) $data['data']['get']['percent'];
            if ($price > 0 && $percent > 0)
            {
                $data['data']['commission'] = $price * $percent / 100;
                $data['data']['price'] = $price - $data['data']['commission'];
                $data['data']['recommend'] = $data['data']['price'];

                foreach ($data['data']['items'] as $key => $rowItem)
                {
                    $min = $rowItem['min'];
                    $percent = preg_replace('/[^0-9]+/', '', $rowItem['item_name']);

                    $commission = ($data['data']['commission'] * (100 - $percent) / 100) + $min;
                    $data['data']['items'][$key]['commission'] = $commission;
                    $data['data']['items'][$key]['price'] = $price - $commission;

                    $data['data']['recommend'] = max($data['data']['recommend'], $data['data']['items'][$key]['price']);
                }
            }
        }

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
