<?php
namespace Modules\Nexon\FirstDescendant\Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function nexonFirstDescendantApi(bool $getShared = true): \Modules\Nexon\FirstDescendant\Libraries\Api
    {
        if ($getShared)
        {
            $service = static::getSharedInstance('nexonFirstDescendantApi');
            if ($service instanceof \Modules\Nexon\FirstDescendant\Libraries\Api)
            {
                return $service;
            }
        }

        $cApi = nexon_first_descendant_config_api();
        $apiKey = $cApi->dev;
        if ($cApi->prod && ! is_dev())
        {
            $apiKey = $cApi->prod;
        }
        return new \Modules\Nexon\FirstDescendant\Libraries\Api($apiKey);
    }
}
