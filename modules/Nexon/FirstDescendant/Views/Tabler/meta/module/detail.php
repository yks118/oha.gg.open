<section id="view-nexon-first-descendant-meta-module-detail">
    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        $row = $data['response'];
        ?>
    <div class="card mb-3" id="<?php echo $row['module_id']; ?>">
        <div class="card-header">
            <div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $row['module_name']; ?>" src="<?php echo $row['image_url']; ?>">
                    </div>
                    <div class="col">
                        <h3 class="card-title"><?php echo $row['module_name']; ?></h3>
                        <p class="card-subtitle"><?php echo $row['module_id']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.module_type'); ?></div>
                    <div class="datagrid-content"><?php echo empty($row['module_type']) ? '&nbsp;' : $row['module_type']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.module_tier_id'); ?></div>
                    <div class="datagrid-content"><?php echo $row['module_tier_id']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.module_socket_type'); ?></div>
                    <div class="datagrid-content"><?php echo $row['module_socket_type']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.module_class'); ?></div>
                    <div class="datagrid-content"><?php echo $row['module_class']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.available_weapon_type'); ?></div>
                    <div class="datagrid-content">
                        <?php
                        echo implode(
                            ', ',
                            array_map(
                                function($value)
                                {
                                    return nexon_first_descendant_meta_weapon_type_id($value);
                                },
                                $row['available_weapon_type']
                            )
                        );
                        ?>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.available_descendant'); ?></div>
                    <div class="datagrid-content">
                        <?php
                        echo implode(
                            ', ',
                            array_map(
                                function($value)
                                {
                                    return nexon_first_descendant_meta_descendant_id($value)['descendant_name'] ?? $value;
                                },
                                $row['available_descendant_id']
                            )
                        );
                        ?>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.available_module_slot_type'); ?></div>
                    <div class="datagrid-content"><?php echo implode(',', $row['available_module_slot_type']); ?></div>
                </div>
            </div>
        </div>

        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($row['module_stat'] as $keyStat => $rowStat)
            {
                ?>
            <div class="list-group-item">
                <div class="row align-items-center">
                    <div class="col-auto">Lv. <?php echo $rowStat['level']; ?></div>
                    <div class="col text-truncate">
                        <div class="text-reset d-block" style="white-space: normal;"><?php echo nl2br($rowStat['value']); ?></div>
                        <div class="d-block text-secondary text-truncate mt-n1" style="white-space: normal;"><?php echo lang('NexonFirstDescendant.module_capacity'); ?>: <?php echo $rowStat['module_capacity']; ?></div>
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
