<?php
namespace Modules\Nexon\FirstDescendant\Config;

class Api
{
    /**
     * @var string $dev Limit per second: 5 requests / second
     *                  Daily limit: 1,000 requests / day
     * */
    public string $dev = '';

    /**
     * @var string $prod Limit per second: 500 requests / second
     *                   Daily limit: 20,000,000 requests / day
     */
    public string $prod = '';

    /** @var string[] $languageCodes */
    public array $languageCodes = [
        'ko', 'en', 'de', 'fr', 'ja', 'zh-CN', 'zh-TW', 'it', 'pl', 'pt', 'ru', 'es',
    ];
}
