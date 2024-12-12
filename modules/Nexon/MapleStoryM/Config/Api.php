<?php
namespace Modules\Nexon\MapleStoryM\Config;

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
        '아케인', '크로아', '엘리시움', '루나', '스카니아', '유니온', '제니스',
    ];
}
