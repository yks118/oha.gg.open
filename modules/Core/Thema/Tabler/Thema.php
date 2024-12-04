<?php
namespace Modules\Core\Thema\Tabler;

use Modules\Core\Thema\BaseThema;

/**
 * @link https://tabler.io/admin-template
 * @link https://github.com/tabler/tabler
 */
class Thema extends BaseThema
{
    protected string $layout = 'default';

    public function __construct()
    {
        $lCdn = core_services_cdn();

        $this->css = [
            '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">',
            '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">',
        ];

        $this->js = [
            'header'    => [
                '<script type="text/javascript" src="' . $lCdn->get('/assets/tabler/js/app.min.js', is_prod()) . '"></script>',
            ],
            'footer'    => [
                '<script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>',
            ],
        ];

        $this->tag = [
            '<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">',
        ];

        $this->attribute = [
            'body'  => 'class="layout-fluid"',
        ];
    }
}
