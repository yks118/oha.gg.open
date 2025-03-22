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

        $mAuctionHistoryStatus = model(\Modules\Nexon\Mabinogi\Models\AuctionHistoryStatus::class);
        $data['data']['listAuctionHistoryStatus'] = $mAuctionHistoryStatus->findAll();

        try
        {
            $data['data']['salesCommission'] = nexon_mabinogi_sales_commission_api();
        }
        catch (\Exception $e)
        {}

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
