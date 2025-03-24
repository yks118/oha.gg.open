<?php
namespace Modules\Nexon\SuddenAttack\Config;

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

    public array $match = [
        'modes' => [
            '개인전', '데스매치', '폭파미션', '진짜를 모아라',
        ],
        'types' => [
            '일반전', '클랜전', '퀵매치 클랜전', '클랜 랭크전', '랭크전 솔로', '랭크전 파티', '토너먼트',
        ],
    ];
}
