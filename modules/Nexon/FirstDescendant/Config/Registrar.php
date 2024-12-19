<?php
namespace Modules\Nexon\FirstDescendant\Config;

class Registrar
{
    public static function App(): array
    {
        return [
            'defaultLocale'     => 'en',
            'negotiateLocale'   => true,
            'supportedLocales'  => [
                'ko', 'en', 'de', 'fr', 'ja', 'zh-CN', 'zh-TW', 'it', 'pl', 'pt', 'ru', 'es',
            ],
        ];
    }
}
