<?php
namespace Modules\Core\Libraries;

class Cdn
{
    private \Modules\Core\Config\Cdn $config;

    public function __construct()
    {
        $this->config = core_config_cdn();
    }

    public function get(string $path, ?bool $use = null): string
    {
        $url = $path;

        $str2 = mb_substr($path, 2);
        if (! in_array($str2, ['//', 'ht']))
        {
            $path = ltrim($path, DIRECTORY_SEPARATOR);
            if (is_file(FCPATH . $path))
            {
                $path .= '?' . $this->config->parameterName . '=' . filemtime(FCPATH . $path);
            }

            if (is_null($use))
            {
                $use = $this->config->useDefault;
            }

            if ($use && $this->config->domain)
            {
                $url = $this->config->domain . $path;
            }
            else
            {
                $url = $path;
            }
        }

        return $url;
    }
}
