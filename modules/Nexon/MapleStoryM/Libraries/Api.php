<?php
namespace Modules\Nexon\MapleStoryM\Libraries;

use Exception;

class Api extends \Modules\Nexon\Core\Libraries\Api
{
    protected string $urlPrefix = 'maplestorym/v1/';

    public function __construct(string $api)
    {
        parent::__construct($api);
    }

    /**
     * getId
     *
     * 캐릭터 식별자(ocid)를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/maplestorym/?id=1
     *
     * @param string $worldName
     * @param string $characterName
     *
     * @return array{ocid: string}
     *
     * @throws Exception
     */
    public function getId(string $worldName, string $characterName): array
    {
        $url = 'id?world_name=' . $worldName . '&character_name=' . $characterName;
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
     * @link https://openapi.nexon.com/ko/game/maplestorym/?id=1
     *
     * @param string $ocid
     *
     * @return array{
     *     character_name: string,
     *     world_name: string,
     *     character_date_create: string,
     *     character_date_last_login: string,
     *     character_date_last_logout: string,
     *     character_job_name: string,
     *     character_gender: string,
     *     character_exp: int,
     *     character_level: int,
     * }
     *
     * @throws Exception
     */
    public function getCharacterBasic(string $ocid): array
    {
        $url = 'character/basic?ocid=' . $ocid;
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
     * @link https://openapi.nexon.com/ko/game/maplestorym/?id=1
     *
     * @param string $ocid
     *
     * @return array{
     *     item_equipment: array{
     *         array{
     *             item_name: string,
     *             item_equipment_page_name: string,
     *             item_equipment_slot_name: string,
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getCharacterItemEquipment(string $ocid): array
    {
        $url = 'character/item-equipment?ocid=' . $ocid;
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
     * 스탯 정보를 조회합니다.
     * 아이템 착용, 강화, 버프 등 캐릭터에 적용된 효과로 스탯 값이 게임 내 데이터와 상이할 수 있습니다.
     *
     * @link https://openapi.nexon.com/ko/game/maplestorym/?id=1
     *
     * @param string $ocid
     *
     * @return array{
     *     stat: array{
     *         array{
     *             stat_name: string,
     *             stat_value: string,
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getCharacterStat(string $ocid): array
    {
        $url = 'character/stat?ocid=' . $ocid;
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
     * 가입한 길드 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/maplestorym/?id=1
     *
     * @param string $ocid
     *
     * @return array{guild_name: string}
     *
     * @throws Exception
     */
    public function getCharacterGuild(string $ocid): array
    {
        $url = 'character/guild?ocid=' . $ocid;
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
     * getCharacterBeautyEquipment
     *
     * 장착 중인 헤어, 성형, 피부 정보를 조회합니다.
     * 장착 중인 헤어, 성형, 피부 정보는 2024년 5월 2일 이후 데이터를 조회할 수 있습니다.
     *
     * @link https://openapi.nexon.com/ko/game/maplestorym/?id=1
     *
     * @param string $ocid
     *
     * @return array{
     *     character_gender: string,
     *     character_class: string,
     *     character_hair: array{
     *         hair_name: string,
     *         base_color: string,
     *         mix_color: string,
     *         mix_rate: string,
     *     },
     *     character_face: array{
     *         face_name: string,
     *         base_color: string,
     *         mix_color: string,
     *         mix_rate: string,
     *     },
     *     character_skin_name: string,
     *     additional_character_hair: array{
     *         hair_name: string,
     *         base_color: string,
     *         mix_color: string,
     *         mix_rate: string,
     *     },
     *     additional_character_face: array{
     *         face_name: string,
     *         base_color: string,
     *         mix_color: string,
     *         mix_rate: string,
     *     },
     *     additional_character_skin_name: string,
     * }
     *
     * @throws Exception
     */
    public function getCharacterBeautyEquipment(string $ocid): array
    {
        $url = 'character/beauty-equipment?ocid=' . $ocid;
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
     * getCharacterPetEquipment
     *
     * 장착한 펫 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/maplestorym/?id=1
     *
     * @param string $ocid
     *
     * @return array{
     *     pet_1_name: string,
     *     pet_1_pet_type: string,
     *     pet_1_date_expire: string,
     *     pet_2_name: string,
     *     pet_2_pet_type: string,
     *     pet_2_date_expire: string,
     *     pet_3_name: string,
     *     pet_3_pet_type: string,
     *     pet_3_date_expire: string,
     * }
     *
     * @throws Exception
     */
    public function getCharacterPetEquipment(string $ocid): array
    {
        $url = 'character/pet-equipment?ocid=' . $ocid;
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
     * getCharacterSkillEquipment
     *
     * 캐릭터가 장착중인 스킬 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/maplestorym/?id=1
     *
     * @param string $ocid
     *
     * @return array{
     *     character_class: string,
     *     skill: array{
     *         equipment_skill: array{
     *             array{
     *                 skill_mode: int,
     *                 equipment_skill_set: string,
     *                 slot_id: string,
     *                 skill_name: string,
     *                 skill_type: string,
     *                 skill_grade: string,
     *                 add_feature_flag: string,
     *             },
     *         },
     *         preset: array{
     *             array{
     *                 preset_slot_no: int,
     *                 skill_name_1: string,
     *                 skill_name_2: string,
     *                 skill_name_3: string,
     *                 skill_name_4: string,
     *                 preset_command_flag: string,
     *             },
     *         },
     *         steal_skill: array{
     *             array{
     *                 skill_name: string,
     *                 skill_slot: string,
     *             },
     *         },
     *         stella_memorize: array{
     *             array{
     *                 skill_name: string,
     *                 equipment_skill_set: string,
     *             },
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getCharacterSkillEquipment(string $ocid): array
    {
        $url = 'character/skill-equipment?ocid=' . $ocid;
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
     * getCharacterVmatrix
     *
     * V매트릭스 슬롯 정보와 장착한 V코어 정보를 조회합니다.
     * V매트릭스 슬롯 정보와 장착한 V코어 정보는 2022년 7월 7일 이후 데이터를 조회할 수 있습니다.
     *
     * @link https://openapi.nexon.com/ko/game/maplestorym/?id=1
     *
     * @param string $ocid
     *
     * @return array
     *
     * @throws Exception
     */
    public function getCharacterVmatrix(string $ocid): array
    {
        $url = 'character/vmatrix?ocid=' . $ocid;
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
     * 메이플스토리M 공지사항에 최근 등록된 게시글 20개를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/maplestorym/?id=25
     *
     * @return array{
     *     notice: array{
     *         array{
     *             title: string,
     *             url: string,
     *             notice_id: int,
     *             date: string,
     *             notice_tag: string[],
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getNotice(): array
    {
        $url = 'notice';
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
     * 메이플스토리M 공지사항 게시글 세부 사항을 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/maplestorym/?id=25
     *
     * @param int $noticeId
     *
     * @return array
     *
     * @throws Exception
     */
    public function getNoticeDetail(int $noticeId): array
    {
        $url = 'notice/detail?notice_id=' . $noticeId;
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
     * 메이플스토리M 패치노트에 최근 등록된 게시글 20개를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/maplestorym/?id=25
     *
     * @return array{
     *     patch_notice: array{
     *         array{
     *             title: string,
     *             url: string,
     *             notice_id: int,
     *             date: string,
     *             notice_tag: string[],
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getNoticePatch(): array
    {
        $url = 'notice-patch';
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
     * 메이플스토리M 패치노트 게시글 세부 사항을 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/maplestorym/?id=25
     *
     * @param int $noticeId
     *
     * @return array
     *
     * @throws Exception
     */
    public function getNoticePatchDetail(int $noticeId): array
    {
        $url = 'notice-patch/detail?notice_id=' . $noticeId;
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
     * 메이플스토리M 진행 중 이벤트에 최근 등록된 공지사항 20개를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/maplestorym/?id=25
     *
     * @return array{
     *     event_notice: array{
     *         array{
     *             title: string,
     *             url: string,
     *             notice_id: int,
     *             date: string,
     *             notice_tag: string[],
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getNoticeEvent(): array
    {
        $url = 'notice-event';
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
     * 메이플스토리M 진행 중 이벤트 게시글 세부 사항을 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/maplestorym/?id=25
     *
     * @param int $noticeId
     *
     * @return array{
     *     title: string,
     *     url: string,
     *     contents: string,
     *     date: string,
     *     notice_tag: string[],
     * }
     *
     * @throws Exception
     */
    public function getNoticeEventDetail(int $noticeId): array
    {
        $url = 'notice-event/detail?notice_id=' . $noticeId;
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
