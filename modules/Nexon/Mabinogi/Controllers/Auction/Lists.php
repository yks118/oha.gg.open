<?php
namespace Modules\Nexon\Mabinogi\Controllers\Auction;

use Modules\Nexon\Mabinogi\Controllers\BaseController;

class Lists extends BaseController
{
    protected string $viewName = 'auction/list';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_auction_list'));
        $this->html->addTitle('경매장 정보 조회')->addTitle('매물 검색');

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        $mAuctionList = model(\Modules\Nexon\Mabinogi\Models\AuctionList::class);
        if (isset($data['data']['get']['keyword']) && $data['data']['get']['keyword'])
        {
            $mAuctionList->search($data['data']['get']['keyword']);
        }

        $mAuctionList
            ->orderBy('auction_price_per_unit', 'ASC')
            ->orderBy('date_auction_expire', 'ASC')
        ;
        $data['data']['list']       = $mAuctionList->paginate(12);
        $data['data']['pagination'] = $mAuctionList->pager->links(template: 'thema');
        $data['data']['total']      = $mAuctionList->pager->getTotal();

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
