<?php

if (! function_usable('ncsoft_core_config_api'))
{
    function ncsoft_core_config_api(): \Modules\NcSoft\Core\Config\Api
    {
        return config(\Modules\NcSoft\Core\Config\Api::class);
    }
}
