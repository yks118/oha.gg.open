<?php
namespace Modules\Nexon\Supervive\Controllers\Meta;

class Rankgrade extends BaseController
{
    protected string $viewName = 'meta/rankgrade';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_supervive_meta_rankgrade'));
        $this->html->addTitle('랭크 등급');

        $data = [
            'data'  => [
                'list'  => nexon_supervive_meta_rankgrade()['rankgrade_img'],
            ],
        ];

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
