<?php
namespace Modules\Nexon\Supervive\Filters;

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
                'href'  => site_to('nexon_supervive_main'),
            ],
            [
                'name'  => '메타 데이터',
                'href'  => '',
                'child' => [
                    [
                        'name'  => '헌터',
                        'href'  => site_to('nexon_supervive_meta_hunter'),
                    ],
                    [
                        'name'  => '아이템',
                        'href'  => site_to('nexon_supervive_meta_item'),
                    ],
                    [
                        'name'  => '랭크 등급',
                        'href'  => site_to('nexon_supervive_meta_rankgrade'),
                    ],
                ],
            ],
            [
                'name'  => '공식 홈페이지',
                'href'  => '',
                'child' => [
                    [
                        'name'  => 'SUPERVIVE',
                        'href'  => 'https://supervive.nexon.com/',
                    ],
                    [
                        'name'  => 'NEXON Open API',
                        'href'  => 'https://openapi.nexon.com/ko/game/supervive/?id=38',
                    ],
                ],
            ],
        ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {}
}
