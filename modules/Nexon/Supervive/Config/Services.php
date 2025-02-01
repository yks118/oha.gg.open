<?php
namespace Modules\Nexon\Supervive\Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function nexonSuperviveApi(bool $getShared = true): \Modules\Nexon\Supervive\Libraries\Api
    {
        if ($getShared)
        {
            $service = static::getSharedInstance('nexonSuperviveApi');
            if ($service instanceof \Modules\Nexon\Supervive\Libraries\Api)
            {
                return $service;
            }
        }

        $cApi = nexon_supervive_config_api();
        $apiKey = $cApi->dev;
        if ($cApi->prod && ! is_dev())
        {
            $apiKey = $cApi->prod;
        }
        return new \Modules\Nexon\Supervive\Libraries\Api($apiKey);
    }
}
