<?php
namespace Modules\Nexon\SuddenAttack\Controllers\Match;

use Modules\Nexon\SuddenAttack\Controllers\BaseController;

class Detail extends BaseController
{
    protected string $viewName = 'match/detail';

    public function index(int $id): \CodeIgniter\HTTP\ResponseInterface|string
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
                ->addTitle($id)
            ;

            try {
                $api = nexon_sudden_attack_services_api();
                $data['data']['response'] = $api->getMatchDetail($id);
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
