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

        $mAuctionList = model(\Modules\Nexon\Mabinogi\Models\AuctionList::class);
        $keyword = $data['data']['get']['keyword'] ?? '';
        if ($keyword)
        {
            $mAuctionList->search($data['data']['get']['keyword']);
        }

        if (! (isset($data['data']['get']['page']) && $data['data']['get']['page'] > 0))
        {
            $data['data']['get']['page'] = 1;
        }

        $mAuctionList
            ->orderBy('auction_price_per_unit', 'ASC')
            ->orderBy('date_auction_expire', 'ASC')
        ;
        /* 데이터가 많아지면 select count 이슈가 존재
        $data['data']['list']       = $mAuctionList->paginate(12);
        $data['data']['pagination'] = $mAuctionList->pager->links(template: 'thema');
        $data['data']['total']      = $mAuctionList->pager->getTotal();
         */
        $offset = ($data['data']['get']['page'] - 1) * $this->limit;
        $data['data']['list'] = $mAuctionList->findAll($this->limit, $offset);

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
