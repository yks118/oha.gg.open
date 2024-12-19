<?php
namespace Modules\Nexon\FirstDescendant\Controllers;

class Main extends BaseController
{
    protected string $viewName = 'main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_first_descendant_main'));

        $data = [
            'data' => [
                'get' => $this->request->getGet(),
            ],
        ];

        if (isset($data['data']['get']['user_name']) && $data['data']['get']['user_name'])
        {
            try
            {
                $api = nexon_first_descendant_services_api();

                if (isset($data['data']['get']['ouid']) && $data['data']['get']['ouid'])
                {
                    $ouid = $data['data']['get']['ouid'];
                    $locale = $this->request->getLocale();

                    $data['data']['response']['basic']              = $api->getUserBasic($ouid);
                    $data['data']['response']['descendant']         = $api->getUserDescendant($ouid);
                    $data['data']['response']['weapon']             = $api->getUserWeapon($ouid, $locale)['weapon'] ?? null;
                    $data['data']['response']['reactor']            = $api->getUserReactor($ouid, $locale);
                    $data['data']['response']['externalComponent']  = $api->getUserExternalComponent($ouid, $locale)['external_component'] ?? null;
                }
                else
                {
                    $cacheKey = 'nexon_first_descendant_getid_' . base64_encode($data['data']['get']['user_name']);
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
