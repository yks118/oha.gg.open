<?php
namespace Modules\Nexon\Supervive\Controllers\Meta;

class Hunter extends BaseController
{
    protected string $viewName = 'meta/hunter';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_supervive_meta_hunter'));
        $this->html->addTitle('헌터');

        $data = [
            'data'  => [
                'list'  => nexon_supervive_meta_hunter()['hunter_img'],
            ],
        ];

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
