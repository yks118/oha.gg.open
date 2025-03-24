<?php
namespace Modules\Nexon\FirstDescendant\Controllers\Meta;

use Modules\Nexon\FirstDescendant\Controllers\BaseController;

class AdaptLevelExp extends BaseController
{
    protected string $viewName = 'meta/adapt-level-exp';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_first_descendant_meta_adapt_level_exp'));
        $this->html
            ->addTitle(lang('NexonFirstDescendant.metadata_information'))
            ->addTitle(lang('NexonFirstDescendant.adapt_level_exp'))
        ;

        $data = [
            'data' => [
                'response' => [],
            ],
        ];

        $list = nexon_first_descendant_meta_adapt_level();
        $data['data']['response'] = $list;
        $data['data']['total'] = count($list);

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
