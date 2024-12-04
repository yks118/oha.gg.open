<?php
namespace Modules\Nexon\Mabinogi\Controllers\Auction;

use Modules\Nexon\Mabinogi\Controllers\BaseController;

class SalesCommission extends BaseController
{
    protected string $viewName = 'auction/sales-commission';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_auction_sales_commission'));
        $this->html->addTitle('경매장 정보 조회')->addTitle('판매 수수료 계산기');

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        if (isset($data['data']['get']['price']) && $data['data']['get']['price'])
        {
            $price = (int) $data['data']['get']['price'];
            $percent = (int) $data['data']['get']['percent'];
            $data['data']['stats'] = [
                'default'   => [
                    'percent'       => $percent,
                    'commission'    => $price * $percent / 100,
                    'price'         => $price * (100 - $percent) / 100,
                ],
            ];

            $cApi = nexon_mabinogi_config_api();
            foreach ($cApi->auctionSaleCommissionCoupon as $coupon)
            {
                $commission = $data['data']['stats']['default']['commission'] * (100 - $coupon) / 100;
                $data['data']['stats']['coupon'][$coupon] = [
                    'percent'       => $coupon,
                    'commission'    => $commission,
                    'price'         => $price - $commission,

                    'stats' => [
                        'min'   => 0,
                        'avg'   => 0,
                        'max'   => 0,

                        'count'     => 0,
                        'count_sum' => 0,
                    ],
                ];
            }

            $mAuctionList = model(\Modules\Nexon\Mabinogi\Models\AuctionList::class);
            $list = $mAuctionList
                ->select('nexon_mabinogi_item.item_name')
                ->selectMin('nexon_mabinogi_auction_list.auction_price_per_unit', 'min')
                ->selectAvg('nexon_mabinogi_auction_list.auction_price_per_unit', 'avg')
                ->selectMax('nexon_mabinogi_auction_list.auction_price_per_unit', 'max')
                ->selectCount('*', 'count')
                ->selectSum('nexon_mabinogi_auction_list.item_count', 'count_sum')
                ->join('nexon_mabinogi_item', 'nexon_mabinogi_auction_list.item_uuid = nexon_mabinogi_item.uuid')
                ->like('nexon_mabinogi_item.item_name', '경매장 수수료 % 할인 쿠폰')
                ->groupBy('nexon_mabinogi_item.item_name')
                ->builder()
                ->get()
                ->getResultArray()
            ;
            foreach ($list as $row)
            {
                $avg = (int) $row['avg'];
                $couponPercent = str_replace(['경매장 수수료 ', '% 할인 쿠폰'], '', $row['item_name']);
                $data['data']['stats']['coupon'][$couponPercent]['stats'] = [
                    'min'       => $row['min'],
                    'min_price' => $data['data']['stats']['coupon'][$couponPercent]['price'] - $row['min'],

                    'avg'       => $avg,
                    'avg_price' => $data['data']['stats']['coupon'][$couponPercent]['price'] - $avg,

                    'max'       => $row['max'],
                    'max_price' => $data['data']['stats']['coupon'][$couponPercent]['price'] - $row['max'],

                    'count'     => $row['count'],
                    'count_sum' => $row['count_sum'],
                ];
            }
        }

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
