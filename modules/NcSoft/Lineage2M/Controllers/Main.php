<?php
namespace Modules\NcSoft\Lineage2M\Controllers;

class Main extends BaseController
{
    protected string $viewName = 'main';

    private int $limit = 12;

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('ncsoft_lineage2m_main'));

        $data = [
            'data'  => [
                'get'       => $this->request->getGet(),
                'servers'   => ncsoft_lineage2m_get_servers(),
                'response'  => [],
            ],
        ];

        if (isset($data['data']['get']['search_keyword']))
        {
            try {
                $page = (int) ($data['data']['get']['page'] ?? 1);
                $size = (int) ($data['data']['get']['size'] ?? $this->limit);

                $api = ncsoft_lineage2m_services_api();
                $data['data']['response'] = $api->getMarketItemsSearch(
                    $data['data']['get']['search_keyword'],
                    (int) ($data['data']['get']['server_id'] ?? 0),
                    (int) ($data['data']['get']['from_enchant_level'] ?? 0),
                    (int) ($data['data']['get']['to_enchant_level'] ?? 0),
                    (bool) ($data['data']['get']['sale'] ?? false),
                    $page,
                    $size,
                );

                $pager = \Config\Services::pager();
                $data['data']['pagination'] = $pager->makeLinks($page, $size, $data['data']['response']['pagination']['total'], 'thema');
            } catch (\Exception $e) {
                $data['message'] = $e->getMessage();
                return $this->error($data);
            }
        }

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
