<?php
namespace Modules\NcSoft\Lineage2M\Controllers;

class Item extends BaseController
{
    protected string $viewName = 'item';

    public function index(int $itemId): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('ncsoft_lineage2m_main'));
        $this->html->addTitle('아이템');

        $data = [
            'data'  => [
                'get'       => $this->request->getGet(),
                'servers'   => ncsoft_lineage2m_get_servers(),

                'item'  => [],
                'price' => [],
            ],
        ];

        try {
            $enchantLevel = (int) ($data['data']['get']['enchant_level'] ?? '');
            $serverId = (int) ($data['data']['get']['server_id'] ?? '');

            $api = ncsoft_lineage2m_services_api();
            $data['data']['item']   = $api->getMarketItems($itemId, $enchantLevel);
            $data['data']['price']  = $api->getMarketItemsPrice($itemId, $enchantLevel, $serverId);

            $this->html->addTitle($data['data']['item']['item_name']);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return $this->error($data);
        }

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
