<?php

if (! function_usable('nexon_baram_config_api'))
{
    function nexon_baram_config_api(): \Modules\Nexon\Baram\Config\Api
    {
        return config(\Modules\Nexon\Baram\Config\Api::class);
    }
}

if (! function_usable('nexon_baram_services_api'))
{
    function nexon_baram_services_api(): \Modules\Nexon\Baram\Libraries\Api
    {
        return \Modules\Nexon\Baram\Config\Services::nexonBaramApi();
    }
}

if (! function_usable('nexon_baram_image_render_profile'))
{
    function nexon_baram_image_render_profile(string $serverName, string $characterName): string
    {
        return 'https://avatar.baram.nexon.com/Profile/RenderAvatar/' . $serverName . '/' . $characterName;
    }
}

if (! function_usable('nexon_baram_image_render_item'))
{
    function nexon_baram_image_render_item(string $itemName): string
    {
        return 'https://avatar.baram.nexon.com/Item/Render/' . $itemName;
    }
}
