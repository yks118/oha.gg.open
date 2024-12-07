<?php
namespace Modules\Nexon\MabinogiHeroes\Entities;

use Modules\Core\Entities\BaseEntity;

/**
 * @property ?string $type
 * @property ?string $name
 * @property ?string $grade
 * @property ?array $available_slot_name
 * @property ?array $stat
 */
class MetaEnchant extends BaseEntity
{
    protected $casts = [
        'available_slot_name'   => '?json',
        'stat'                  => '?json',
    ];

    protected $dates = [];

    private ?string $typeGrade = null;

    public function getTypeGrade(): string
    {
        if (is_null($this->typeGrade))
        {
            $this->typeGrade = '접' . ($this->type === '0' ? '두' : '미') . ' ' . $this->grade;
        }

        return $this->typeGrade;
    }

    /** @var ?string[] $availableSlotNameLanguage */
    private ?array $availableSlotNameLanguage = null;

    /**
     * @return string[]
     */
    public function getAvailableSlotNameLanguage(): array
    {
        if (is_null($this->availableSlotNameLanguage))
        {
            $this->availableSlotNameLanguage = array_map(
                function ($value)
                {
                    return lang('MabinogiHeroes.' . strtolower($value));
                },
                $this->available_slot_name
            );
        }

        return $this->availableSlotNameLanguage;
    }

    /** @var ?array{array{stat: string, goodBad: string}} $statGoodBad */
    private ?array $statGoodBad = null;

    /**
     * @return array{array{stat: string, goodBad: string}}
     */
    public function getStatGoodBad(): array
    {
        if (is_null($this->statGoodBad))
        {
            $this->statGoodBad = array_map(
                function ($value)
                {
                    $patterns = [
                        '공격력 [0-9]* ?증가',
                        '공격 ?속도 [0-9]* ?증가',
                        '대미지 증가',
                        '마나 [0-9]+ 회복',
                        '방어력 [0-9]+ 증가',
                        '밸런스 [0-9]+ 증가',
                        '생명력 [0-9]+ 증가',
                        '소량 회복',
                        '스태미나 [0-9]+ 증가',
                        '제한 해제 [0-9]+ 증가',
                        '지능 [0-9]+ 증가',
                        '추가 피해 [0-9]+%? 증가',
                        '크리티컬 [0-9]+% 증가',
                        '크리티컬 저항 [0-9]+% 증가',
                        '피해 [0-9]+% 감소',
                        '피해량 [0-9]+ 증가',
                        '힘 [0-9]+ 증가',
                        'SP [0-9]+ 회복',
                        'SP로 전환',
                    ];

                    return [
                        'stat'      => $value,
                        'goodBad'   => preg_match('/(' . implode('|', $patterns) . ')/', $value) ? '+' : '-',
                    ];
                },
                $this->stat
            );
        }

        return $this->statGoodBad;
    }
}
