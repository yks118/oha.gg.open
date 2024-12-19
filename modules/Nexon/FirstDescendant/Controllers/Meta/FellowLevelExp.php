<?php
namespace Modules\Nexon\FirstDescendant\Controllers\Meta;

use Modules\Nexon\FirstDescendant\Controllers\BaseController;

class FellowLevelExp extends BaseController
{
    protected string $viewName = 'meta/fellow-level-exp';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_first_descendant_meta_fellow_level_exp'));
        $this->html
            ->addTitle(lang('NexonFirstDescendant.metadata_information'))
            ->addTitle(lang('NexonFirstDescendant.fellow_level_exp'))
        ;

        $data = [
            'data' => [
                'get'       => $this->request->getGet(),
                'response'  => [],
            ],
        ];

        $data['data']['response'] = nexon_first_descendant_meta_fellow_level_detail();

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
