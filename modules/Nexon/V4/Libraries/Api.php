<?php
namespace Modules\Nexon\V4\Libraries;

use Exception;

class Api extends \Modules\Nexon\Core\Libraries\Api
{
    protected string $urlPrefix = 'v4/v1/';

    public function __construct(string $api)
    {
        parent::__construct($api);
    }

    /**
     * getId
     *
     * 캐릭터 식별자(ocid)를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/v4/?id=9
     *
     * @param string $characterName
     *
     * @return array{ocid: string}
     *
     * @throws Exception
     */
    public function getId(string $characterName): array
    {
        $url = 'id?character_name=' . $characterName;
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
     * @link https://openapi.nexon.com/ko/game/v4/?id=9
     *
     * @param string $ocid
     *
     * @return array{
     *     server_name: string,
     *     character_name: string,
     *     character_date_create: string,
     *     character_create_type: string,
     *     character_date_last_login: string,
     *     character_date_last_logout: string,
     *     character_class_name: string,
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
     * getCharacterHonor
     *
     * 명예 보유 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/v4/?id=9
     *
     * @param string $ocid
     *
     * @return array{
     *     honor: array{
     *         array{
     *             honor_type_name: string,
     *             honor_name: string,
     *             date_expire: string,
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getCharacterHonor(string $ocid): array
    {
        $url = 'character/honor?ocid=' . $ocid;
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
     * getCharacterHonorEquipment
     *
     * 장착 명예 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/v4/?id=9
     *
     * @param string $ocid
     *
     * @return array{
     *     honor_equipment: array{
     *         array{
     *             honor_type_name: string,
     *             honor_name: string,
     *             date_expire: string,
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getCharacterHonorEquipment(string $ocid): array
    {
        $url = 'character/honor-equipment?ocid=' . $ocid;
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
