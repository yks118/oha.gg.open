<?php
namespace Modules\NcSoft\Lineage2M\Filters;

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
                'href'  => site_to('ncsoft_lineage2m_main'),
            ],
            [
                'name'  => '공식 홈페이지',
                'href'  => '',
                'child' => [
                    [
                        'name'  => '리니지2M',
                        'href'  => 'https://lineage2m.plaync.com/',
                    ],
                    [
                        'name'  => 'PLAYNC Developers',
                        'href'  => 'https://developers.plaync.com/apis/l2m/search',
                    ],
                ],
            ],
        ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {}
}
