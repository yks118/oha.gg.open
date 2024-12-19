<?php
namespace Modules\Nexon\FirstDescendant\Controllers\Meta;

use Modules\Nexon\FirstDescendant\Controllers\BaseController;

class MasteryRankLevelExp extends BaseController
{
    protected string $viewName = 'meta/mastery-rank-level-exp';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_first_descendant_meta_mastery_rank_level_exp'));
        $this->html
            ->addTitle(lang('NexonFirstDescendant.metadata_information'))
            ->addTitle(lang('NexonFirstDescendant.mastery_rank_exp'))
        ;

        $data = [
            'data' => [
                'response' => [],
            ],
        ];

        $list = nexon_first_descendant_meta_mastery_rank_level_detail();
        $data['data']['response'] = $list;
        $data['data']['total'] = count($list);

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
