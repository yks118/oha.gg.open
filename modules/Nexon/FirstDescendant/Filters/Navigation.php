<?php
namespace Modules\Nexon\FirstDescendant\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Navigation implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null): ?\CodeIgniter\HTTP\RedirectResponse
    {
        $cApp = config(\Config\App::class);
        if (! in_array($request->getUri()->getSegment(3), $cApp->supportedLocales))
        {
            $currentUrl = current_url(true);
            $locale = \Config\Services::language()->getLocale();
            $redirectUrl = str_replace('/nexon/first-descendant', '/nexon/first-descendant/' . $locale, $currentUrl);
            return redirect()->to($redirectUrl);
        }

        \Modules\Core\Config\Services::navigation()->set([
            [
                'name'  => lang('NexonFirstDescendant.dashboard'),
                'href'  => site_to('nexon_first_descendant_main'),
            ],
            [
                'name'  => lang('NexonFirstDescendant.metadata_information'),
                'href'  => '',
                'child' => [
                    [
                        'name'  => lang('NexonFirstDescendant.descendant'),
                        'href'  => site_to('nexon_first_descendant_meta_descendant_main'),
                    ],
                    [
                        'name'  => lang('NexonFirstDescendant.descendant_level_exp'),
                        'href'  => site_to('nexon_first_descendant_meta_descendant_level_exp'),
                    ],
                    [
                        'name'  => lang('NexonFirstDescendant.mastery_rank_exp'),
                        'href'  => site_to('nexon_first_descendant_meta_mastery_rank_level_exp'),
                    ],
                    [
                        'name'  => lang('NexonFirstDescendant.weapon'),
                        'href'  => site_to('nexon_first_descendant_meta_weapon_main'),
                    ],
                    [
                        'name'  => lang('NexonFirstDescendant.module'),
                        'href'  => site_to('nexon_first_descendant_meta_module_main'),
                    ],
                    [
                        'name'  => lang('NexonFirstDescendant.reactor'),
                        'href'  => site_to('nexon_first_descendant_meta_reactor_main'),
                    ],
                    [
                        'name'  => lang('NexonFirstDescendant.external_component'),
                        'href'  => site_to('nexon_first_descendant_meta_external_component_main'),
                    ],
                    [
                        'name'  => lang('NexonFirstDescendant.level_reward'),
                        'href'  => site_to('nexon_first_descendant_meta_reward_main'),
                    ],
                    [
                        'name'  => lang('NexonFirstDescendant.consumable_material'),
                        'href'  => site_to('nexon_first_descendant_meta_consumable_material_main'),
                    ],
                    [
                        'name'  => lang('NexonFirstDescendant.research'),
                        'href'  => site_to('nexon_first_descendant_meta_research_main'),
                    ],
                    [
                        'name'  => lang('NexonFirstDescendant.fellow'),
                        'href'  => site_to('nexon_first_descendant_meta_fellow_main'),
                    ],
                    [
                        'name'  => lang('NexonFirstDescendant.fellow_level_exp'),
                        'href'  => site_to('nexon_first_descendant_meta_fellow_level_exp'),
                    ],
                    [
                        'name'  => lang('NexonFirstDescendant.adapt_level_exp'),
                        'href'  => site_to('nexon_first_descendant_meta_adapt_level_exp')
                    ],
                    [
                        'name'  => lang('NexonFirstDescendant.customizing_item'),
                        'href'  => site_to('nexon_first_descendant_meta_customizing_item'),
                    ],
                    [
                        'name'  => lang('NexonFirstDescendant.medal'),
                        'href'  => site_to('nexon_first_descendant_meta_medal')
                    ],
                ],
            ],
            [
                'name'  => lang('NexonFirstDescendant.module_recommendation'),
                'href'  => site_to('nexon_first_descendant_recommendation_module'),
            ],
            [
                'name'  => lang('Core.navigation.official_site'),
                'href'  => '',
                'child' => [
                    [
                        'name'  => lang('NexonFirstDescendant.first_descendant'),
                        'href'  => 'https://tfd.nexon.com/',
                    ],
                    [
                        'name'  => 'NEXON Open API',
                        'href'  => 'https://openapi.nexon.com/ko/game/tfd/?id=20',
                    ],
                ],
            ],
        ]);

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {}
}
