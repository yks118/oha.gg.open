<?php
namespace Modules\Nexon\Supervive\Libraries;

use Exception;

class Api extends \Modules\Nexon\Core\Libraries\Api
{
    protected string $urlPrefix = 'supervive/v1/';

    public function __construct(string $api)
    {
        parent::__construct($api);
    }

    /**
     * getId
     *
     * 사용자의 계정 식별자(ouid)를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/supervive/?id=38
     * @since 2025.01.16
     *
     * @param string $userName
     *
     * @return array{ouid: string}
     *
     * @throws Exception
     */
    public function getId(string $userName): array
    {
        $url = 'id?user_name=' . rawurlencode($userName);
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
     * getUserProfile
     *
     * 사용자의 프로필 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/supervive/?id=38
     * @since 2025.01.16
     *
     * @param string $ouid
     *
     * @return array{
     *     display_name: string,
     *     tag: string,
     *     account_level: int,
     *     rank: array{array{
     *         rank_type: string,
     *         rank_grade: string,
     *         rating: int,
     *     }},
     *     item: array{array{
     *         item_name: string,
     *         item_type: string,
     *         item_count: int,
     *     }},
     * }
     *
     * @throws Exception
     */
    public function getUserProfile(string $ouid): array
    {
        $url = 'user-profile?ouid=' . $ouid;
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
     * getMatchHistory
     *
     * 사용자의 지난 매치 전적을 조회합니다. (30개씩)
     *
     * @link https://openapi.nexon.com/ko/game/supervive/?id=39
     * @since 2025.01.16
     *
     * @param string $ouid
     * @param ?string $cursor
     *
     * @return array{
     *     next_cursor: string,
     *     match: array{array{
     *         match_id: string,
     *         date_match_start: string,
     *         date_match_end: string,
     *         queue_id: string,
     *         rank_mode_flag: string,
     *         map_id: string,
     *         stormshift: string,
     *         game_version: string,
     *         team_count: int,
     *         participant_count: int,
     *         hunter_name: string,
     *         hunter_level: string,
     *         team: array{
     *             team_id: string,
     *             placement: int,
     *             survival_duration: int,
     *             teammate: array{array{
     *                 player_ouid: string,
     *                 hunter_name: string,
     *                 party_id: string,
     *             }},
     *         },
     *         personal_stat: array{
     *             kill: int,
     *             death: int,
     *             assist: int,
     *             knock_out: int,
     *             knocked_out: int,
     *             resurrect_count: int,
     *             resurrected_count: int,
     *             recover_count: int,
     *             recovered_count: int,
     *             creep_kill_count: int,
     *             gold_from_creeps: int,
     *             gold_from_enemy: int,
     *             damage_dealt_total: int,
     *             damage_dealt_enemy: int,
     *             damage_taken_total: int,
     *             damage_taken_enemy: int,
     *             effective_damage_dealt_total: int,
     *             effective_damage_dealt_enemy: int,
     *             effective_damage_taken_total: int,
     *             effective_damage_taken_enemy: int,
     *             heal_given: int,
     *             heal_given_self: int,
     *             heal_received: int,
     *         },
     *     }},
     * }
     *
     * @throws Exception
     */
    public function getMatchHistory(string $ouid, ?string $cursor = null): array
    {
        $url = 'match-history?ouid=' . $ouid;
        if ($cursor)
        {
            $url .= '&cursor=' . $cursor;
        }

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
     * 특정 매치의 상세 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/supervive/?id=39
     * @since 2025.01.16
     *
     * @param string $matchId
     *
     * @return array{
     *     date_match_start: string,
     *     date_match_end: string,
     *     match_duration: int,
     *     queue_id: string,
     *     participant_count: int,
     *     team_count: int,
     *     map_id: string,
     *     stormshift: string,
     *     team: array{array{
     *         team_id: string,
     *         placement: int,
     *     }},
     *     player: array{array{
     *         player_ouid: string,
     *         hunter_name: string,
     *         team_id: string,
     *         party_id: string,
     *         rank_mode_flag: string,
     *         placement: int,
     *         survival_duration: int,
     *         character_level: int,
     *         stat: array{
     *             kill: int,
     *             max_kill_streak: int,
     *             death: int,
     *             assist: int,
     *             knock: int,
     *             max_knock_streak: int,
     *             knocked: int,
     *             resurrect: int,
     *             resurrected: int,
     *             recover: int,
     *             recovered: int,
     *             alive_duration: int,
     *             dead_duration: int,
     *             knocked_duration: int,
     *             creep_kill: int,
     *             gold_from_treasure: int,
     *             gold_from_creep: int,
     *             gold_from_enemy: int,
     *             damage_dealt_total: int,
     *             damage_dealt_enemy: int,
     *             damage_taken_total: int,
     *             damage_taken_enemy: int,
     *             effective_damage_dealt_total: int,
     *             effective_damage_dealt_enemy: int,
     *             effective_damage_taken_total: int,
     *             effective_damage_taken_enemy: int,
     *             heal_given: int,
     *             heal_given_self: int,
     *             heal_received: int,
     *         },
     *         item: array{array{
     *             slot_id: string,
     *             item_type: string,
     *             item_name: string,
     *         }},
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
