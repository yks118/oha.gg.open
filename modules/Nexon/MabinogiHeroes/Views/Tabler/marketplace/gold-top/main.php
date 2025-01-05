<section id="view-nexon-mabinogi-heroes-marketplace-gold-top-main">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            ?>

            <div class="mb-3">
                <label class="form-label" for="type">거래 유형</label>
                <select class="form-select" name="type" id="type">
                    <option
                        value="buy"
                        <?php echo set_select('type', 'buy', isset($data['get']['type']) && $data['get']['type'] === 'buy'); ?>
                    >구매</option>
                    <option
                        value="sell"
                        <?php echo set_select('type', 'sell', isset($data['get']['type']) && $data['get']['type'] === 'sell'); ?>
                    >판매</option>
                </select>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label class="form-label" for="date_start">시작일</label>
                        <input
                            type="date" class="form-control" name="date_start" id="date_start" pattern="\d{4}-\d{2}-\d{2}" placeholder="yyyy-mm-dd" required
                            min="2025-01-03" max="<?php echo date('Y-m-d', strtotime('-8 day')); ?>"
                            value="<?php echo set_value('date_start', $data['get']['date_start'] ?? ''); ?>"
                        >
                    </div>
                </div>

                <div class="col">
                    <div class="mb-3">
                        <label class="form-label" for="date_end">종료일</label>
                        <input
                            type="date" class="form-control" name="date_end" id="date_end" pattern="\d{4}-\d{2}-\d{2}" placeholder="yyyy-mm-dd" required
                            min="2025-01-03" max="<?php echo date('Y-m-d', strtotime('-1 day')); ?>"
                            value="<?php echo set_value('date_start', $data['get']['date_end'] ?? ''); ?>"
                        >
                    </div>
                </div>
            </div>

            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-outline-success">검색</button>
            </div>

            <?php echo form_close(); ?>
        </div>

        <div class="card-footer">2025년 01월 03일 이후로 매일 23시 59분에 갱신됩니다.</div>
    </div>

    <?php
    if (isset($data['list']) && is_array($data['list']))
    {
        ?>
    <div class="row row-cards">
        <?php
        foreach ($data['list'] as $key => $eMarketplaceGoldTop)
        {
            if ($eMarketplaceGoldTop instanceof \Modules\Nexon\MabinogiHeroes\Entities\MarketplaceGoldTop)
            {
                ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <?php
                        $url = site_to('nexon_mabinogi_heroes_marketplace_gold_top_detail', $eMarketplaceGoldTop->date->format('Y-m-d'));
                        ?>
                        <a href="<?php echo $url; ?>"><?php echo $eMarketplaceGoldTop->date->format('Y-m-d'); ?></a>
                    </h3>
                </div>

                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <?php
                            $dataFirst = $eMarketplaceGoldTop->getDataFirst();
                            ?>
                            <div class="datagrid-title"><?php echo $dataFirst['ranking']; ?>위</div>
                            <div class="datagrid-content">
                                <?php
                                echo number_format($dataFirst['gold']);

                                if (isset($data['list'][$key + 1]))
                                {
                                    $dataFirstNext = $data['list'][$key + 1]->getDataFirst();
                                    if ($dataFirst['gold'] > $dataFirstNext['gold'])
                                    {
                                        ?>
                                <small class="text-success">+<?php echo number_format($dataFirst['gold'] - $dataFirstNext['gold']); ?></small>
                                        <?php
                                    }
                                    elseif ($dataFirst['gold'] < $dataFirstNext['gold'])
                                    {
                                        ?>
                                <small class="text-danger">-<?php echo number_format($dataFirstNext['gold'] - $dataFirst['gold']); ?></small>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="datagrid-item">
                            <?php
                            $dataLast = $eMarketplaceGoldTop->getDataLast();
                            ?>
                            <div class="datagrid-title"><?php echo $dataLast['ranking']; ?>위</div>
                            <div class="datagrid-content">
                                <?php
                                echo number_format($dataLast['gold']);

                                if (isset($data['list'][$key + 1]))
                                {
                                    $dataLastNext = $data['list'][$key + 1]->getDataFirst();
                                    if ($dataLast['gold'] > $dataLastNext['gold'])
                                    {
                                        ?>
                                <small class="text-success">+<?php echo number_format($dataLast['gold'] - $dataLastNext['gold']); ?></small>
                                        <?php
                                    }
                                    elseif ($dataLast['gold'] < $dataLastNext['gold'])
                                    {
                                        ?>
                                <small class="text-danger">-<?php echo number_format($dataLastNext['gold'] - $dataLast['gold']); ?></small>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">평균값</div>
                            <div class="datagrid-content">
                                <?php
                                $avg = array_avg($eMarketplaceGoldTop->getDataGolds());
                                echo number_format($avg);

                                if (isset($data['list'][$key + 1]))
                                {
                                    $avgNext = array_avg($data['list'][$key + 1]->getDataGolds());
                                    if ($avg > $avgNext)
                                    {
                                        ?>
                                <small class="text-success">+<?php echo number_format($avg - $avgNext); ?></small>
                                        <?php
                                    }
                                    elseif ($avg < $avgNext)
                                    {
                                        ?>
                                <small class="text-danger">-<?php echo number_format($avgNext - $avg); ?></small>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">중앙값</div>
                            <div class="datagrid-content">
                                <?php
                                $med = array_med($eMarketplaceGoldTop->getDataGolds());
                                echo number_format($med);

                                if (isset($data['list'][$key + 1]))
                                {
                                    $medNext = array_med($data['list'][$key + 1]->getDataGolds());
                                    if ($med > $medNext)
                                    {
                                        ?>
                                <small class="text-success">+<?php echo number_format($med - $medNext); ?></small>
                                        <?php
                                    }
                                    elseif ($med < $medNext)
                                    {
                                        ?>
                                <small class="text-danger">-<?php echo number_format($medNext - $med); ?></small>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">최빈값</div>
                            <div class="datagrid-content">
                                <?php
                                $mod = array_mod($eMarketplaceGoldTop->getDataGolds())[0];
                                echo number_format($mod);

                                if (isset($data['list'][$key + 1]))
                                {
                                    $modNext = array_mod($data['list'][$key + 1]->getDataGolds())[0];
                                    if ($mod > $modNext)
                                    {
                                        ?>
                                <small class="text-success">+<?php echo number_format($mod - $modNext); ?></small>
                                        <?php
                                    }
                                    elseif ($mod < $modNext)
                                    {
                                        ?>
                                <small class="text-danger">-<?php echo number_format($modNext - $mod); ?></small>
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
</section>
