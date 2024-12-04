<?php
namespace Modules\Core\Config;

class Cms
{
    public string $name = '';

    public string $thema = 'Tabler';

    /** @var string[] $metaTag */
    public array $metaTag = [
        '<meta charset="UTF-8">',
        '<meta name="Generator" content="CodeIgniter ' . \CodeIgniter\CodeIgniter::CI_VERSION . '">',
        '<meta http-equiv="X-UA-Compatible" content="IE=edge">',
        '<link rel="icon" type="image/icon" href="/favicon.ico">', // favicon
        '<meta name="robots" content="index,follow">',
        // '<meta name="keyword" content="">',
        // '<meta name="description" content="">',
        // '<meta name="author" content="">',
    ];

    public string $redirectURLName = 'redirectURL';

    public string $searchName = 'keyword';

    public bool $apiUse = false;

    public array $apiSupport = ['json', 'xml'];

    /** @var string $proxyIpv4 ipv4 에서만 작동하는 api 를 위한 설정 */
    public string $proxyIpv4 = '';

    public function __construct()
    {
        $this->metaTag[] = '<link rel="canonical" href="' . current_url() . '">';
        $this->metaTag[] = '<base href="' . site_url() . '" target="_self">';
    }
}
