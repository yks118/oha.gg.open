<?php

if (! function_usable('nexon_v4_config_api'))
{
    function nexon_v4_config_api(): \Modules\Nexon\V4\Config\Api
    {
        return config(\Modules\Nexon\V4\Config\Api::class);
    }
}

if (! function_usable('nexon_v4_services_api'))
{
    function nexon_v4_services_api(): \Modules\Nexon\V4\Libraries\Api
    {
        return \Modules\Nexon\V4\Config\Services::nexonV4Api();
    }
}
