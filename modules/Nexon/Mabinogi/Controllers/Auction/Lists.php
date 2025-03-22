<?php
namespace Modules\Nexon\Mabinogi\Controllers\Auction;

use Modules\Nexon\Mabinogi\Controllers\BaseController;

class Lists extends BaseController
{
    protected string $viewName = 'auction/list';

    private int $limit = 12;

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_auction_list'));
        $this->html
            ->addTitle('경매장 정보 조회')
            ->addTitle('매물 검색')
        ;

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        if (
            isset($data['data']['get']['auction_item_category'], $data['data']['get']['keyword'])
            && $data['data']['get']['keyword']
        )
        {
            try
            {
                $api = nexon_mabinogi_services_api();
                if (empty($data['data']['get']['auction_item_category']))
                {
                    $data['data']['response'] = $api->getAuctionKeywordSearch($data['data']['get']['keyword']);
                }
                else
                {
                    $data['data']['response'] = $api->getAuctionList($data['data']['get']['auction_item_category'], $data['data']['get']['keyword']);
                }
            }
            catch (\Exception $e)
            {
                $data['message'] = $e->getMessage();
                return $this->error($data);
            }
        }

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
