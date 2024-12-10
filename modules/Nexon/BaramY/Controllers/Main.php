<?php
namespace Modules\Nexon\BaramY\Controllers;

class Main extends BaseController
{
    protected string $viewName = 'main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_baram_y_main'));

        $cApi = nexon_baram_y_config_api();

        $data = [
            'data'  => [
                'get'           => $this->request->getGet(),
                'serverNames'   => $cApi->serverNames,
            ],
        ];

        if (
            isset($data['data']['get']['server_name'], $data['data']['get']['character_name'])
            && $data['data']['get']['server_name'] && $data['data']['get']['character_name']
        )
        {
            try
            {
                $api = nexon_baram_y_services_api();

                if (isset($data['data']['get']['ocid']) && $data['data']['get']['ocid'])
                {
                    $data['data']['response']['basic']          = $api->getCharacterBasic($data['data']['get']['ocid']);
                    $data['data']['response']['title']          = $api->getCharacterTitle($data['data']['get']['ocid'])['title'] ?? null;
                    $data['data']['response']['titleEquipment'] = $api->getCharacterTitleEquipment($data['data']['get']['ocid'])['title_equipment'] ?? null;
                }
                else
                {
                    $cacheKey = 'nexon_baram_y_getid_' . base64_encode($data['data']['get']['server_name'] . $data['data']['get']['character_name']);
                    $response = cache()->get($cacheKey);
                    if (empty($response))
                    {
                        $response = $api->getId($data['data']['get']['server_name'], $data['data']['get']['character_name']);
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
