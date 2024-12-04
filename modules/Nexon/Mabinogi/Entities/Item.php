<?php
namespace Modules\Nexon\Mabinogi\Entities;

use DateTime;
use Modules\Core\Entities\BaseEntity;

/**
 * @property ?string $uuid
 * @property ?string $md5
 * @property ?string $serialize
 * @property ?string $item_name
 * @property ?string $item_display_name
 * @property ?DateTime $created_at
 * @property ?DateTime $updated_at
 *
 * @property ?ItemOption[] $option
 */
class Item extends BaseEntity
{
    protected $casts = [];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    /** @var ?ItemOption[] $option */
    private ?array $option = null;

    /**
     * @return ItemOption[]
     */
    protected function getOption(): array
    {
        if (is_null($this->option))
        {
            $mItemOption = model(\Modules\Nexon\Mabinogi\Models\ItemOption::class);
            $this->option = $mItemOption->where('item_uuid', $this->uuid)->findAll();
        }

        return $this->option;
    }

    /** @var ?array{href: string, text: string} $urlViews */
    private ?array $urlViews = null;

    /**
     * @return array{string, array{href: string, text: string}}
     */
    public function getUrlViews(): array
    {
        if (is_null($this->urlViews))
        {
            $this->urlViews['item_name'] = [
                'href'  => site_to('nexon_mabinogi_auction_history_view', 'item_name', $this->item_name),
                'text'  => '이름으로 통계 확인',
            ];

            $this->urlViews['uuid'] = [
                'href'  => site_to('nexon_mabinogi_auction_history_view', 'uuid', $this->uuid),
                'text'  => '이름 및 옵션이 일치하는 통계 확인',
            ];

            // Ex. 축복받은 ~, 폭스 자이언트~, 등등..
            if ($this->item_name !== $this->item_display_name)
            {
                $this->urlViews['item_display_name'] = [
                    'href'  => site_to('nexon_mabinogi_auction_history_view', 'item_display_name', $this->item_display_name),
                    'text'  => '접두 혹은 접미가 붙은 이름으로 통계 확인',
                ];
            }
        }

        return $this->urlViews;
    }
}
