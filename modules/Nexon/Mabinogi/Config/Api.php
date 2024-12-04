<?php
namespace Modules\Nexon\Mabinogi\Config;

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
        '류트', '만돌린', '하프', '울프',
    ];

    /** @var string[] $npcNames */
    public array $npcNames = [
        '델', '델렌', '상인 라누', '상인 피루',
        '모락', '상인 아루', '리나', '상인 누누', '상인 메루',
        '켄', '귀넥', '얼리', '데위', '테일로', '상인 세누', '상인 베루', '상인 에루', '상인 네루',
        '카디', '인장 상인', '피오나트',
    ];

    /** @var string[] $auctionItemCategories */
    public array $auctionItemCategories = [
        '개조석', '검', '경갑옷', '기타', '기타 소모품',
        '기타 스크롤', '기타 장비', '기타 재료', '꼬리', '날개',
        '낭만농장/달빛섬', '너클', '던전 통행증', '도끼', '도면',
        '둔기', '듀얼건', '랜스', '로브', '마기그래프',
        '마기그래프 도안', '마도서', '마리오네트', '마법가루', '마비노벨',
        '마족 스크롤', '말풍선 스티커', '매직 크래프트', '모자/가발', '방패',
        '변신 메달', '보석', '분양 메달', '불타래', '뷰티 쿠폰',
        '생활 도구', '석궁', '수리검', '스케치', '스태프',
        '신발', '실린더', '아틀라틀', '악기', '알반 훈련석',
        '액세서리', '양손 장비', '얼굴 장식', '에이도스', '에코스톤',
        '염색 앰플', '오브', '옷본', '원거리 소모품', '원드',
        '음식', '의자/사물', '인챈트 스크롤', '장갑', '제련/블랙스미스',
        '제스처', '주머니', '중갑옷', '책', '천옷',
        '천옷/방직', '체인 블레이드', '토템', '팔리아스 유물', '퍼퓸',
        '페이지', '포션', '피니 펫', '핀즈비즈', '한손 장비',
        '핸들', '허브', '활', '힐웬 공학',
    ];

    /** @var array{default: int, premium: int} $auctionSaleCommission 경매장 판매 수수료 (%) */
    public array $auctionSaleCommission = [
        'default'   => 5,
        'premium'   => 4,
    ];

    /** @var int[] $auctionSaleCommissionCoupon 경매장 판매 수수료 할인 쿠폰 (%) */
    public array $auctionSaleCommissionCoupon = [
        10, 20, 30, 50, 100
    ];
}
