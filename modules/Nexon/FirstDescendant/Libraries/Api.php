<?php
namespace Modules\Nexon\FirstDescendant\Libraries;

use Exception;

class Api extends \Modules\Nexon\Core\Libraries\Api
{
    protected string $urlPrefix = 'tfd/v1/';

    public function __construct(string $api)
    {
        parent::__construct($api);
    }

    /**
     * getId
     *
     * 계정 식별자(ouid)를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=20
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
     * getUserBasic
     *
     * 기본 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=20
     *
     * @param string $ouid
     *
     * @return array{
     *     ouid: string,
     *     user_name: string,
     *     platform_type: string,
     *     mastery_rank_level: int,
     *     mastery_rank_exp: int,
     *     title_prefix_id: string,
     *     title_suffix_id: string,
     *     os_language: string,
     *     game_language: string,
     * }
     *
     * @throws Exception
     */
    public function getUserBasic(string $ouid): array
    {
        $url = 'user/basic?ouid=' . rawurlencode($ouid);
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
     * getUserDescendant
     *
     * 장착한 계승자 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=20
     *
     * @param string $ouid
     *
     * @return array{
     *     ouid: string,
     *     user_name: string,
     *     descendant_id: string,
     *     descendant_slot_id: string,
     *     descendant_level: int,
     *     module_max_capacity: int,
     *     module_capacity: int,
     *     module: array{
     *         array{
     *             module_slot_id: string,
     *             module_id: string,
     *             module_enchant_level: int,
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getUserDescendant(string $ouid): array
    {
        $url = 'user/descendant?ouid=' . rawurlencode($ouid);
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
     * getUserWeapon
     *
     * 장착한 모든 슬롯의 무기를 조회합니다.
     * - 장착 모듈 정보의 경우 게임을 재접속하거나 매칭이 존재하는 콘텐츠를 완료한 후에 갱신됩니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=20
     *
     * @param string $ouid
     * @param string $languageCode
     *
     * @return array{
     *     ouid: string,
     *     user_name: string,
     *     weapon: array{
     *         array{
     *             module_max_capacity: int,
     *             module_capacity: int,
     *             weapon_slot_id: string,
     *             weapon_id: string,
     *             weapon_level: int,
     *             perk_ability_enchant_level: int,
     *             weapon_additional_stat: array{
     *                 array{
     *                     additional_stat_name: string,
     *                     additional_stat_value: string,
     *                 },
     *             },
     *             module: array{
     *                 array{
     *                     module_slot_id: string,
     *                     module_id: string,
     *                     module_enchant_level: int,
     *                 },
     *             },
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getUserWeapon(string $ouid, string $languageCode): array
    {
        $url = 'user/weapon?ouid=' . rawurlencode($ouid) . '&language_code=' . $languageCode;
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
     * getUserReactor
     *
     * 장착한 반응로 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=20
     *
     * @param string $ouid
     * @param string $languageCode
     *
     * @return array{
     *     ouid: string,
     *     user_name: string,
     *     reactor_id: string,
     *     reactor_slot_id: string,
     *     reactor_level: int,
     *     reactor_additional_stat: array{
     *         array{
     *             additional_stat_name: string,
     *             additional_stat_value: string,
     *         },
     *     },
     *     reactor_enchant_level: int,
     * }
     *
     * @throws Exception
     */
    public function getUserReactor(string $ouid, string $languageCode): array
    {
        $url = 'user/reactor?ouid=' . rawurlencode($ouid) . '&language_code=' . $languageCode;
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
     * getUserExternalComponent
     *
     * 장착한 모든 슬롯의 외장 부품 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=20
     *
     * @param string $ouid
     * @param string $languageCode
     *
     * @return array{
     *     ouid: string,
     *     user_name: string,
     *     external_component: array{
     *         array{
     *             external_component_slot_id: string,
     *             external_component_id: string,
     *             external_component_level: int,
     *             external_component_additional_stat: array{
     *                 array{
     *                     additional_stat_name: string,
     *                     additional_stat_value: string,
     *                 },
     *             },
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getUserExternalComponent(string $ouid, string $languageCode): array
    {
        $url = 'user/external-component?ouid=' . rawurlencode($ouid) . '&language_code=' . $languageCode;
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
     * getUserArcheTuning
     *
     * 아르케 조율 정보를 조회합니다.
     * 계승자 그룹별로 활성화한 노드와 해당 노드의 좌표를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=20
     *
     * @since 2025.03.27
     *
     * @param string $ouid
     * @param string $descendantGroupId
     *
     * @return array{
     *     ouid: string,
     *     descendant_group_id: string,
     *     arche_tuning_board_group_id: string,
     *     arche_tuning: array{array{
     *         slot_id: string,
     *         arche_tuning_board: array{array{
     *             arche_tuning_board_id: string,
     *             node: array{array{
     *                 node_id: string,
     *                 position_row: string,
     *                 position_column: string,
     *             }},
     *         }},
     *     }},
     * }
     *
     * @throws Exception
     */
    public function getUserArcheTuning(string $ouid, string $descendantGroupId): array
    {
        $url = 'user/arche-tuning?ouid=' . rawurlencode($ouid) . '&descendant_group_id=' . $descendantGroupId;
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
     * getRecommendationModule
     *
     * 사용자에게 적합한 모듈을 추천합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=22
     *
     * @param string $descendantId
     * @param string $weaponId
     * @param string $voidBattleId
     * @param string $period 조회 기간
     *                       0: 최근 7일
     *                       1: 최근 30일
     *                       2: 전체
     *
     * @return array
     *
     * @throws Exception
     */
    public function getRecommendationModule(string $descendantId, string $weaponId, string $voidBattleId, string $period): array
    {
        $url = 'recommendation/module?descendant_id=' . $descendantId . '&weapon_id=' . $weaponId . '&void_battle_id=' . $voidBattleId . '&period=' . $period;
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
