<?php

if (! function_usable('core_services_cdn'))
{
    function core_services_cdn(): \Modules\Core\Libraries\Cdn
    {
        return \Modules\Core\Config\Services::cdn();
    }
}

if (! function_usable('core_services_html'))
{
    function core_services_html(): \Modules\Core\Libraries\Html
    {
        return \Modules\Core\Config\Services::html();
    }
}

if (! function_usable('core_services_navigation'))
{
    function core_services_navigation(): \Modules\Core\Libraries\Navigation
    {
        return \Modules\Core\Config\Services::navigation();
    }
}
