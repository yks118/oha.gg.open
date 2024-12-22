<?php
namespace Modules\Nexon\Baram\Config;

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

    /** @var string[] $serverNames */
    public array $serverNames = [
        '연', '무휼', '유리', '진', '하자', '호동',
    ];
}
