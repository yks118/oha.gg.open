<?php

if (! function_usable('core_config_cdn'))
{
    function core_config_cdn(): \Modules\Core\Config\Cdn
    {
        return config(\Modules\Core\Config\Cdn::class);
    }
}

if (! function_usable('core_config_cms'))
{
    function core_config_cms(): \Modules\Core\Config\Cms
    {
        return config(\Modules\Core\Config\Cms::class);
    }
}
