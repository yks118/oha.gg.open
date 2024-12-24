<?php
namespace Modules\NcSoft\Lineage2M\Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function ncsoftLineage2MApi(bool $getShared = true): \Modules\NcSoft\Lineage2M\Libraries\Api
    {
        if ($getShared)
        {
            $service = static::getSharedInstance('ncsoftLineage2MApi');
            if ($service instanceof \Modules\NcSoft\Lineage2M\Libraries\Api)
            {
                return $service;
            }
        }

        $cApi = ncsoft_lineage2m_config_api();
        return new \Modules\NcSoft\Lineage2M\Libraries\Api($cApi->key);
    }
}
