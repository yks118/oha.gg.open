<section id="view-nexon-mabinogi-auction-history-view">
    <?php
    if (isset($data['eItem']) && $data['eItem'] instanceof \Modules\Nexon\Mabinogi\Entities\Item)
    {
        $eItem = $data['eItem'];
        ?>
    <div class="card mb-3">
        <div class="card-header">
            <div>
                <div class="row align-items-center">
                    <div class="col">
                        <div class="card-title"><?php echo $eItem->item_display_name; ?></div>
                        <div class="card-subtitle"><?php echo $eItem->item_name; ?></div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (count($eItem->option) > 0)
        {
            ?>
        <div class="card-body">
            <div class="datagrid">
                <?php
                foreach ($eItem->option as $eItemOption)
                {
                    if ($eItemOption instanceof \Modules\Nexon\Mabinogi\Entities\ItemOption)
                    {
                        ?>
                <div class="datagrid-item">
                    <div class="datagrid-title">
                        <?php
                        echo trim(
                            $eItemOption->option_type
                            . ' '
                            . $eItemOption->option_sub_type
                        );
                        ?>
                    </div>
                    <div class="datagrid-content">
                        <?php
                        if ($eItemOption->isColorPart())
                        {
                            ?>
                        <span class="avatar avatar-xs me-2 rounded" style="background-color: rgb(<?php echo $eItemOption->option_value; ?>);"></span>
                        <a href="<?php echo $eItemOption->search(); ?>"><?php echo $eItemOption->option_value; ?></a>
                            <?php
                            if ($eItemOption->dyeColor)
                            {
                                ?>
                        <small><?php echo $eItemOption->dyeColor->name; ?></small>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <a
                                href="<?php echo $eItemOption->search(); ?>"
                            ><?php echo trim($eItemOption->option_value . ' / ' . $eItemOption->option_value2, ' /0'); ?></a>
                            <?php
                            if ($eItemOption->option_desc)
                            {
                                ?>
                            <small><?php echo $eItemOption->option_desc; ?></small>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                        <?php
                    }
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

    <?php
    if (isset($data['history']['list'], $data['history']['total']) && is_array($data['history']['list']) && $data['history']['total'] > 0)
    {
        ?>
    <div class="card mb-3">
        <div class="card-header">
            <div>
                <div class="row align-items-center">
                    <div class="col">
                        <div class="card-title">거래 내역</div>
                        <div class="card-subtitle">
                            <span class="text-success">최소 가격: <?php echo number_format($data['history']['min']); ?></span>
                            /
                            평균 가격: <?php echo number_format($data['history']['avg']); ?>
                            /
                            <span class="text-danger">최대 가격: <?php echo number_format($data['history']['max']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($data['history']['list'] as $eAuctionHistory)
            {
                if ($eAuctionHistory instanceof \Modules\Nexon\Mabinogi\Entities\AuctionHistory)
                {
                    ?>
            <a class="list-group-item" href="<?php echo $eAuctionHistory->item->getUrlViews()['uuid']['href']; ?>">
                <div class="text-truncate">
                    <div class="text-reset d-block"><?php echo number_format($eAuctionHistory->auction_price_per_unit); ?></div>
                    <div class="d-block text-secondary text-truncate mt-n1"><?php echo $eAuctionHistory->date_auction_buy->format('Y-m-d H:i:s'); ?></div>
                </div>
            </a>
                    <?php
                }
            }
            ?>
        </div>

        <div class="card-footer">Total: <?php echo number_format($data['history']['total']); ?></div>
    </div>
        <?php
    }
    ?>

    <?php echo $data['history']['pagination'] ?? ''; ?>
</section>
