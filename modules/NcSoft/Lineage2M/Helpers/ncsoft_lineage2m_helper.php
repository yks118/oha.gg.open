<?php

if (! function_usable('ncsoft_lineage2m_config_api'))
{
    function ncsoft_lineage2m_config_api(): \Modules\NcSoft\Lineage2M\Config\Api
    {
        return config(\Modules\NcSoft\Lineage2M\Config\Api::class);
    }
}

if (! function_usable('ncsoft_lineage2m_services_api'))
{
    function ncsoft_lineage2m_services_api(): \Modules\NcSoft\Lineage2M\Libraries\Api
    {
        return \Modules\NcSoft\Lineage2M\Config\Services::ncsoftLineage2MApi();
    }
}

if (! function_usable('ncsoft_lineage2m_get_servers'))
{
    function ncsoft_lineage2m_get_servers(): array
    {
        $data = [];

        try
        {
            $cacheKey = 'ncsoft_lineage2m_get_servers';
            $data = cache()->get($cacheKey);
            if (is_null($data))
            {
                $api = ncsoft_lineage2m_services_api();
                $data = $api->getMarketServers();
                cache()->save($cacheKey, $data, DAY);
            }
        }
        catch (Exception $e)
        {}

        return $data;
    }
}
