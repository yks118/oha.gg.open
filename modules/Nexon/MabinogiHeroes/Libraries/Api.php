<?php
namespace Modules\Nexon\MabinogiHeroes\Libraries;

use Exception;

class Api extends \Modules\Nexon\Core\Libraries\Api
{
    protected string $urlPrefix = 'heroes/';

    public function __construct(string $api)
    {
        parent::__construct($api);
    }

    /**
     * getId
     *
     * 캐릭터 식별자(ocid)를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/heroes/?id=29
     *
     * @param string $characterName
     *
     * @return array{ocid: string}
     *
     * @throws Exception
     */
    public function getId(string $characterName): array
    {
        $url = 'v2/id?character_name=' . $characterName;
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getCharacterBasic
     *
     * 기본 정보를 조회합니다.
     * 버프, 아이템 사용 등으로 적용된 효과로 경험치 또는 레벨이 게임 내 데이터와 상이할 수 있습니다.
     *
     * @link https://openapi.nexon.com/game/heroes/?id=29
     *
     * @param string $ocid
     *
     * @return array{
     *     character_name: string,
     *     character_date_create: string,
     *     character_date_last_login: string,
     *     character_date_last_logout: string,
     *     character_class_name: string,
     *     character_gender: string,
     *     character_exp: int,
     *     character_level: int,
     *     cairde_name: string,
     *     title_count: int,
     *     id_title_count: int,
     *     total_title_count: int,
     *     title_stat: array{
     *         array{
     *             stat_name: string,
     *             stat_value: string,
     *         },
     *     },
     *     skill_awakening: array{
     *         array{
     *             skill_name: string,
     *             item_name: string,
     *         },
     *     },
     *     dress_point: array{
     *         total_point: int,
     *         avatar_point: int,
     *         back_point: int,
     *         tail_point: int,
     *         object_point: int,
     *     },
     * }
     *
     * @throws Exception
     */
    public function getCharacterBasic(string $ocid): array
    {
        $url = 'v2/character/basic?ocid=' . $ocid;
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getCharacterTitle
     *
     * 타이틀/문양 보유 정보를 조회합니다.
     * 타이틀 타입(title_type)은 2023년 11월 23일 이후 획득(장착)한 타이틀/문양에 한해 조회할 수 있습니다.
     *
     * @link https://openapi.nexon.com/game/heroes/?id=29
     *
     * @param string $ocid
     *
     * @return array{
     *     title: array{
     *         array{
     *             title_type: string,
     *             title_name: string,
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getCharacterTitle(string $ocid): array
    {
        $url = 'v2/character/title?ocid=' . $ocid;
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getCharacterItemEquipment
     *
     * 장착 타이틀/문양 정보를 조회합니다.
     * 타이틀 타입(title_type)은 2023년 11월 23일 이후 획득(장착)한 타이틀/문양에 한해 조회할 수 있습니다.
     *
     * @link https://openapi.nexon.com/game/heroes/?id=29
     *
     * @param string $ocid
     *
     * @return array{
     *     title_equipment: array{
     *         array{
     *             title_equipment_type_name: string,
     *             title_type: string,
     *             title_name: string,
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getCharacterTitleEquipment(string $ocid): array
    {
        $url = 'v2/character/title-equipment?ocid=' . $ocid;
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getCharacterItemEquipment
     *
     * 장착 아이템 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/heroes/?id=29
     *
     * @param string $ocid
     *
     * @return array{
     *     item_equipment: array{
     *         array{
     *             item_equipment_page: string,
     *             item_equipment_slot_name: string,
     *             item_name: string,
     *             item_option: array{
     *                 enhancement_level: int,
     *                 tuning_stat: array{
     *                     array{
     *                         stat_name: string,
     *                         stat_value: string,
     *                     },
     *                 },
     *                 ability_name: string,
     *                 prefix_enchant_use_preset_no: int,
     *                 suffix_enchant_use_preset_no: int,
     *                 prefix_enchant_preset_1: string,
     *                 suffix_enchant_preset_1: string,
     *                 prefix_enchant_preset_2: string,
     *                 suffix_enchant_preset_2: string,
     *                 power_infusion_use_preset_no: int,
     *                 power_infusion_preset_1: array{
     *                     array{
     *                         stat_name: string,
     *                         stat_value: string,
     *                     },
     *                 },
     *                 power_infusion_preset_2: array{
     *                     array{
     *                         stat_name: string,
     *                         stat_value: string,
     *                     },
     *                 },
     *                 cash_item_color: array{
     *                     color_1: string,
     *                     color_2: string,
     *                     color_3: string,
     *                 },
     *                 avatar_color_use_preset_no: int,
     *                 avatar_color_preset_1: array{
     *                     color_1: string,
     *                     color_2: string,
     *                     color_3: string,
     *                 },
     *                 avatar_color_preset_2: array{
     *                     color_1: string,
     *                     color_2: string,
     *                     color_3: string,
     *                 },
     *                 avatar_color_preset_3: array{
     *                     color_1: string,
     *                     color_2: string,
     *                     color_3: string,
     *                 },
     *                 avatar_color_preset_4: array{
     *                     color_1: string,
     *                     color_2: string,
     *                     color_3: string,
     *                 },
     *                 avatar_color_preset_5: array{
     *                     color_1: string,
     *                     color_2: string,
     *                     color_3: string,
     *                 },
     *                 avatar_inner_armor_color_preset_1: array{
     *                     color_1: string,
     *                     color_2: string,
     *                     color_3: string,
     *                     default_color_flag: string,
     *                 },
     *                 avatar_inner_armor_color_preset_2: array{
     *                     color_1: string,
     *                     color_2: string,
     *                     color_3: string,
     *                     default_color_flag: string,
     *                 },
     *                 avatar_inner_armor_color_preset_3: array{
     *                     color_1: string,
     *                     color_2: string,
     *                     color_3: string,
     *                     default_color_flag: string,
     *                 },
     *                 avatar_inner_armor_color_preset_4: array{
     *                     color_1: string,
     *                     color_2: string,
     *                     color_3: string,
     *                     default_color_flag: string,
     *                 },
     *                 avatar_inner_armor_color_preset_5: array{
     *                     color_1: string,
     *                     color_2: string,
     *                     color_3: string,
     *                     default_color_flag: string,
     *                 },
     *             },
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getCharacterItemEquipment(string $ocid): array
    {
        $url = 'v2/character/item-equipment?ocid=' . $ocid;
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getCharacterStat
     *
     * 능력치 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/heroes/?id=29
     *
     * @param string $ocid
     *
     * @return array{
     *     stat: array{
     *         array{
     *             stat_name: string,
     *             stat_value: string,
     *         }
     *     }
     * }
     *
     * @throws Exception
     */
    public function getCharacterStat(string $ocid): array
    {
        $url = 'v2/character/stat?ocid=' . $ocid;
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getCharacterGuild
     *
     * 가입/신청한 길드 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/heroes/?id=29
     *
     * @param string $ocid
     *
     * @return array{guild_name: string}
     *
     * @throws Exception
     */
    public function getCharacterGuild(string $ocid): array
    {
        $url = 'v2/character/guild?ocid=' . $ocid;
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getMetaEnchant
     *
     * 인챈트 명을 입력하여 인챈트 등급 및 능력치를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/heroes/?id=29
     *
     * @param int $enchantType 0 : 접두 인챈트
     *                         1 : 접미 인챈트
     * @param string $enchantName
     *
     * @return array{
     *     enchant_grade: string,
     *     enchant_available_slot_name: string[],
     *     enchant_stat: string[],
     * }
     *
     * @throws Exception
     */
    public function getMetaEnchant(int $enchantType, string $enchantName): array
    {
        $url = 'v2/meta/enchant?enchant_type=' . $enchantType . '&enchant_name=' . $enchantName;
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getMarketplaceMarketHistory
     *
     * 현재 평균가는 마지막으로 갱신된 거래 기록의 평균 거래가로 확인 가능합니다.
     * 최근 24시간 내 10건 이상의 거래가 발생한 아이템의 거래 기록이 조회됩니다.
     *
     * @link https://openapi.nexon.com/game/heroes/?id=30
     *
     * @param string $itemName
     * @param ?string $cursor
     *
     * @return array{
     *     next_cursor: string,
     *     item: array{
     *         array{
     *             date_update: string,
     *             item_name: string,
     *             average_price: int,
     *             min_price: int,
     *             max_price: int,
     *             item_option: array{
     *                 enhancement_level: int,
     *                 tuning_stat: array{
     *                     array{
     *                         stat_name: string,
     *                         stat_value: string,
     *                     },
     *                 },
     *                 ability_name: string,
     *                 prefix_enchant_preset_1: string,
     *                 suffix_enchant_preset_1: string,
     *                 prefix_enchant_preset_2: string,
     *                 suffix_enchant_preset_2: string,
     *                 power_infusion_preset_1: array{
     *                     array{
     *                         stat_name: string,
     *                         stat_value: string,
     *                     },
     *                 },
     *                 power_infusion_preset_2: array{
     *                     array{
     *                         stat_name: string,
     *                         stat_value: string,
     *                     },
     *                 },
     *                 bind_release_limit: string,
     *                 item_shape_name: string,
     *                 item_quality: string,
     *                 bracelet_gem_composite: array{
     *                     array{
     *                         item_name: string,
     *                         stat: array{
     *                             array{
     *                                 stat_name: string,
     *                                 stat_value: string,
     *                             },
     *                         },
     *                     },
     *                 },
     *                 value: string,
     *             },
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getMarketplaceMarketHistory(string $itemName, string $cursor = null): array
    {
        $url = 'v2/marketplace/market-history?item_name=' . $itemName . ($cursor ? '&cursor=' . $cursor : '');
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getRankingHallOfHonor
     *
     * 명예의 전당 랭킹은 매일 오전 9시 실시간 랭킹 순위를 기준으로 반영됩니다.
     *
     * @link https://openapi.nexon.com/game/heroes/?id=31
     *
     * @param int $rankingType 0 : 공격력 기준 순위 / 공격력 200위까지 조회 가능합니다.
     *                         1 : 마법 공격력 기준 순위 / 마법 공격력 100위까지 조회 가능합니다.
     *
     * @return array{
     *     ranking: array{
     *         array{
     *             ranking_type: string,
     *             ranking: int,
     *             character_name: string,
     *             score: int,
     *         }
     *     }
     * }
     *
     * @throws Exception
     */
    public function getRankingHallOfHonor(int $rankingType): array
    {
        $url = 'v2/ranking/hall-of-honor?ranking_type=' . $rankingType;
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getRankingRealTime
     *
     * 실시간 랭킹 정보를 조회합니다.
     * 실시간 랭킹 정보는 1시간마다 반영됩니다.
     *
     * @link https://openapi.nexon.com/game/heroes/?id=31
     *
     * @param int $rankingType 0 : 공격력 기준 순위 / 공격력 4,000 위까지 조회 가능합니다.
     *                         1 : 마법 공격력 기준 순위 / 마법 공격력 2,000 위까지 조회 가능합니다.
     * @param int $pageNo 한 페이지 당 최대 500개의 데이터가 조회됩니다.
     *
     * @return array{
     *     ranking: array{
     *         array{
     *             ranking_type: string,
     *             ranking: int,
     *             character_name: string,
     *             score: int,
     *         }
     *     }
     * }
     *
     * @throws Exception
     */
    public function getRankingRealTime(int $rankingType, int $pageNo = 1): array
    {
        $url = 'v2/ranking/real-time?ranking_type=' . $rankingType . '&page_no=' . $pageNo;
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getNotice
     *
     * 마비노기 영웅전 공지사항에 최근 등록된 게시글 20개를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/heroes/?id=28
     *
     * @return array{
     *     notice: array{
     *         array{
     *             title: string,
     *             url: string,
     *             notice_id: int,
     *             date: string,
     *         }
     *     }
     * }
     *
     * @throws Exception
     */
    public function getNotice(): array
    {
        $url = 'v1/notice';
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getNoticeDetail
     *
     * 마비노기 영웅전 공지사항 게시글 세부 사항을 조회합니다.
     *
     * @link https://openapi.nexon.com/game/heroes/?id=28
     *
     * @param int $noticeId
     *
     * @return array{
     *     title: string,
     *     url: string,
     *     contents: string,
     *     date: string,
     * }
     *
     * @throws Exception
     */
    public function getNoticeDetail(int $noticeId): array
    {
        $url = 'v1/notice/detail?notice_id=' . $noticeId;
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getNoticePatch
     *
     * 마비노기 영웅전 패치노트에 최근 등록된 게시글 20개를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/heroes/?id=28
     *
     * @return array{
     *     patch_notice: array{
     *         array{
     *             title: string,
     *             url: string,
     *             notice_id: int,
     *             date: string,
     *         }
     *     }
     * }
     *
     * @throws Exception
     */
    public function getNoticePatch(): array
    {
        $url = 'v1/notice-patch';
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getNoticePatchDetail
     *
     * 마비노기 영웅전 패치노트 게시글 세부 사항을 조회합니다.
     *
     * @link https://openapi.nexon.com/game/heroes/?id=28
     *
     * @param int $noticeId
     *
     * @return array
     *
     * @throws Exception
     */
    public function getNoticePatchDetail(int $noticeId): array
    {
        $url = 'v1/notice-patch/detail?notice_id=' . $noticeId;
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getNoticeEvent
     *
     * 마비노기 영웅전 이벤트&샵에 최근 등록된 공지사항 20개를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/heroes/?id=28
     *
     * @return array{
     *     event_notice: array{
     *         array{
     *             title: string,
     *             url: string,
     *             notice_id: int,
     *             date_event_start: string,
     *             date_event_end: string,
     *             ongoing_flag: string,
     *         }
     *     }
     * }
     *
     * @throws Exception
     */
    public function getNoticeEvent(): array
    {
        $url = 'v1/notice-event';
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getNoticeEventDetail
     *
     * 마비노기 영웅전 이벤트&샵 게시글 세부 사항을 조회합니다.
     *
     * @link https://openapi.nexon.com/game/heroes/?id=28
     *
     * @param int $noticeId
     *
     * @return array{
     *     title: string,
     *     url: string,
     *     contents: string,
     *     date_event_start: string,
     *     date_event_end: string,
     *     ongoing_flag: string,
     * }
     *
     * @throws Exception
     */
    public function getNoticeEventDetail(int $noticeId): array
    {
        $url = 'v1/notice-event/detail?notice_id=' . $noticeId;
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }
}
