<?php
namespace Modules\Nexon\BaramY\Libraries;

use Exception;

class Api extends \Modules\Nexon\Core\Libraries\Api
{
    protected string $urlPrefix = 'baramy/v1/';

    public function __construct(string $api)
    {
        parent::__construct($api);
    }

    /**
     * getId
     *
     * 캐릭터 식별자(ocid)를 조회합니다.
     *
     * @link https://openapi.nexon.com/game/baramy/?id=7
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
     *
     * @link https://openapi.nexon.com/game/baramy/?id=7
     *
     * @param string $ocid
     *
     * @return array{
     *     server_name: string,
     *     character_name: string,
     *     character_date_create: string,
     *     character_class_group_name: string,
     *     character_class_name: string,
     *     character_nation: string,
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
     * 칭호 타입(title_type_name)은 2022년 3월 18일 이후 획득(장착)한 칭호에 한해 조회할 수 있습니다.
     *
     * @link https://openapi.nexon.com/game/baramy/?id=7
     *
     * @param string $ocid
     *
     * @return array{
     *     title: array{
     *         array{
     *             title_type_name: string,
     *             title_name: string,
     *         },
     *     },
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
     * 칭호 타입(title_type_name)은 2022년 3월 18일 이후 획득(장착)한 칭호에 한해 조회할 수 있습니다.
     *
     * @link https://openapi.nexon.com/game/baramy/?id=7
     *
     * @param string $ocid
     *
     * @return array{
     *     title_equipment: array{
     *         array{
     *             title_equipment_type: string,
     *             title_type_name: string,
     *             title_name: string,
     *         },
     *     },
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
}
