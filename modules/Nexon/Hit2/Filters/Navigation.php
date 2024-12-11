<?php
namespace Modules\Nexon\Hit2\Filters;

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
                'href'  => site_to('nexon_hit2_main'),
            ],
            [
                'name'  => '공식 홈페이지',
                'href'  => '',
                'child' => [
                    [
                        'name'  => 'HIT2',
                        'href'  => 'https://hit2.nexon.com/',
                    ],
                    [
                        'name'  => 'NEXON Open API',
                        'href'  => 'https://openapi.nexon.com/ko/game/hit2/?id=10',
                    ],
                ],
            ],
        ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {}
}
