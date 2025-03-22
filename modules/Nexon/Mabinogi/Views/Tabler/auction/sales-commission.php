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
        if (isset($data['commission'], $data['price']))
        {
            ?>
        <div class="card-footer">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">판매 수수료</div>
                    <div class="datagrid-content"><?php echo number_format($data['commission']); ?> Gold</div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">최종 가격</div>
                    <div class="datagrid-content">
                        <span
                            class="<?php echo $data['recommend'] === $data['price'] ? 'text-success' : 'text-danger';  ?>"
                        ><?php echo number_format($data['price']); ?> Gold</span>
                    </div>
                </div>
            </div>
        </div>
            <?php
        }
        ?>
    </div>

    <?php
    if (isset($data['items']) && is_array($data['items']))
    {
        ?>
    <div class="row row-cards">
        <?php
        foreach ($data['items'] as $rowItem)
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-header">
                    <div>
                        <div class="card-title"><?php echo $rowItem['item_name']; ?></div>
                        <div class="card-subtitle"><?php echo number_format($rowItem['min']); ?> Gold</div>
                    </div>
                </div>

                <?php
                if (isset($data['commission']))
                {
                    ?>
                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">판매 수수료 + 쿠폰 가격</div>
                            <div class="datagrid-content">
                                <?php
                                echo number_format($rowItem['commission']);
                                ?> Gold
                            </div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">최종 가격</div>
                            <div class="datagrid-content">
                                <span
                                    class="<?php echo $data['recommend'] === $rowItem['price'] ? 'text-success' : 'text-danger'; ?>"
                                ><?php echo number_format($rowItem['price']); ?> Gold</span>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
            <?php
        }
        ?>
    </div>
        <?php
    }
    ?>
</section>
