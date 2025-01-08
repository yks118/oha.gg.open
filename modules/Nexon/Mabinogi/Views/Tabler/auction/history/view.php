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
                        <small><?php echo $eItemOption->dyeColor->name_full; ?></small>
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
    if (isset($data['history']['list']) && is_array($data['history']['list']))
    {
        ?>
    <div class="row row-cards">
        <?php
        foreach ($data['history']['list'] as $key => $eAuctionHistoryDate)
        {
            if ($eAuctionHistoryDate instanceof \Modules\Nexon\Mabinogi\Entities\AuctionHistoryDate)
            {
                ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-header">
                    <div>
                        <h3 class="card-title"><?php echo $eAuctionHistoryDate->date->format('Y-m-d'); ?></h3>
                        <p class="card-subtitle"><?php echo lang('Core.week.' . $eAuctionHistoryDate->date->format('w')); ?></p>
                    </div>
                </div>

                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">최소 가격</div>
                            <div class="datagrid-content">
                                <?php
                                echo number_format($eAuctionHistoryDate->min);

                                if (isset($data['history']['list'][$key + 1]))
                                {
                                    if ($eAuctionHistoryDate->min < $data['history']['list'][$key + 1]->min)
                                    {
                                        ?>
                                <small class="text-success">-<?php echo number_format($data['history']['list'][$key + 1]->min - $eAuctionHistoryDate->min); ?></small>
                                        <?php
                                    }
                                    elseif ($eAuctionHistoryDate->min > $data['history']['list'][$key + 1]->min)
                                    {
                                        ?>
                                <small class="text-danger">+<?php echo number_format($eAuctionHistoryDate->min - $data['history']['list'][$key + 1]->min); ?></small>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">최대 가격</div>
                            <div class="datagrid-content">
                                <?php
                                echo number_format($eAuctionHistoryDate->max);

                                if (isset($data['history']['list'][$key + 1]))
                                {
                                    if ($eAuctionHistoryDate->max < $data['history']['list'][$key + 1]->max)
                                    {
                                        ?>
                                <small class="text-success">-<?php echo number_format($data['history']['list'][$key + 1]->max - $eAuctionHistoryDate->max); ?></small>
                                        <?php
                                    }
                                    elseif ($eAuctionHistoryDate->max > $data['history']['list'][$key + 1]->max)
                                    {
                                        ?>
                                <small class="text-danger">+<?php echo number_format($eAuctionHistoryDate->max - $data['history']['list'][$key + 1]->max); ?></small>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">평균 가격</div>
                            <div class="datagrid-content">
                                <?php
                                $avgNow = $eAuctionHistoryDate->sum / $eAuctionHistoryDate->count;
                                echo number_format($avgNow);

                                if (isset($data['history']['list'][$key + 1]))
                                {
                                    $avgNext = $data['history']['list'][$key + 1]->sum / $data['history']['list'][$key + 1]->count;
                                    if ($avgNow < $avgNext)
                                    {
                                        ?>
                                <small class="text-success">-<?php echo number_format($avgNext - $avgNow); ?></small>
                                        <?php
                                    }
                                    elseif ($avgNow > $avgNext)
                                    {
                                        ?>
                                <small class="text-danger">+<?php echo number_format($avgNow - $avgNext); ?></small>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">거래량</div>
                            <div class="datagrid-content">
                                <?php
                                echo number_format($eAuctionHistoryDate->count);

                                if (isset($data['history']['list'][$key + 1]))
                                {
                                    if ($eAuctionHistoryDate->count < $data['history']['list'][$key + 1]->count)
                                    {
                                        ?>
                                <small class="text-danger">-<?php echo number_format($data['history']['list'][$key + 1]->count - $eAuctionHistoryDate->count); ?></small>
                                        <?php
                                    }
                                    elseif ($eAuctionHistoryDate->count > $data['history']['list'][$key + 1]->count)
                                    {
                                        ?>
                                <small class="text-success">+<?php echo number_format($eAuctionHistoryDate->count - $data['history']['list'][$key + 1]->count); ?></small>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <?php
            }
        }
        ?>
    </div>
        <?php
    }
    ?>

    <?php echo $data['history']['pagination'] ?? ''; ?>
</section>
