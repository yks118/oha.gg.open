<?php
namespace Modules\Nexon\Supervive\Controllers;

class Main extends BaseController
{
    protected string $viewName = 'main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_supervive_main'));

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        if (isset($data['data']['get']['user_name']) && $data['data']['get']['user_name'])
        {
            try
            {
                $api = nexon_supervive_services_api();

                if (isset($data['data']['get']['ouid']) && $data['data']['get']['ouid'])
                {
                    $data['data']['profile'] = $api->getUserProfile($data['data']['get']['ouid']);
                }
                else
                {
                    $cacheKey = 'nexon_supervive_getid_' . base64_encode($data['data']['get']['user_name']);
                    $response = cache()->get($cacheKey);
                    if (empty($response))
                    {
                        $response = $api->getId($data['data']['get']['user_name']);
                        cache()->save($cacheKey, $response, MINUTE);
                    }

                    return $this->response->redirect(current_url(true)->addQuery('ouid', $response['ouid']));
                }
            }
            catch (\Exception $e)
            {
                $data['message'] = $e->getMessage();
                return $this->error($data);
            }
        }

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
