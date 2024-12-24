<?php
namespace Modules\NcSoft\Core\Libraries;

use CodeIgniter\HTTP\CURLRequest;
use Exception;

class Api
{
    protected string $urlPrefix = '';

    protected CURLRequest $client;

    public function __construct(string $api)
    {
        $cCoreApi = ncsoft_core_config_api();

        $options = [
            'baseURI'   => $cCoreApi->domain . $this->urlPrefix,
            'timeout'   => $cCoreApi->timeout,
            'headers'   => [
                'accept'        => 'application/json',
                'Authorization' => 'Bearer ' . $api,
            ],
        ];

        $this->client = curl_request($options);
    }

    /**
     * @throws Exception
     */
    protected function error(array $data, int $statusCode)
    {
        throw new Exception('[' . $data['error']['name'] . '] ' . $data['error']['message'], $statusCode);
    }
}
