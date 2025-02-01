<?php

if (! function_usable('nexon_supervive_config_api'))
{
    function nexon_supervive_config_api(): \Modules\Nexon\Supervive\Config\Api
    {
        return config(\Modules\Nexon\Supervive\Config\Api::class);
    }
}

if (! function_usable('nexon_supervive_services_api'))
{
    function nexon_supervive_services_api(): \Modules\Nexon\Supervive\Libraries\Api
    {
        return \Modules\Nexon\Supervive\Config\Services::nexonSuperviveApi();
    }
}
