<?php
namespace Modules\Nexon\SuddenAttack\Libraries;

use Exception;

/**
 * @since 2025.03.20
 */
class Api extends \Modules\Nexon\Core\Libraries\Api
{
    protected string $urlPrefix = 'suddenattack/v1/';

    public function __construct(string $api)
    {
        parent::__construct($api);
    }

    /**
     * getId
     *
     * 계정 식별자(ouid)를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/suddenattack/?id=43
     *
     * @param string $userName
     *
     * @return array{ouid: string}
     *
     * @throws Exception
     */
    public function getId(string $userName): array
    {
        $url = 'id?user_name=' . $userName;
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
     * 계정 기본 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/suddenattack/?id=43
     *
     * @param string $ouid
     *
     * @return array{
     *     user_name: string,
     *     user_date_create: string,
     *     title_name: string,
     *     clan_name: string,
     *     manner_grade: string,
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
     * getUserRank
     *
     * 유저의 계급 정보를 조회합니다.
     * - 계급 정보는 게임 접속 종료 시 갱신됩니다.
     *
     * @link https://openapi.nexon.com/ko/game/suddenattack/?id=43
     *
     * @param string $ouid
     *
     * @return array{
     *     user_name: string,
     *     grade: string,
     *     grade_exp: int,
     *     grade_ranking: int,
     *     season_grade: string,
     *     season_grade_exp: int,
     *     season_grade_ranking: int,
     * }
     *
     * @throws Exception
     */
    public function getUserRank(string $ouid): array
    {
        $url = 'user/rank?ouid=' . $ouid;
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
     * getUserTier
     *
     * 유저의 티어 정보를 조회합니다.
     * - 티어 정보는 게임 접속 종료 시 갱신됩니다.
     *
     * @link https://openapi.nexon.com/ko/game/suddenattack/?id=43
     *
     * @param string $ouid
     *
     * @return array{
     *     user_name: string,
     *     solo_rank_match_tier: int,
     *     solo_rank_match_score: int,
     *     party_rank_match_tier: int,
     *     party_rank_match_score: int,
     * }
     *
     * @throws Exception
     */
    public function getUserTier(string $ouid): array
    {
        $url = 'user/tier?ouid=' . $ouid;
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
     * getUserRecentInfo
     *
     * 유저의 최근 동향 정보를 조회합니다.
     * - 최근 동향 정보는 매치 종료 시 갱신됩니다.
     * - 최근 특수총 킬데스 정보는 2025년 3월 20일 11시 7분 이후 정보부터 확인이 가능합니다.
     *
     * @link https://openapi.nexon.com/ko/game/suddenattack/?id=43
     *
     * @param string $ouid
     *
     * @return array{
     *     user_name: string,
     *     recent_win_rate: int,
     *     recent_kill_death_rate: int,
     *     recent_assault_rate: int,
     *     recent_sniper_rate: int,
     *     recent_special_rate: int,
     * }
     *
     * @throws Exception
     */
    public function getUserRecentInfo(string $ouid): array
    {
        $url = 'user/recent-info?ouid=' . $ouid;
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
     * getMatch
     *
     * 유저의 최근 매치 목록을 조회합니다.
     * - 매치는 최대 1000개까지 조회 가능합니다.
     *
     * @link https://openapi.nexon.com/ko/game/suddenattack/?id=44
     *
     * @param string $ouid
     * @param string $matchMode 게임 모드 (\Modules\Nexon\SuddenAttack\Config::$match['mode'])
     * @param string $matchType 매치 유형 (\Modules\Nexon\SuddenAttack\Config::$match['type'])
     *
     * @return array
     *
     * @throws Exception
     */
    public function getMatch(string $ouid, string $matchMode, string $matchType = ''): array
    {
        $url = 'match?ouid=' . $ouid . '&match_mode=' . $matchMode . '&match_type=' . $matchType;
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
     * getMatchDetail
     *
     * 매치 고유 식별자(match_id)로 매치의 상세 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/suddenattack/?id=44
     *
     * @param string $matchId
     *
     * @return array{
     *     match_id: string,
     *     match_type: string,
     *     match_mode: string,
     *     date_match: string,
     *     match_map: string,
     *     match_detail: array{array{
     *         team_id: string,
     *         match_result: string,
     *         user_name: string,
     *         season_grade: string,
     *         clan_name: string,
     *         kill: int,
     *         death: int,
     *         headshot: int,
     *         damage: int,
     *         assist: int,
     *     }},
     * }
     *
     * @throws Exception
     */
    public function getMatchDetail(string $matchId): array
    {
        $url = 'match-detail?match_id=' . $matchId;
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
