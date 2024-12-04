<?php
namespace Modules\Account\Config;

use CodeIgniter\Events\Events;

Events::on(
    'pre_system',
    static function(): void
    {
        helper('core_ci');
        helper('core_common');
        helper('core_config');
        helper('core_services');
        helper('core_validate');
    }
);

// cli 에서는 사용하지 않음
if (! is_cli())
{
    Events::on(
        'pre_system',
        static function(): void
        {
            // site_to() 함수와 연계
            $request = \Config\Services::request();
            $request->setPath(str_replace('+', '%2B', $request->getUri()->getPath()));
        }
    );
}
