<?php
namespace Modules\Nexon\CrazyArcade\Libraries;

use Exception;

class Api extends \Modules\Nexon\Core\Libraries\Api
{
    protected string $urlPrefix = 'ca/v1/';

    public function __construct(string $api)
    {
        parent::__construct($api);
    }

    /**
     * getId
     *
     * 계정 식별자(ouid)를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/ca/?id=11
     *
     * @param string $userName
     * @param string $worldName
     *
     * @return array{ouid: string}
     *
     * @throws Exception
     */
    public function getId(string $userName, string $worldName): array
    {
        $url = 'id?user_name=' . $userName . '&world_name=' . $worldName;
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
     * getUserBasic
     *
     * 기본 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/ca/?id=11
     *
     * @param string $ouid
     *
     * @return array{
     *     user_name: string,
     *     user_date_create: string,
     *     user_date_last_login: string,
     *     user_date_last_logout: string,
     *     user_exp: int,
     *     user_level: int,
     * }
     *
     * @throws Exception
     */
    public function getUserBasic(string $ouid): array
    {
        $url = 'user/basic?ouid=' . $ouid;
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
     * getUserTitle
     *
     * 칭호 보유 정보를 조회합니다.
     * 칭호 등급(title_grade_name)은 2023년 11월 2일 획득(장착)한 칭호에 한해 조회할 수 있습니다.
     *
     * @link https://openapi.nexon.com/game/ca/?id=11
     *
     * @param string $ouid
     *
     * @return array{
     *     title: array{
     *         array{
     *             title_id: string,
     *             title_grade_name: string,
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getUserTitle(string $ouid): array
    {
        $url = 'user/title?ouid=' . $ouid;
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
     * getUserTitleEquipment
     *
     * 장착 칭호 정보를 조회합니다.
     * 칭호 등급(title_grade_name)은 2023년 11월 2일 획득(장착)한 칭호에 한해 조회할 수 있습니다.
     *
     * @link https://openapi.nexon.com/game/ca/?id=11
     *
     * @param string $ouid
     *
     * @return array{
     *     title_equipment: array{
     *         array{
     *             title_equipment_type: string,
     *             title_id: string,
     *             title_grade_name: string,
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getUserTitleEquipment(string $ouid): array
    {
        $url = 'user/title-equipment?ouid=' . $ouid;
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
     * getUserItemEquipment
     *
     * 장착 아이템 정보를 조회합니다.
     * 2024년 2월 15일부터 물풍선 장착 정보를 조회할 수 있습니다.
     *
     * @link https://openapi.nexon.com/game/ca/?id=11
     *
     * @param string $ouid
     *
     * @return array{
     *     item_equipment: array{
     *         array{
     *             item_equipment_slot: string,
     *             item_name: string,
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getUserItemEquipment(string $ouid): array
    {
        $url = 'user/item-equipment?ouid=' . $ouid;
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
     * getUserGuild
     *
     * 가입한 길드 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/ca/?id=11
     *
     * @param string $ouid
     *
     * @return array{guild_id: string}
     *
     * @throws Exception
     */
    public function getUserGuild(string $ouid): array
    {
        $url = 'user/guild?ouid=' . $ouid;
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
     * 크레이지 아케이드 공지사항에 최근 등록된 게시글 20개를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/ca/?id=26
     *
     * @return array{
     *     notice: array{
     *         array{
     *             title: string,
     *             url: string,
     *             notice_id: int,
     *             date: string,
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
     * 크레이지 아케이드 공지사항 게시글 세부 사항을 조회합니다.
     *
     * @link https://openapi.nexon.com/game/ca/?id=26
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
     * getNoticeMonthly
     *
     * 크레이지 아케이드 월간크아에 최근 등록된 게시글 20개를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/ca/?id=26
     *
     * @return array{
     *     monthly_notice: array{
     *         array{
     *             title: string,
     *             url: string,
     *             notice_id: int,
     *             date: string,
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getNoticeMonthly(): array
    {
        $url = 'notice-monthly';
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
     * getNoticeMonthlyDetail
     *
     * 크레이지 아케이드 월간크아 게시글 세부 사항을 조회합니다.
     *
     * @link https://openapi.nexon.com/game/ca/?id=26
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
    public function getNoticeMonthlyDetail(int $noticeId): array
    {
        $url = 'notice-monthly/detail?notice_id=' . $noticeId;
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
     * 크레이지 아케이드 크레이지 아케이드 이벤트에 최근 등록된 공지사항 20개를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/ca/?id=26
     *
     * @return array{
     *     event_notice: array{
     *         array{
     *             title: string,
     *             url: string,
     *             notice_id: int,
     *             date: string,
     *             date_event_start: string,
     *             date_event_end: string,
     *             ongoing_flag: string,
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
     * 크레이지 아케이드 이벤트 게시글 세부 사항을 조회합니다.
     *
     * @link https://openapi.nexon.com/game/ca/?id=26
     *
     * @param int $noticeId
     *
     * @return array{
     *     title: string,
     *     url: string,
     *     contents: string,
     *     date: string,
     *     date_event_start: string,
     *     date_event_end: string,
     *     ongoing_flag: string,
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
