<?php
namespace Modules\Nexon\V4\Filters;

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
                'href'  => site_to('nexon_v4_main'),
            ],
            [
                'name'  => '공식 홈페이지',
                'href'  => '',
                'child' => [
                    [
                        'name'  => 'V4',
                        'href'  => 'https://v4.nexon.com/',
                    ],
                    [
                        'name'  => 'NEXON Open API',
                        'href'  => 'https://openapi.nexon.com/ko/game/v4/?id=9',
                    ],
                ],
            ],
        ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {}
}
