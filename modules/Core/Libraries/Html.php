<?php
namespace Modules\Core\Libraries;

class Html
{
    /** @var string[] $css */
    private array $css = [];

    /** @var array{ header: string[], footer: string[] } $js */
    private array $js = [
        'header'    => [],
        'footer'    => [],
    ];

    /** @var string[] $title */
    private array $title = [];

    /** @var string[] $tag */
    private array $tag = [];

    private array $attribute = [];

    /**
     * @param string[] $css
     */
    public function setCss(array $css): self
    {
        $this->css = $css;
        return $this;
    }

    public function addCss(string $css): self
    {
        $this->css[] = $css;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getCss(): array
    {
        return $this->css;
    }

    /**
     * @param string[] $js
     */
    public function setJs(array $js, string $position = 'footer'): self
    {
        $this->js[$position] = $js;
        return $this;
    }

    public function addJs(string $js, string $position = 'footer'): self
    {
        $this->js[$position][] = $js;
        return $this;
    }

    public function getJs(string $position = 'footer'): array
    {
        return $this->js[$position] ?? [];
    }

    public function setSiteName(string $siteName): self
    {
        $this->title[0] = $siteName;
        return $this;
    }

    public function getSiteName(): string
    {
        return $this->title[0] ?? '';
    }

    public function addTitle(string $title): self
    {
        $this->title[] = $title;
        return $this;
    }

    public function getTitle(string $glue = ' < '): string
    {
        $title = $this->title;
        krsort($title);
        return implode($glue, $title);
    }

    public function setTag(array $tag): self
    {
        $this->tag = $tag;
        return $this;
    }

    public function addTag(string $tag): self
    {
        $this->tag[] = $tag;
        return $this;
    }

    public function getTag(): array
    {
        return $this->tag;
    }

    public function setAttribute(array $attribute): self
    {
        $this->attribute = $attribute;
        return $this;
    }

    public function addAttribute(string $name, string $value): self
    {
        $this->attribute[$name] = $value;
        return $this;
    }

    public function getAttribute(string $name): string
    {
        return $this->attribute[$name] ?? '';
    }
}
