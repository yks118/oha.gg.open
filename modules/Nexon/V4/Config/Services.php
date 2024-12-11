<?php
namespace Modules\Nexon\V4\Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function nexonV4Api(bool $getShared = true): \Modules\Nexon\V4\Libraries\Api
    {
        if ($getShared)
        {
            $service = static::getSharedInstance('nexonV4Api');
            if ($service instanceof \Modules\Nexon\V4\Libraries\Api)
            {
                return $service;
            }
        }

        $cApi = nexon_v4_config_api();
        $apiKey = $cApi->dev;
        if ($cApi->prod && ! is_dev())
        {
            $apiKey = $cApi->prod;
        }
        return new \Modules\Nexon\V4\Libraries\Api($apiKey);
    }
}
