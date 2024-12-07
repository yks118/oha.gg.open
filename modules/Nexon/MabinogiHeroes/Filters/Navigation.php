<?php
namespace Modules\Nexon\MabinogiHeroes\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Navigation implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null): void
    {
        \Modules\Core\Config\Services::navigation()->set([
            [
                'name'  => '대시보드',
                'href'  => site_to('nexon_mabinogi_heroes_main'),
            ],
            [
                'name'  => '캐릭터 정보 조회',
                'href'  => site_to('nexon_mabinogi_heroes_character_main'),
            ],
            [
                'name'  => '인챈트 정보 조회',
                'href'  => site_to('nexon_mabinogi_heroes_meta_enchant'),
            ],
            [
                'name'  => '거래소 정보 조회',
                'href'  => site_to('nexon_mabinogi_heroes_marketplace_market_history'),
            ],
            [
                'name'  => '랭킹 정보 조회',
                'href'  => '',
                'child' => [
                    [
                        'name'  => '명예의 전당 랭킹 조회',
                        'href'  => site_to('nexon_mabinogi_heroes_ranking_hall_of_honor'),
                    ],
                    [
                        'name'  => '실시간 랭킹 조회',
                        'href'  => site_to('nexon_mabinogi_heroes_ranking_real_time'),
                    ],
                ],
            ],
        ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {}
}
