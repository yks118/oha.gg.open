<?php
namespace Modules\Core\Controllers;

class RatioCalculator extends BaseController
{
    protected string $viewName = 'ratio-calculator';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('core_ratio_calculator'));
        $this->html->addTitle('비율 계산기');

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        if (count($data['data']['get']) > 0)
        {
            $ratio1 = (int) $data['data']['get']['ratio1'];
            $ratio2 = (int) $data['data']['get']['ratio2'];
            $price1 = (int) $data['data']['get']['price1'];
            $price2 = (int) $data['data']['get']['price2'];
            if (
                $ratio1 > 0 && $ratio2 > 0
                && ($price1 > 0 || $price2 > 0)
            )
            {
                if ($price1 <= 0 && $price2 > 0)
                {
                    $data['data']['price'] = $price2 / $ratio2 * $ratio1;
                }
                elseif ($price1 > 0 && $price2 <= 0)
                {
                    $data['data']['price'] = $price1 / $ratio1 * $ratio2;
                }

                if (isset($data['data']['price']))
                {
                    if (is_decimal($data['data']['price']))
                    {
                        list($num, $decimals) = explode('.', $data['data']['price']);
                        $data['data']['price'] = number_format($num) . '.' . $decimals;
                    }
                    else
                    {
                        $data['data']['price'] = number_format($data['data']['price']);
                    }
                }
            }
        }

        $this->cachePage(DAY);
        return $this->render($data);
    }
}
