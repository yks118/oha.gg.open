<?php
namespace Modules\Nexon\MabinogiHeroes\Config;

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

    /** @var int[] $rankingRealTimePageNo */
    public array $rankingRealTimePageNo = [
        8, // 4,000 / 500 = 8
        4, // 2,000 / 500 = 4
    ];
}
