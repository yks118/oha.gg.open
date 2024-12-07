<?php
namespace Modules\Nexon\MabinogiHeroes\Controllers\Ranking;

use Modules\Nexon\MabinogiHeroes\Controllers\BaseController;

class HallOfHonor extends BaseController
{
    protected string $viewName = 'ranking/hall-of-honor';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_heroes_ranking_hall_of_honor'));
        $this->html->addTitle('랭킹 정보 조회')->addTitle('명예의 전당 랭킹 조회');

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        $cCms = core_config_cms();
        $mRankingHallOfHonor = model(\Modules\Nexon\MabinogiHeroes\Models\RankingHallOfHonor::class);
        $mRankingHallOfHonor
            ->orderBy('score', 'DESC')
            ->orderBy('date', 'DESC')
        ;

        if (isset($data['data']['get']['ranking_type']) && $data['data']['get']['ranking_type'] !== '')
        {
            $mRankingHallOfHonor->where('ranking_type', $data['data']['get']['ranking_type']);
        }

        if (! (isset($data['data']['get'][$cCms->searchName]) && $data['data']['get'][$cCms->searchName]))
        {
            $data['data']['get'][$cCms->searchName] = 'date:' . date('Y-m-d');
        }
        $mRankingHallOfHonor->search($data['data']['get'][$cCms->searchName]);

        $data['data']['total']      = $mRankingHallOfHonor->countAllResults(false);
        $data['data']['list']       = $mRankingHallOfHonor->findAll();

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
