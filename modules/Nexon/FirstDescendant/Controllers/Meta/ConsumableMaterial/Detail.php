<?php
namespace Modules\Nexon\FirstDescendant\Controllers\Meta\ConsumableMaterial;

use Modules\Nexon\FirstDescendant\Controllers\BaseController;

class Detail extends BaseController
{
    protected string $viewName = 'meta/consumable-material/detail';

    private int $limit = 12;

    public function index(string $consumableMaterialId): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_first_descendant_meta_consumable_material_main'));
        $this->html
            ->addTitle(lang('NexonFirstDescendant.metadata_information'))
            ->addTitle(lang('NexonFirstDescendant.consumable_material'))
        ;

        $data = [
            'data' => [
                'get'                       => $this->request->getGet(),
                'response'                  => [],
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

        $data['data']['response'] = nexon_first_descendant_meta_consumable_material_id($consumableMaterialId, $data['data']['get']['language_code']);

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}