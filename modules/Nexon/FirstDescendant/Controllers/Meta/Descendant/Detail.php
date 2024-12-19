<?php
namespace Modules\Nexon\FirstDescendant\Controllers\Meta\Descendant;

use Modules\Nexon\FirstDescendant\Controllers\BaseController;

class Detail extends BaseController
{
    protected string $viewName = 'meta/descendant/detail';

    public function index(string $descendantId): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_first_descendant_meta_descendant_main'));
        $this->html
            ->addTitle(lang('NexonFirstDescendant.metadata_information'))
            ->addTitle(lang('NexonFirstDescendant.descendant'))
        ;

        $data = [
            'data' => [
                'get'       => $this->request->getGet(),
                'response'  => [],
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

        $data['data']['response'] = nexon_first_descendant_meta_descendant_id($descendantId, $data['data']['get']['language_code']);

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
