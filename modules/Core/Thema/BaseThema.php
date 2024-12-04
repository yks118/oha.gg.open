<?php
namespace Modules\Core\Thema;

abstract class BaseThema
{
    /** @var string[] $css */
    protected array $css = [];

    /** @var array{ header: string[], footer: string[] } $js */
    protected array $js = [
        'header'    => [],
        'footer'    => [],
    ];

    /** @var string[] $tag */
    protected array $tag = [];

    protected array $attribute = [];

    protected string $layout = '';

    /**
     * @return string[]
     */
    public function getCss(): array
    {
        return $this->css;
    }

    /**
     * @return string[]
     */
    public function getJs(string $position = 'footer'): array
    {
        return $this->js[$position] ?? [];
    }

    /**
     * @return string[]
     */
    public function getTag(): array
    {
        return $this->tag;
    }

    public function getAttribute(): array
    {
        return $this->attribute;
    }

    public function setLayout(string $layout = ''): self
    {
        $this->layout = $layout;
        return $this;
    }

    public function getLayout(): string
    {
        return $this->layout;
    }
}
