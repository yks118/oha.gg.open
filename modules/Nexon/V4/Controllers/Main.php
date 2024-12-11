<?php
namespace Modules\Nexon\V4\Controllers;

class Main extends BaseController
{
    protected string $viewName = 'main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_v4_main'));

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        if (isset($data['data']['get']['character_name']) && $data['data']['get']['character_name'])
        {
            try
            {
                $api = nexon_v4_services_api();

                if (isset($data['data']['get']['ocid']) && $data['data']['get']['ocid'])
                {
                    $ocid = $data['data']['get']['ocid'];
                    $data['data']['response']['basic']          = $api->getCharacterBasic($ocid);
                    $data['data']['response']['honor']          = $api->getCharacterHonor($ocid)['honor'];
                    $data['data']['response']['honorEquipment'] = $api->getCharacterHonorEquipment($ocid)['honor_equipment'];
                }
                else
                {
                    $cacheKey = 'nexon_v4_getid_' . base64_encode($data['data']['get']['character_name']);
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
