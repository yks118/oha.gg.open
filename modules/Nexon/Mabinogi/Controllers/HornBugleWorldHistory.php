<?php
namespace Modules\Nexon\Mabinogi\Controllers;

class HornBugleWorldHistory extends BaseController
{
    protected string $viewName = 'horn-bugle-world-history';

    private int $limit = 10;

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

        if (! (isset($data['data']['get']['page']) && $data['data']['get']['page'] > 0))
        {
            $data['data']['get']['page'] = 1;
        }

        $mHornBugleWorldHistory
            ->orderBy('date_send', 'DESC')
            ->orderBy('server_name', 'ASC')
            ->orderBy('character_name', 'ASC')
        ;
        /*
        $data['data']['list']       = $mHornBugleWorldHistory->paginate(10);
        $data['data']['pagination'] = $mHornBugleWorldHistory->pager->links(template: 'thema');
        $data['data']['total']      = $mHornBugleWorldHistory->pager->getTotal();
         */
        $offset = ($data['data']['get']['page'] - 1) * $this->limit;
        $data['data']['list'] = $mHornBugleWorldHistory->findAll($this->limit, $offset);

        // CREATE INDEX `order_by` ON `ci_nexon_mabinogi_horn_bugle_world_history` (`date_send` DESC, `server_name` ASC, `character_name` ASC);
        // $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
