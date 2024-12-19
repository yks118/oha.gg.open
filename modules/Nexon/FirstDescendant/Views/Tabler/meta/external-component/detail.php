<section id="view-nexon-first-descendant-meta-external-component-detail">
    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        $row = $data['response'];
        $languageCode = $data['get']['language_code'];
        ?>
    <div class="card mb-3" id="<?php echo $row['external_component_id']; ?>">
        <div class="card-header">
            <div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $row['external_component_name']; ?>" src="<?php echo $row['image_url']; ?>">
                    </div>
                    <div class="col">
                        <h3 class="card-title">
                            <a href="<?php echo site_to('nexon_first_descendant_meta_external_component_detail', $row['external_component_id']); ?>"><?php echo $row['external_component_name']; ?></a>
                        </h3>
                        <p class="card-subtitle"><?php echo $row['external_component_id']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.external_component_equipment_type'); ?></div>
                    <div class="datagrid-content"><?php echo $row['external_component_equipment_type']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.external_component_tier'); ?></div>
                    <div class="datagrid-content"><?php echo $row['external_component_tier']; ?></div>
                </div>

                <?php
                $rowBaseStatEnd = $row['base_stat'][count($row['base_stat']) - 1];
                ?>
                <div class="datagrid-item">
                    <div class="datagrid-title">Lv. 1 / Lv. <?php echo $rowBaseStatEnd['level']; ?></div>
                    <div class="datagrid-content">
                        <?php echo number_format_float($row['base_stat'][0]['stat_value']); ?>
                        /
                        <?php echo number_format_float($rowBaseStatEnd['stat_value']); ?>
                        <small class="text-success">+<?php echo number_format_float($rowBaseStatEnd['stat_value'] - $row['base_stat'][0]['stat_value']); ?></small>
                    </div>
                </div>

                <?php
                foreach ($row['set_option_detail'] as $rowSetOptionDetail)
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo $rowSetOptionDetail['set_option']; ?> / <?php echo $rowSetOptionDetail['set_count']; ?></div>
                    <div class="datagrid-content"><?php echo nl2br($rowSetOptionDetail['set_option_effect']); ?></div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($row['base_stat'] as $keyBaseStat => $rowBaseStat)
            {
                ?>
            <div class="list-group-item">
                <div class="row align-items-center">
                    <div class="col-auto">Lv. <?php echo $rowBaseStat['level']; ?></div>
                    <div class="col text-truncate">
                        <div class="text-reset d-block"><?php echo nexon_first_descendant_meta_stat_id($rowBaseStat['stat_id'], $languageCode); ?></div>
                        <div class="d-block text-secondary text-truncate mt-n1">
                            <?php
                            echo number_format_float($rowBaseStat['stat_value']);

                            if ($keyBaseStat > 0)
                            {
                                ?>
                            <small class="text-success">+<?php echo number_format_float($rowBaseStat['stat_value'] - $row['base_stat'][$keyBaseStat - 1]['stat_value']); ?></small>
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
    </div>
        <?php
    }
    ?>
</section>
