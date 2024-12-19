<?php
namespace Modules\Nexon\Mabinogi\Controllers\Auction\History;

use Modules\Nexon\Mabinogi\Controllers\BaseController;

class Main extends BaseController
{
    protected string $viewName = 'auction/history/main';

    private int $limit = 12;

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_auction_history_main'));
        $this->html
            ->addTitle('경매장 정보 조회')
            ->addTitle('거래 내역 조회')
        ;

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        $mAuctionHistory = model(\Modules\Nexon\Mabinogi\Models\AuctionHistory::class);
        if (isset($data['data']['get']['keyword']) && $data['data']['get']['keyword'])
        {
            $mAuctionHistory->search($data['data']['get']['keyword']);
        }

        if (! (isset($data['data']['get']['page']) && $data['data']['get']['page'] > 0))
        {
            $data['data']['get']['page'] = 1;
        }

        $mAuctionHistory->orderBy('date_auction_buy', 'DESC');
        /* 데이터가 많아지면 select count 이슈가 존재
        $data['data']['list']       = $mAuctionHistory->paginate(12);
        $data['data']['pagination'] = $mAuctionHistory->pager->links(template: 'thema');
        $data['data']['total']      = $mAuctionHistory->pager->getTotal();
         */
        $offset = ($data['data']['get']['page'] - 1) * $this->limit;
        $data['data']['list'] = $mAuctionHistory->findAll($this->limit, $offset);

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
