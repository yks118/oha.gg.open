<section id="view-nexon-first-descendant-meta-fellow-detail">
    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        $row = $data['response'];
        $languageCode = $data['get']['language_code'];
        ?>
    <div class="card mb-3">
        <div class="card-header">
            <div>
                <h3 class="card-title"><?php echo $row['fellow_name']; ?></h3>
                <p class="card-subtitle"><?php echo nexon_first_descendant_meta_tier_id($row['fellow_tier_id'], $languageCode); ?></p>
            </div>
        </div>

        <?php
        $rowFellowDetailEnd = $row['fellow_detail'][count($row['fellow_detail']) - 1];
        ?>
        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">
                        <?php echo lang('NexonFirstDescendant.search_radius_value'); ?>
                        <small>Lv 1 / Lv <?php echo $rowFellowDetailEnd['fellow_level']; ?></small>
                    </div>
                    <div class="datagrid-content">
                        <?php echo number_format($row['fellow_detail'][0]['search_radius_value']); ?>
                        /
                        <?php echo number_format($rowFellowDetailEnd['search_radius_value']); ?>
                        <small class="text-success">+<?php echo number_format($rowFellowDetailEnd['search_radius_value'] - $row['fellow_detail'][0]['search_radius_value']); ?></small>
                    </div>
                </div>

                <?php
                foreach ($row['fellow_detail'][0]['stat_effect'] as $keyStatEffect => $rowStatEffect)
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title">
                        <?php echo nexon_first_descendant_meta_stat_id($rowStatEffect['stat_id']); ?>
                        <small>Lv 1 / Lv <?php echo $rowFellowDetailEnd['fellow_level']; ?></small>
                    </div>
                    <div class="datagrid-content">
                        <?php echo number_format_float($rowStatEffect['stat_value']); ?>
                        /
                        <?php echo number_format_float($rowFellowDetailEnd['stat_effect'][$keyStatEffect]['stat_value']); ?>
                        <small class="text-success">+<?php echo number_format_float($rowFellowDetailEnd['stat_effect'][$keyStatEffect]['stat_value'] - $rowStatEffect['stat_value']); ?></small>
                    </div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="row row-cards">
        <?php
        foreach ($row['fellow_detail'] as $keyFellowDetail => $rowFellowDetail)
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.fellow_level'); ?></div>
                            <div class="datagrid-content"><?php echo $rowFellowDetail['fellow_level']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.search_radius_value'); ?></div>
                            <div class="datagrid-content">
                                <?php
                                echo number_format($rowFellowDetail['search_radius_value']);

                                if ($keyFellowDetail > 0 && $rowFellowDetail['search_radius_value'] !== $row['fellow_detail'][$keyFellowDetail - 1]['search_radius_value'])
                                {
                                    ?>
                                <small class="text-success">+<?php echo number_format($rowFellowDetail['search_radius_value'] - $row['fellow_detail'][$keyFellowDetail - 1]['search_radius_value']); ?></small>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <?php
                        foreach ($rowFellowDetail['stat_effect'] as $keyStatEffect => $rowStatEffect)
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo nexon_first_descendant_meta_stat_id($rowStatEffect['stat_id']); ?></div>
                            <div class="datagrid-content">
                                <?php
                                echo number_format_float($rowStatEffect['stat_value']);

                                if ($keyFellowDetail > 0 && $rowStatEffect['stat_value'] !== $row['fellow_detail'][$keyFellowDetail - 1]['stat_effect'][$keyStatEffect]['stat_value'])
                                {
                                    ?>
                                <small class="text-success">+<?php echo number_format_float($rowStatEffect['stat_value'] - $row['fellow_detail'][$keyFellowDetail - 1]['stat_effect'][$keyStatEffect]['stat_value']); ?></small>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
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
