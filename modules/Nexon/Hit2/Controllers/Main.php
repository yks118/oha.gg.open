<?php
namespace Modules\Nexon\Hit2\Controllers;

class Main extends BaseController
{
    protected string $viewName = 'main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_hit2_main'));

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        if (isset($data['data']['get']['character_name']) && $data['data']['get']['character_name'])
        {
            try
            {
                $api = nexon_hit2_services_api();

                if (isset($data['data']['get']['ocid']) && $data['data']['get']['ocid'])
                {
                    $data['data']['response']['basic'] = $api->getCharacterBasic($data['data']['get']['ocid']);
                }
                else
                {
                    $cacheKey = 'nexon_hit2_getid_' . base64_encode($data['data']['get']['character_name']);
                    $response = cache()->get($cacheKey);
                    if (empty($response))
                    {
                        $response = $api->getId($data['data']['get']['character_name']);
                        cache()->save($cacheKey, $response, MINUTE);
                    }

                    return $this->response->redirect(current_url(true)->addQuery('ocid', $response['ocid']));
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
