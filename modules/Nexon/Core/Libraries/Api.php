<?php
namespace Modules\Nexon\Core\Libraries;

use CodeIgniter\HTTP\CURLRequest;
use Exception;

class Api
{
    protected string $urlPrefix = '';

    protected CURLRequest $client;

    public function __construct(string $api)
    {
        $cCoreApi = nexon_core_config_api();

        $options = [
            'baseURI'   => $cCoreApi->domain . $this->urlPrefix,
            'timeout'   => $cCoreApi->timeout,
            'headers'   => [
                'x-nxopen-api-key'  => $api,
            ],
        ];

        $cCms = core_config_cms();
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
