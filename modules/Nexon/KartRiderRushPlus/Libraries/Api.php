<?php
namespace Modules\Nexon\KartRiderRushPlus\Libraries;

use Exception;

class Api extends \Modules\Nexon\Core\Libraries\Api
{
    protected string $urlPrefix = 'kartrush/v1/';

    public function __construct(string $api)
    {
        parent::__construct($api);
    }

    /**
     * getId
     *
     * 계정 식별자(ouid)를 조회합니다.
     * 라이더(계정) 명에 특수문자 '|'를 포함하는 경우 '_'로 변환 후 입력해주시길 바랍니다.
     * 예시) |카러플라이더| → _카러플라이더_
     *
     * @link https://openapi.nexon.com/game/kartrush/?id=8
     *
     * @param string $racerName
     *
     * @return array{
     *     ouid_info: array{
     *         array{
     *             ouid: string,
     *             racer_date_create: string,
     *             racer_level: string,
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getId(string $racerName): array
    {
        $url = 'id?racer_name=' . str_replace('|', '_', $racerName);
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
     * @link https://openapi.nexon.com/game/kartrush/?id=8
     *
     * @param string $ouid
     *
     * @return array{
     *     racer_name: string,
     *     racer_date_create: string,
     *     racer_date_last_login: string,
     *     racer_date_last_logout: string,
     *     racer_level: int,
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
     * getUserTitleEquipment
     *
     * 장착 칭호 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/kartrush/?id=8
     *
     * @param string $ouid
     *
     * @return array{
     *     title_equipment: array{
     *         array{
     *             title_name: string,
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
     * getNotice
     *
     * 카트라이더 러쉬플러스 공지사항에 최근 등록된 게시글 20개를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/kartrush/?id=27
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
     * 카트라이더 러쉬플러스 공지사항 게시글 세부 사항을 조회합니다.
     *
     * @link https://openapi.nexon.com/game/kartrush/?id=27
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
     * getNoticeSeason
     *
     * 카트라이더 러쉬플러스 시즌 알림판에 최근 등록된 게시글 20개를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/kartrush/?id=27
     *
     * @return array{
     *     season_notice: array{
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
    public function getNoticeSeason(): array
    {
        $url = 'notice-season';
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
     * getNoticeSeasonDetail
     *
     * 카트라이더 러쉬플러스 시즌 알림판 게시글 세부 사항을 조회합니다.
     *
     * @link https://openapi.nexon.com/game/kartrush/?id=27
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
    public function getNoticeSeasonDetail(int $noticeId): array
    {
        $url = 'notice-season/detail?notice_id=' . $noticeId;
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
     * 카트라이더 러쉬플러스 이벤트&대회 공지에 최근 등록된 공지사항 20개를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/kartrush/?id=27
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
     * 카트라이더 러쉬플러스 이벤트&대회 공지 게시글 세부 사항을 조회합니다.
     *
     * @link https://openapi.nexon.com/game/kartrush/?id=27
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
