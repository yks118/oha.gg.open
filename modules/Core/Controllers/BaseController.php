<?php
namespace Modules\Core\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    protected \Modules\Core\Libraries\Html $html;

    protected \Modules\Core\Config\Cms $cms;

    protected \Modules\Core\Thema\BaseThema $thema;

    protected \Modules\Core\Libraries\Navigation $navigation;

    protected string $moduleName = 'Core';

    protected string $contentType = 'text/html';

    protected string $viewName = '';

    public function __construct()
    {
        // CI4 helpers
        $this->helpers[] = 'form';
        $this->helpers[] = 'text';
    }

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger): void
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->cms = core_config_cms();

        $classThema = '\Modules\Core\Thema\\' . $this->cms->thema . '\Thema';
        $this->thema = new $classThema();

        $this->html = core_services_html();
        $this->html
            ->setSiteName($this->cms->name)
            ->setTag($this->thema->getTag())
            ->setCss($this->thema->getCss())
            ->setJs($this->thema->getJs('header'), 'header')
            ->setJs($this->thema->getJs())
            ->setAttribute($this->thema->getAttribute())
            // ->addStrTag('<link rel="alternate" hreflang="ko" href="' . current_url() . '">') // 다국어 설정
        ;

        foreach ($this->cms->metaTag as $metaTag)
        {
            $this->html->addTag($metaTag);
        }

        // set ContentType
        $accept = $this->request->getHeaderLine('Accept');
        if ($this->cms->apiUse && $accept)
        {
            if (in_array('json', $this->cms->apiSupport) && in_array($accept, \Config\Mimes::$mimes['json']))
            {
                $this->contentType = 'application/json';
            }
            elseif (in_array('xml', $this->cms->apiSupport) && in_array($accept, \Config\Mimes::$mimes['xml']))
            {
                $this->contentType = 'application/xml';
            }
        }

        $this->navigation = core_services_navigation();
    }

    protected function error(array $data = [], int $statusCode = 400): ResponseInterface|string
    {
        $this->cachePage(0);
        $this->response->setStatusCode($statusCode);
        return match ($this->contentType)
        {
            'application/json'  => $this->response->setJSON($data),
            'application/xml'   => $this->response->setXML($data),
            default             => $this->render($data),
        };
    }

    protected function errorDB(int $code, string $message): ResponseInterface|string
    {
        return $this->error([
            'message'   => '[' . $code . '] ' . $message,
        ]);
    }

    protected function render(array $data = [], array $options = []): ResponseInterface|string
    {
        switch ($this->contentType)
        {
            case 'application/json':
                return $this->response->setJSON($data);
            case 'application/xml':
                return $this->response->setXML($data);
            default:
                if (empty($this->viewName))
                {
                    $page = '';
                }
                else
                {
                    $page = view(
                        '\Modules\\' . $this->moduleName . '\Views\\' . $this->cms->thema . '\\' . $this->viewName,
                        $data,
                        $options
                    );
                }

                if (empty($this->thema->getLayout()))
                {
                    $layout = $page;
                }
                else
                {
                    $layout = view(
                        '..' . DIRECTORY_SEPARATOR
                        . '..' . DIRECTORY_SEPARATOR
                        . 'modules' . DIRECTORY_SEPARATOR
                        . 'Core' . DIRECTORY_SEPARATOR
                        . 'Thema' . DIRECTORY_SEPARATOR
                        . $this->cms->thema . DIRECTORY_SEPARATOR
                        . 'Layout' . DIRECTORY_SEPARATOR
                        . $this->thema->getLayout(),
                        [
                            'page'  => $page,
                        ]
                    );
                }

                if (isset($data['message']) && $data['message'])
                {
                    $layout .= script('alert(\'' . $data['message'] . '\');');
                }

                if (isset($data['href']) && $data['href'])
                {
                    $layout .= script('window.location.href = \'' . $data['href'] . '\';');
                }

                return view(
                    '\Modules\Core\Views\html',
                    [
                        'layout'    => $layout,
                    ]
                );
        }
    }

    protected function show404()
    {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
}
