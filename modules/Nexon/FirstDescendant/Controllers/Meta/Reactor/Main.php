<?php
namespace Modules\Nexon\FirstDescendant\Controllers\Meta\Reactor;

use Modules\Nexon\FirstDescendant\Controllers\BaseController;

class Main extends BaseController
{
    protected string $viewName = 'meta/reactor/main';

    private int $limit = 12;

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_first_descendant_meta_reactor_main'));
        $this->html
            ->addTitle(lang('NexonFirstDescendant.metadata_information'))
            ->addTitle(lang('NexonFirstDescendant.reactor'))
        ;

        $data = [
            'data' => [
                'get'       => $this->request->getGet(),
                'response'  => [],
                'tiers'     => [],
            ],
        ];

        if (
            ! (
                isset($data['data']['get']['language_code'])
                && $data['data']['get']['language_code']
                && in_array($data['data']['get']['language_code'], nexon_first_descendant_config_api()->languageCodes)
            )
        )
        {
            $data['data']['get']['language_code'] = $this->request->getLocale();
        }

        if (! (isset($data['data']['get']['page']) && intval($data['data']['get']['page']) == $data['data']['get']['page'] && $data['data']['get']['page'] > 0))
        {
            $data['data']['get']['page'] = 1;
        }

        $response = nexon_first_descendant_meta_reactor($data['data']['get']['language_code']);
        $response = preg_replace(
            '/,"reactor_skill_power":.+?}]}]/',
            '',
            $response
        );
        $list = json_decode($response, true);

        foreach ($list as $row)
        {
            if (! in_array($row['reactor_tier_id'], $data['data']['tiers']))
            {
                $data['data']['tiers'][] = $row['reactor_tier_id'];
            }
        }

        if (isset($data['data']['get']['reactor_tier_id']) && $data['data']['get']['reactor_tier_id'])
        {
            $reactorTier = $data['data']['get']['reactor_tier_id'];
            $list = array_filter(
                $list,
                function($row) use($reactorTier)
                {
                    return $row['reactor_tier_id'] === $reactorTier;
                }
            );
        }

        $data['data']['total'] = count($list);

        $offset = ($data['data']['get']['page'] - 1) * $this->limit;
        $data['data']['response'] = array_slice($list, $offset, $this->limit);

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
