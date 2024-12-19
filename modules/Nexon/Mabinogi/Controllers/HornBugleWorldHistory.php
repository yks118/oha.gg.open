<?php
namespace Modules\Nexon\Mabinogi\Controllers;

class HornBugleWorldHistory extends BaseController
{
    protected string $viewName = 'horn-bugle-world-history';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_horn_bugle_world_history'));
        $this->html->addTitle('거대한 외침의 뿔피리 내역 조회');

        $data = [];
        $data['data'] = [
            'get'   => $this->request->getGet(),
        ];

        $cCms = core_config_cms();
        $mHornBugleWorldHistory = model(\Modules\Nexon\Mabinogi\Models\HornBugleWorldHistory::class);
        if (isset($data['data']['get'][$cCms->searchName]) && $data['data']['get'][$cCms->searchName])
        {
            $mHornBugleWorldHistory->search($data['data']['get'][$cCms->searchName]);
        }
        else
        {
            // use index
            $mHornBugleWorldHistory->where('server_name !=', '');
        }

        $mHornBugleWorldHistory
            ->orderBy('date_send', 'DESC')
            ->orderBy('server_name', 'ASC')
            ->orderBy('character_name', 'ASC')
        ;
        $data['data']['list']       = $mHornBugleWorldHistory->paginate(10);
        $data['data']['pagination'] = $mHornBugleWorldHistory->pager->links(template: 'thema');
        $data['data']['total']      = $mHornBugleWorldHistory->pager->getTotal();

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
