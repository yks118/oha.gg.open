<?php
namespace Modules\Nexon\MapleStoryM\Controllers;

class Main extends BaseController
{
    protected string $viewName = 'main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_maple_story_m_main'));

        $data = [
            'data'  => [],
        ];

        try
        {
            $api = nexon_maple_story_m_services_api();
            $data['data']['response']['notice'] = $api->getNotice()['notice'] ?? null;
            $data['data']['response']['patch']  = $api->getNoticePatch()['patch_notice'] ?? null;
            $data['data']['response']['event']  = $api->getNoticeEvent()['event_notice'] ?? null;
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
