<?php
namespace Modules\Nexon\Supervive\Controllers\Match;

use Modules\Nexon\Supervive\Controllers\BaseController;

class Main extends BaseController
{
    protected string $viewName = 'match/main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_supervive_main'));
        $this->html->addTitle('Match');

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        if (
            ! (
                isset($data['data']['get']['user_name'], $data['data']['get']['ouid'])
                && $data['data']['get']['user_name'] && $data['data']['get']['ouid']
            )
        )
        {
            return $this->response->redirect(site_to('nexon_supervive_main'));
        }
        $this->html->addTitle($data['data']['get']['user_name']);

        try
        {
            $api = nexon_supervive_services_api();
            $data['data']['response'] = $api->getMatchHistory(
                $data['data']['get']['ouid'],
                $data['data']['get']['cursor'] ?? null
            );
        }
        catch (\Exception $e)
        {
            $data['message'] = $e->getMessage();
            return $this->error($data);
        }

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
