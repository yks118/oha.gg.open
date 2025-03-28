<?php
namespace Modules\Core\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Navigation implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null): void
    {
        \Modules\Core\Config\Services::navigation()->set([
            [
                'name'  => 'NEXON',
                'href'  => '',
                'child' => [
                    [
                        'name'  => '마비노기',
                        'href'  => site_to('nexon_mabinogi_main'),
                    ],
                    [
                        'name'  => '마비노기 영웅전',
                        'href'  => site_to('nexon_mabinogi_heroes_main'),
                    ],
                    [
                        'name'  => '메이플스토리M',
                        'href'  => site_to('nexon_maple_story_m_main'),
                    ],
                    [
                        'name'  => '바람의나라',
                        'href'  => site_to('nexon_baram_main'),
                    ],
                    [
                        'name'  => '바람의나라: 연',
                        'href'  => site_to('nexon_baram_y_main'),
                    ],
                    [
                        'name'  => '서든어택',
                        'href'  => site_to('nexon_sudden_attack_main'),
                    ],
                    [
                        'name'  => '카트라이더 러쉬플러스',
                        'href'  => site_to('nexon_kart_rider_rush_plus_main'),
                    ],
                    [
                        'name'  => '크레이지 아케이드',
                        'href'  => site_to('nexon_crazy_arcade_main'),
                    ],
                    [
                        'name'  => '퍼스트 디센던트',
                        'href'  => site_to('nexon_first_descendant_main'),
                    ],
                    [
                        'name'  => 'HIT2',
                        'href'  => site_to('nexon_hit2_main'),
                    ],
                    [
                        'name'  => 'SUPERVIVE',
                        'href'  => site_to('nexon_supervive_main'),
                    ],
                    [
                        'name'  => 'V4',
                        'href'  => site_to('nexon_v4_main'),
                    ],
                ],
            ],
            [
                'name'  => 'NCSOFT',
                'href'  => '',
                'child' => [
                    [
                        'name'  => '리니지2M',
                        'href'  => site_to('ncsoft_lineage2m_main'),
                    ],
                ],
            ],
        ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {}
}
