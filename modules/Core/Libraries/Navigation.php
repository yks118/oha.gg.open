<?php
namespace Modules\Core\Libraries;

class Navigation
{
    private array $navigation = [];

    private string $nowHref = '';

    private string $childName = 'child';

    public function set(array $navigation): self
    {
        $this->navigation = $navigation;
        return $this;
    }

    public function add(array $navigation): self
    {
        $this->navigation[] = $navigation;
        return $this;
    }

    public function get(): array
    {
        return $this->navigation;
    }

    public function setNowHref(string $href): self
    {
        $this->nowHref = $href;
        [$this->navigation, ] = $this->setNowNavigation($this->navigation);
        return $this;
    }

    protected function setNowNavigation(array $navigation, bool $active = false): array
    {
        foreach ($navigation as $key => $row)
        {
            if (isset($row[$this->childName]) && is_array($row[$this->childName]))
            {
                [$navigation[$key][$this->childName], $active] = $this->setNowNavigation($row[$this->childName]);
                $navigation[$key]['active'] = $active;
            }
            else
            {
                $navigation[$key]['active'] = ($row['href'] === $this->nowHref);
                if ($active === false && $navigation[$key]['active'] === true)
                {
                    $active = true;
                }
            }
        }

        return [$navigation, $active];
    }
}
