<?php
namespace Modules\Nexon\CrazyArcade\Config;

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

    /** @var string[] $worldNames */
    public array $worldNames = [
        '드림', '해피',
    ];
}
