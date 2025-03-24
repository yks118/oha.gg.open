<?php
namespace Modules\Nexon\SuddenAttack\Controllers;

class Main extends BaseController
{
    protected string $viewName = 'main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_sudden_attack_main'));

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        if (isset($data['data']['get']['user_name']) && $data['data']['get']['user_name'])
        {
            $this->html->addTitle($data['data']['get']['user_name']);

            try {
                $api = nexon_sudden_attack_services_api();
                if (isset($data['data']['get']['ouid']) && $data['data']['get']['ouid'])
                {
                    $ouid = $data['data']['get']['ouid'];
                    $data['data']['response']['basic']      = $api->getUserBasic($ouid);
                    $data['data']['response']['rank']       = $api->getUserRank($ouid);
                    $data['data']['response']['tier']       = $api->getUserTier($ouid);
                    $data['data']['response']['recentInfo'] = $api->getUserRecentInfo($ouid);
                }
                else
                {
                    $cacheKey = 'nexon_sudden_attack_getid_' . base64_encode($data['data']['get']['user_name']);
                    $response = cache()->get($cacheKey);
                    if (empty($response))
                    {
                        $response = $api->getId($data['data']['get']['user_name']);
                        cache()->save($cacheKey, $response, MINUTE);
                    }

                    return $this->response->redirect(
                        current_url(true)->addQuery('ouid', $response['ouid'])
                    );
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
