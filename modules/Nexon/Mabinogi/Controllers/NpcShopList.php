<?php
namespace Modules\Nexon\Mabinogi\Controllers;

class NpcShopList extends BaseController
{
    protected string $viewName = 'npc-shop-list';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_npc_shop_list'));
        $this->html->addTitle('NPC 상점 조회');

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        $mNpcShopListShopItem = model(\Modules\Nexon\Mabinogi\Models\NpcShopListShopItem::class);
        if (isset($data['data']['get']['keyword']) && $data['data']['get']['keyword'])
        {
            $mNpcShopListShopItem->search($data['data']['get']['keyword']);
        }

        $data['data']['list']       = $mNpcShopListShopItem->paginate(12);
        $data['data']['pagination'] = $mNpcShopListShopItem->pager->links(template: 'thema');
        $data['data']['total']      = $mNpcShopListShopItem->pager->getTotal();

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
