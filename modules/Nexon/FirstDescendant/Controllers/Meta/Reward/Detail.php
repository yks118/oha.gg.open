<?php
namespace Modules\Nexon\FirstDescendant\Controllers\Meta\Reward;

use Modules\Nexon\FirstDescendant\Controllers\BaseController;

class Detail extends BaseController
{
    protected string $viewName = 'meta/reward/detail';

    public function index(string $mapId): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_first_descendant_meta_reward_main'));
        $this->html
            ->addTitle(lang('NexonFirstDescendant.metadata_information'))
            ->addTitle(lang('NexonFirstDescendant.level_reward'))
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

        $response = nexon_first_descendant_meta_reward($data['data']['get']['language_code']);

        $offset = strpos($response, '{"map_id":"' . $mapId);
        $length = strpos($response, '},{"map_id"', $offset);
        if ($length !== false)
        {
            $length = $length - $offset + 1;
        }
        else
        {
            $length = strlen($response) - $offset - 1;
        }
        $response = substr($response, $offset, $length);
        $data['data']['response'] = json_decode($response, true);
        $this->html->addTitle($data['data']['response']['map_name']);

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
