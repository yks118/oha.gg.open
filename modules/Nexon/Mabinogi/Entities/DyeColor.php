<?php
namespace Modules\Nexon\Mabinogi\Entities;

use CodeIgniter\HTTP\URI;
use Modules\Core\Entities\BaseEntity;

/**
 * @property ?string $hex
 * @property ?string $rgb
 * @property ?string $name
 * @property ?string $name_full
 */
class DyeColor extends BaseEntity
{
    protected $casts = [];

    protected $dates = [];

    /** @var ?array{href: string, text: string} $urlViews */
    private ?array $urlViews = null;

    /**
     * @return array{string, array{href: string, text: string}}
     */
    public function getUrlViews(): array
    {
        $cCms = core_config_cms();
        if (is_null($this->urlViews))
        {
            $uri = new URI(site_to('nexon_mabinogi_auction_list'));
            $uri->addQuery($cCms->searchName, 'option_value:"' . $this->rgb . '"');
            $this->urlViews['auction_list'] = [
                'href'  => $uri,
                'text'  => '경매장 매물 검색',
            ];

            $uri = new URI(site_to('nexon_mabinogi_auction_history_main'));
            $uri->addQuery($cCms->searchName, 'option_value:"' . $this->rgb . '"');
            $this->urlViews['auction_history_main'] = [
                'href'  => $uri,
                'text'  => '경매장 거래 내역 조회',
            ];
        }

        return $this->urlViews;
    }
}
