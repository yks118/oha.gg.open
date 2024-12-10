<?php
namespace Modules\Nexon\Mabinogi\Filters;

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
                'href'  => site_to('nexon_mabinogi_main'),
            ],
            [
                'name'  => 'NPC 상점 조회',
                'href'  => site_to('nexon_mabinogi_npc_shop_list'),
            ],
            [
                'name'  => '경매장 정보 조회',
                'href'  => '',
                'child' => [
                    [
                        'name'  => '매물 검색',
                        'href'  => site_to('nexon_mabinogi_auction_list'),
                    ],
                    [
                        'name'  => '거래 내역 조회',
                        'href'  => site_to('nexon_mabinogi_auction_history_main'),
                    ],
                    [
                        'name'  => '판매 수수료 계산기',
                        'href'  => site_to('nexon_mabinogi_auction_sales_commission'),
                    ],
                ],
            ],
            [
                'name'  => '거대한 외침의 뿔피리 내역 조회',
                'href'  => site_to('nexon_mabinogi_horn_bugle_world_history'),
            ],
            [
                'name'  => '염색 색상 정보',
                'href'  => site_to('nexon_mabinogi_dye_color'),
            ],
            [
                'name'  => '공식 홈페이지',
                'href'  => '',
                'child' => [
                    [
                        'name'  => '마비노기',
                        'href'  => 'https://mabinogi.nexon.com/',
                    ],
                    [
                        'name'  => 'NEXON Open API',
                        'href'  => 'https://openapi.nexon.com/game/mabinogi/?id=32',
                    ],
                ],
            ],
        ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {}
}
