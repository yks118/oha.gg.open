<?php
namespace Modules\Nexon\SuddenAttack\Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function nexonSuddenAttackApi(bool $getShared = true): \Modules\Nexon\SuddenAttack\Libraries\Api
    {
        if ($getShared)
        {
            $service = static::getSharedInstance('nexonSuddenAttackApi');
            if ($service instanceof \Modules\Nexon\SuddenAttack\Libraries\Api)
            {
                return $service;
            }
        }

        $cApi = nexon_sudden_attack_config_api();
        $apiKey = $cApi->dev;
        if ($cApi->prod && ! is_dev())
        {
            $apiKey = $cApi->prod;
        }
        return new \Modules\Nexon\SuddenAttack\Libraries\Api($apiKey);
    }
}
