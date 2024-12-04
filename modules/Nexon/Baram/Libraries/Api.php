<?php
namespace Modules\Nexon\Baram\Libraries;

use Exception;

class Api extends \Modules\Nexon\Core\Libraries\Api
{
    protected string $urlPrefix = 'baram/v1/';

    public function __construct(string $api)
    {
        parent::__construct($api);
    }

    /**
     * getId
     *
     * 캐릭터 식별자(ocid)를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/baram/?id=13
     *
     * @param string $serverName
     * @param string $characterName
     *
     * @return array{ocid: string}
     *
     * @throws Exception
     */
    public function getId(string $serverName, string $characterName): array
    {
        $url = 'id?server_name=' . $serverName . '&character_name=' . $characterName;
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
     * @link https://openapi.nexon.com/game/baram/?id=13
     *
     * @param string $ocid
     *
     * @return array{
     *     character_name: string,
     *     character_date_create: string,
     *     character_create_type_name: string,
     *     character_class_name: string,
     *     character_nation_name: string,
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
     * getCharacterTitle
     *
     * 칭호 보유 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/baram/?id=13
     *
     * @param string $ocid
     *
     * @return array{
     *     title: array{
     *         array{
     *             title_id: string,
     *             date_expire: string,
     *         }
     *     }
     * }
     *
     * @throws Exception
     */
    public function getCharacterTitle(string $ocid): array
    {
        $url = 'character/title?ocid=' . $ocid;
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
     * getCharacterTitleEquipment
     *
     * 장착 칭호 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/baram/?id=13
     *
     * @param string $ocid
     *
     * @return array{
     *     title_equipment: array{
     *         array{
     *             title_id: string,
     *             date_expire: string,
     *         }
     *     }
     * }
     *
     * @throws Exception
     */
    public function getCharacterTitleEquipment(string $ocid): array
    {
        $url = 'character/title-equipment?ocid=' . $ocid;
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
     * @link https://openapi.nexon.com/game/baram/?id=13
     *
     * @param string $ocid
     *
     * @return array{
     *     item_equipment: array{
     *         array{
     *             item_id: string,
     *             item_equipment_slot_name: string,
     *         }
     *     }
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
     * 능력치 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/baram/?id=13
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
     * 가입한 길드(문파) 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/baram/?id=13
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
}
