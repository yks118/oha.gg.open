<?php
namespace Modules\Nexon\Mabinogi\Controllers;

class DyeColor extends BaseController
{
    protected string $viewName = 'dye-color';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_dye_color'));
        $this->html->addTitle('염색 색상 정보');

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];
        $mDyeColor = model(\Modules\Nexon\Mabinogi\Models\DyeColor::class);
        if ($this->request->is('post'))
        {
            $dataPost = $this->request->getPost();
            if (
                ! (
                    isset($dataPost['hex'], $dataPost['rgb'])
                    && (
                        $dataPost['hex']
                        || $dataPost['rgb']
                    )
                )
            )
            {
                $data['message'] = '색상 코드 입력은 필수입니다.';
                return $this->error($data);
            }
            elseif (
                ! (
                    isset($dataPost['name'], $dataPost['name_full'])
                    && (
                        $dataPost['name']
                        || $dataPost['name_full']
                    )
                )
            )
            {
                $data['message'] = '색상 이름 입력은 필수입니다.';
                return $this->error($data);
            }

            $dataInsert = [];
            if (preg_match('/^[0-9a-f]{6}$/', $dataPost['hex']))
            {
                $dataInsert['hex'] = $dataPost['hex'];
                $dataInsert['rgb'] = color_hex_to_rgb($dataPost['hex']);
            }
            elseif (preg_match('/^[0-9]{1,3},[0-9]{1,3},[0-9]{1,3}$/', $dataPost['rgb']))
            {
                $dataInsert['hex'] = color_rgb_to_hex($dataPost['rgb']);
                $dataInsert['rgb'] = $dataPost['rgb'];
            }
            else
            {
                $data['message'] = '색상 정보를 확인해주세요.';
                return $this->error($data);
            }

            if ($dataPost['name'] && empty($dataPost['name_full']))
            {
                $dataInsert['name']         = $dataPost['name'];
                $dataInsert['name_full']    = $dataPost['name'];
            }
            elseif (empty($dataPost['name']) && $dataPost['name_full'])
            {
                $dataInsert['name']         = $dataPost['name_full'];
                $dataInsert['name_full']    = $dataPost['name_full'];
            }
            elseif ($dataPost['name'] && $dataPost['name_full'])
            {
                $dataInsert['name']         = $dataPost['name'];
                $dataInsert['name_full']    = $dataPost['name_full'];
            }

            try
            {
                $mDyeColor->insert($dataInsert);
                $mDyeColor->delCache();
                return $this->response->redirect(site_to('nexon_mabinogi_dye_color') . '?keyword=rgb:' . $dataInsert['rgb']);
            }
            catch (\ReflectionException $e) {
                return $this->errorDB($e->getCode(), $e->getMessage());
            }
        }

        if (isset($data['data']['get']['keyword']) && $data['data']['get']['keyword'])
        {
            $mDyeColor->search($data['data']['get']['keyword']);
        }

        $data['data']['list']       = $mDyeColor->paginate(12);
        $data['data']['pagination'] = $mDyeColor->pager->links(template: 'thema');
        $data['data']['total']      = $mDyeColor->pager->getTotal();

        // $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
