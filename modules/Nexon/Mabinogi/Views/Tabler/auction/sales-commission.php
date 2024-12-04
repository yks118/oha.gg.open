<section id="view-nexon-mabinogi-auction-sales-commission">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            $cApi = nexon_mabinogi_config_api();
            ?>

            <div class="mb-3">
                <label class="form-label" for="price">전체 가격</label>
                <input
                    type="number" class="form-control" name="price" id="price" required
                    value="<?php echo set_value('price', $data['get']['price'] ?? 0); ?>"
                >
            </div>

            <div class="mb-3">
                <label class="form-label" for="percent">프리미엄 유무</label>
                <select class="form-select" name="percent" id="percent">
                    <option
                        value="<?php echo $cApi->auctionSaleCommission['default']; ?>"
                        <?php
                        echo set_select(
                            'percent',
                            $cApi->auctionSaleCommission['default'],
                            $cApi->auctionSaleCommission['default'] === intval($data['get']['percent'] ?? 0)
                        );
                        ?>
                    >일반 <?php echo $cApi->auctionSaleCommission['default']; ?>%</option>

                    <option
                        value="<?php echo $cApi->auctionSaleCommission['premium']; ?>"
                        <?php
                        echo set_select(
                            'percent',
                            $cApi->auctionSaleCommission['premium'],
                            $cApi->auctionSaleCommission['premium'] === intval($data['get']['percent'] ?? 0)
                        );
                        ?>
                    >프리미엄 <?php echo $cApi->auctionSaleCommission['premium']; ?>%</option>
                </select>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-outline-success">확인</button>
            </div>

            <?php echo form_close(); ?>
        </div>

        <?php
        if (isset($data['stats']))
        {
            ?>
        <div class="card-footer"><?php echo number_format($data['get']['price']); ?> Gold</div>
            <?php
        }
        ?>
    </div>

    <?php
    if (isset($data['stats']))
    {
        ?>
    <div class="card mb-3">
        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">판매 수수료(%)</div>
                    <div class="datagrid-content"><?php echo $data['stats']['default']['percent']; ?> %</div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">판매 수수료(Gold)</div>
                    <div class="datagrid-content"><?php echo number_format($data['stats']['default']['commission']); ?> Gold</div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">수령 금액(Gold)</div>
                    <div class="datagrid-content"><?php echo number_format($data['stats']['default']['price']); ?> Gold</div>
                </div>
            </div>
        </div>
    </div>
        <?php

        foreach ($data['stats']['coupon'] as $row)
        {
            ?>
        <div class="card mb-3">
            <div class="card-body">
                <div class="datagrid">
                    <div class="datagrid-item">
                        <div class="datagrid-title">수수료 할인 쿠폰(%)</div>
                        <div class="datagrid-content"><?php echo $row['percent']; ?> %</div>
                    </div>

                    <div class="datagrid-item">
                        <div class="datagrid-title">할인 적용된 판매 수수료(Gold)</div>
                        <div class="datagrid-content"><?php echo number_format($row['commission']); ?> Gold</div>
                    </div>

                    <div class="datagrid-item">
                        <div class="datagrid-title">수령 금액(Gold)</div>
                        <div class="datagrid-content"><?php echo number_format($row['price']); ?> Gold</div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="datagrid">
                    <?php
                    $arrStats = [
                        'min'   => '최소',
                        'avg'   => '평균',
                        'max'   => '최대',
                    ];
                    foreach ($arrStats as $key => $value)
                    {
                        $price = $row['stats'][$key . '_price'];
                        ?>
                    <div class="datagrid-item">
                        <div class="datagrid-title"><?php echo $value; ?> 가격</div>
                        <div class="datagrid-content">
                            <?php echo number_format($row['stats'][$key]); ?> Gold

                            <?php
                            if ($price < 0)
                            {
                                ?>
                            <small class="text-danger"><?php echo number_format($price); ?> Gold</small>
                                <?php
                            }
                            else
                            {
                                ?>
                            <small class="text-success">+<?php echo number_format($price); ?> Gold</small>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                        <?php
                    }
                    ?>

                    <div class="datagrid-item">
                        <div class="datagrid-title">남은 수량</div>
                        <div class="datagrid-content">
                            <?php echo number_format($row['stats']['count_sum']); ?> 개
                            /
                            <?php echo number_format($row['stats']['count']); ?> 행
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php
        }
    }
    ?>
</section>
