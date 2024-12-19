<?php
namespace Modules\Nexon\FirstDescendant\Controllers\Meta\Research;

use Modules\Nexon\FirstDescendant\Controllers\BaseController;

class Detail extends BaseController
{
    protected string $viewName = 'meta/research/detail';

    private int $limit = 12;

    public function index(string $researchId): \CodeIgniter\HTTP\ResponseInterface|string
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

        $data['data']['response'] = nexon_first_descendant_meta_research_id($researchId, $data['data']['get']['language_code']);
        $this->html->addTitle($data['data']['response']['research_name']);

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
