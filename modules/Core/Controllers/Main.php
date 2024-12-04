<?php
namespace Modules\Core\Controllers;

class Main extends BaseController
{
    protected string $viewName = 'main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $data = [];
        $this->navigation->setNowHref(site_to('core_main'));

        if (is_dev())
        {
            helper('core_migration');
            $data['data']['checkModuleUpdate'] = core_migration_check();
        }

        return $this->render($data);
    }
}
