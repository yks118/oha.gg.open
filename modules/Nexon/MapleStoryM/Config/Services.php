<?php
namespace Modules\Nexon\MapleStoryM\Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function nexonMapleStoryMApi(bool $getShared = true): \Modules\Nexon\MapleStoryM\Libraries\Api
    {
        if ($getShared)
        {
            $service = static::getSharedInstance('nexonMapleStoryMApi');
            if ($service instanceof \Modules\Nexon\MapleStoryM\Libraries\Api)
            {
                return $service;
            }
        }

        $cApi = nexon_maple_story_m_config_api();
        $apiKey = $cApi->dev;
        if ($cApi->prod && ! is_dev())
        {
            $apiKey = $cApi->prod;
        }
        return new \Modules\Nexon\MapleStoryM\Libraries\Api($apiKey);
    }
}
