<?php
namespace Modules\Nexon\FirstDescendant\Controllers\Meta\Weapon;

use Modules\Nexon\FirstDescendant\Controllers\BaseController;

class Detail extends BaseController
{
    protected string $viewName = 'meta/weapon/detail';

    public function index(string $weaponId): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_first_descendant_meta_weapon_main'));
        $this->html
            ->addTitle(lang('NexonFirstDescendant.metadata_information'))
            ->addTitle(lang('NexonFirstDescendant.weapon'))
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

        $list = nexon_first_descendant_meta_weapon($data['data']['get']['language_code']);
        foreach ($list as $row)
        {
            if ($row['weapon_id'] === $weaponId)
            {
                $data['data']['response'] = $row;
                break;
            }
        }

        if (isset($data['data']['response']['weapon_name']) && $data['data']['response']['weapon_name'])
        {
            $this->html->addTitle($data['data']['response']['weapon_name']);
        }
        else
        {
            $this->show404();
        }

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
