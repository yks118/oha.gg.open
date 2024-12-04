<?php
namespace Modules\Core\Config;

class Registrar
{
    public static function App(): array
    {
        return [
            'baseURL'           => '',
            'allowedHostnames'  => [],
            'indexPage'         => '',
            'permittedURIChars' => 'a-z 0-9~%.:_\-가-힣\(\)+',
            'defaultLocale'     => 'ko',
            'negotiateLocale'   => true,
            'supportedLocales'  => [
                'ko',
            ],
            'appTimezone'       => 'Asia/Seoul',
            'proxyIPs'          => [],
        ];
    }

    public static function Cache(): array
    {
        return [
            'handler'   => 'file',
            'storePath' => WRITEPATH . 'cache/',
            'prefix'    => '',
            'cacheQueryString'  => true,
        ];
    }

    public static function Database(): array
    {
        return [
            'default'   => [
                'hostname'     => '',
                'username'     => '',
                'password'     => 'Mysql!118@m',
                'database'     => '',
                'DBDriver'     => 'MySQLi',
                'DBPrefix'     => 'ci_',
                'charset'      => 'utf8mb4',
                'DBCollat'     => 'utf8mb4_unicode_ci',
            ],
        ];
    }

    public static function Encryption(): array
    {
        return [
            'key'   => '',
        ];
    }

    public static function Pager(): array
    {
        $cms = core_config_cms();

        return [
            'templates' => [
                'thema' => '..' . DIRECTORY_SEPARATOR
                    . '..' . DIRECTORY_SEPARATOR
                    . 'modules' . DIRECTORY_SEPARATOR
                    . 'Core' . DIRECTORY_SEPARATOR
                    . 'Thema' . DIRECTORY_SEPARATOR
                    . $cms->thema . DIRECTORY_SEPARATOR
                    . 'Pagination' . DIRECTORY_SEPARATOR
                    . 'default'
            ],
        ];
    }
}
