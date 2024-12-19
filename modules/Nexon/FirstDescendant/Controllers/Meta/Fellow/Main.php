<?php
namespace Modules\Nexon\FirstDescendant\Controllers\Meta\Fellow;

use Modules\Nexon\FirstDescendant\Controllers\BaseController;

class Main extends BaseController
{
    protected string $viewName = 'meta/fellow/main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_first_descendant_meta_fellow_main'));
        $this->html
            ->addTitle(lang('NexonFirstDescendant.metadata_information'))
            ->addTitle(lang('NexonFirstDescendant.fellow'))
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

        $list = nexon_first_descendant_meta_fellow($data['data']['get']['language_code']);
        $data['data']['response'] = $list;
        $data['data']['total'] = count($list);

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
