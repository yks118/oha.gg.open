<?php
namespace Modules\Nexon\SuddenAttack\Controllers\Match;

use Modules\Nexon\SuddenAttack\Controllers\BaseController;

class Main extends BaseController
{
    protected string $viewName = 'match/main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_sudden_attack_main'));

        $cApi = nexon_sudden_attack_config_api();
        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
                'match' => $cApi->match,
            ],
        ];

        if (
            isset($data['data']['get']['user_name'], $data['data']['get']['ouid'])
            && $data['data']['get']['user_name'] && $data['data']['get']['ouid']
        )
        {
            $this->html
                ->addTitle($data['data']['get']['user_name'])
                ->addTitle('매치 정보 조회')
            ;

            try {
                $api = nexon_sudden_attack_services_api();
                $ouid = $data['data']['get']['ouid'];

                if (! (isset($data['data']['get']['mode']) && $data['data']['get']['mode']))
                {
                    $data['data']['get']['mode'] = $data['data']['match']['modes'][0];
                }

                $data['data']['response'] = $api->getMatch($ouid, $data['data']['get']['mode']);
            }
            catch (\Exception $e)
            {
                $data['message'] = $e->getMessage();
                return $this->error($data);
            }
        }
        else
        {
            return $this->response->redirect('nexon_sudden_attack_main');
        }

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
