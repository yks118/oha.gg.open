<?php
namespace Modules\Nexon\MabinogiHeroes\Controllers\Ranking;

use Modules\Nexon\MabinogiHeroes\Controllers\BaseController;

class RealTime extends BaseController
{
    protected string $viewName = 'ranking/real-time';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_heroes_ranking_real_time'));
        $this->html->addTitle('랭킹 정보 조회')->addTitle('실시간 랭킹 조회');

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        $mRankingRealTime = model(\Modules\Nexon\MabinogiHeroes\Models\RankingRealTime::class);
        $mRankingRealTime->orderBy('score', 'DESC');

        if (isset($data['data']['get']['ranking_type']) && $data['data']['get']['ranking_type'] !== '')
        {
            $mRankingRealTime->where('ranking_type', $data['data']['get']['ranking_type']);
        }

        if (isset($data['data']['get']['keyword']) && $data['data']['get']['keyword'])
        {
            $mRankingRealTime->search($data['data']['get']['keyword']);
        }

        $data['data']['list']       = $mRankingRealTime->paginate(12);
        $data['data']['pagination'] = $mRankingRealTime->pager->links(template: 'thema');
        $data['data']['total']      = $mRankingRealTime->pager->getTotal();

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
