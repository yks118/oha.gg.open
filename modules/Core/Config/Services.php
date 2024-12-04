<?php
namespace Modules\Core\Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function cdn(bool $getShared = true): \Modules\Core\Libraries\Cdn
    {
        if ($getShared)
        {
            $service = static::getSharedInstance('cdn');
            if ($service instanceof \Modules\Core\Libraries\Cdn)
            {
                return $service;
            }
        }

        return new \Modules\Core\Libraries\Cdn();
    }

    public static function html(bool $getShared = true): \Modules\Core\Libraries\Html
    {
        if ($getShared)
        {
            $service = static::getSharedInstance('html');
            if ($service instanceof \Modules\Core\Libraries\Html)
            {
                return $service;
            }
        }

        return new \Modules\Core\Libraries\Html();
    }

    public static function navigation(bool $getShared = true): \Modules\Core\Libraries\Navigation
    {
        if ($getShared)
        {
            $service = static::getSharedInstance('navigation');
            if ($service instanceof \Modules\Core\Libraries\Navigation)
            {
                return $service;
            }
        }

        return new \Modules\Core\Libraries\Navigation();
    }
}
