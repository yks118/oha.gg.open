<?php
namespace Modules\Nexon\MabinogiHeroes\Entities;

use DateTime;
use Modules\Core\Entities\BaseEntity;

/**
 * @property ?DateTime $date
 * @property ?string $type
 * @property ?array{array{cairde_name: string, gold: int}} $data
 */
class MarketplaceGoldTop extends BaseEntity
{
    protected $casts = [
        'data' => '?json-array',
    ];

    protected $dates = [
        'date',
    ];

    /**
     * @return ?array{ranking: int, cairde_name: string, gold: int}
     */
    private ?array $dataFirst = null;

    public function getDataFirst(): array
    {
        if (is_null($this->dataFirst))
        {
            $this->dataFirst = $this->data[0];
            $this->dataFirst['ranking'] = 1;
        }

        return $this->dataFirst;
    }

    /**
     * @return ?array{ranking: int, cairde_name: string, gold: int}
     */
    private ?array $dataLast = null;

    public function getDataLast(): array
    {
        if (is_null($this->dataLast))
        {
            $key = count($this->data) - 1;
            $this->dataLast = $this->data[$key];
            $this->dataLast['ranking'] = $key + 1;
        }

        return $this->dataLast;
    }

    private ?array $dataGolds = null;

    public function getDataGolds(): array
    {
        if (is_null($this->dataGolds))
        {
            $this->dataGolds = array_column($this->data, 'gold');
        }

        return $this->dataGolds;
    }

    public function getTypeText(): string
    {
        return $this->type === 'b' ? '구매' : '판매';
    }
}
