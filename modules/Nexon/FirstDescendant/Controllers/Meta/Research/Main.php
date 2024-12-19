<?php
namespace Modules\Nexon\FirstDescendant\Controllers\Meta\Research;

use Modules\Nexon\FirstDescendant\Controllers\BaseController;

class Main extends BaseController
{
    protected string $viewName = 'meta/research/main';

    private int $limit = 12;

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_first_descendant_meta_research_main'));
        $this->html
            ->addTitle(lang('NexonFirstDescendant.metadata_information'))
            ->addTitle(lang('NexonFirstDescendant.research'))
        ;

        $data = [
            'data' => [
                'get'           => $this->request->getGet(),
                'response'      => [],
                'repeatables'   => [],
                'types'         => [],
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

        $list = nexon_first_descendant_meta_research($data['data']['get']['language_code']);
        foreach ($list as $row)
        {
            if (! in_array($row['repeatable_research'], $data['data']['repeatables']))
            {
                $data['data']['repeatables'][] = $row['repeatable_research'];
            }

            if (! in_array($row['research_type'], $data['data']['types']))
            {
                $data['data']['types'][] = $row['research_type'];
            }
        }

        sort($data['data']['repeatables']);
        sort($data['data']['types']);

        if (isset($data['data']['get']['repeatable_research']) && $data['data']['get']['repeatable_research'])
        {
            $repeatableResearch = $data['data']['get']['repeatable_research'];
            $list = array_filter(
                $list,
                function($row) use($repeatableResearch)
                {
                    return $row['repeatable_research'] === $repeatableResearch;
                }
            );
        }

        if (isset($data['data']['get']['research_type']) && $data['data']['get']['research_type'])
        {
            $researchType = $data['data']['get']['research_type'];
            $list = array_filter(
                $list,
                function($row) use($researchType)
                {
                    return $row['research_type'] === $researchType;
                }
            );
        }

        $data['data']['total'] = count($list);

        $offset = ($data['data']['get']['page'] - 1) * $this->limit;
        $data['data']['response']   = array_slice($list, $offset, $this->limit);

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
