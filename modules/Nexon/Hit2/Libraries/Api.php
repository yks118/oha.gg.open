<?php
namespace Modules\Nexon\Hit2\Libraries;

use Exception;

class Api extends \Modules\Nexon\Core\Libraries\Api
{
    protected string $urlPrefix = 'hit2/v1/';

    public function __construct(string $api)
    {
        parent::__construct($api);
    }

    /**
     * getId
     *
     * 캐릭터 식별자(ocid)를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/hit2/?id=10
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
     * @link https://openapi.nexon.com/ko/game/hit2/?id=10
     *
     * @param string $ocid
     *
     * @return array{
     *     server_name: string,
     *     character_name: string,
     *     character_date_create: string,
     *     character_last_login: string,
     *     character_last_logout: string,
     *     character_class_group_name: string,
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
}
