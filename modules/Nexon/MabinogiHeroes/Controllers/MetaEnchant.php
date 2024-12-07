<?php
namespace Modules\Nexon\MabinogiHeroes\Controllers;

class MetaEnchant extends BaseController
{
    protected string $viewName = 'meta-enchant';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_heroes_meta_enchant'));
        $this->html->addTitle('인챈트 정보 조회');

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        $cCms = core_config_cms();
        $mMetaEnchant = model(\Modules\Nexon\MabinogiHeroes\Models\MetaEnchant::class);

        if (isset($data['data']['get']['type']) && $data['data']['get']['type'] !== '')
        {
            $mMetaEnchant->where('type', $data['data']['get']['type']);
        }

        if (isset($data['data']['get']['name']) && $data['data']['get']['name'])
        {
            $mMetaEnchant->where('name', $data['data']['get']['name']);
        }

        if (isset($data['data']['get'][$cCms->searchName]) && $data['data']['get'][$cCms->searchName])
        {
            $mMetaEnchant->search($data['data']['get'][$cCms->searchName]);
        }

        $total = $mMetaEnchant->countAllResults(false);
        if (
            $total <= 0
            && isset($data['data']['get']['type'], $data['data']['get']['name'])
            && $data['data']['get']['type'] !== ''
            && $data['data']['get']['name']
        )
        {
            try
            {
                $api = nexon_mabinogi_heroes_services_api();
                $response = $api->getMetaEnchant($data['data']['get']['type'], $data['data']['get']['name']);
                $mMetaEnchant
                    ->set('type', $data['data']['get']['type'])
                    ->set('name', $data['data']['get']['name'])
                    ->set('grade', $response['enchant_grade'])
                    ->set('available_slot_name', $response['enchant_available_slot_name'])
                    ->set('stat', $response['enchant_stat'])
                    ->insert()
                ;

                return $this->response->redirect($this->request->getUri());
            }
            catch (\Exception $e)
            {
                $data['message'] = $e->getMessage();
                return $this->error($data);
            }
        }

        $data['data']['list']       = $mMetaEnchant->paginate(12);
        $data['data']['pagination'] = $mMetaEnchant->pager->links(template: 'thema');
        $data['data']['total']      = $mMetaEnchant->pager->getTotal();

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
