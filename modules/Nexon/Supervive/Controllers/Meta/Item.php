<?php
namespace Modules\Nexon\Supervive\Controllers\Meta;

class Item extends BaseController
{
    protected string $viewName = 'meta/item';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_supervive_meta_item'));
        $this->html->addTitle('아이템');

        $data = [
            'data'  => [
                'list'  => nexon_supervive_meta_item()['item_img'],
            ],
        ];

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
