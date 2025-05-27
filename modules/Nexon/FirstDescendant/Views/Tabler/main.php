<section id="view-nexon-first-descendant-main">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            ?>

            <div class="mb-3">
                <label class="form-label" for="user_name"><?php echo lang('NexonFirstDescendant.user_name'); ?></label>
                <input
                    type="text" class="form-control" name="user_name" id="user_name" required
                    value="<?php echo set_value('user_name', $data['get']['user_name'] ?? ''); ?>"
                >
            </div>

            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-outline-success"><?php echo lang('Core.button.search'); ?></button>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>

    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        if (isset($data['response']['basic']) && is_array($data['response']['basic']))
        {
            $basic = $data['response']['basic'];
            ?>
    <div class="card mb-3" id="basic">
        <div class="card-header">
            <div>
                <h3 class="card-title"><?php echo $basic['user_name']; ?></h3>
                <p class="card-subtitle"><?php echo $basic['platform_type']; ?></p>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.mastery_rank_level'); ?></div>
                    <div class="datagrid-content">
                        <?php echo $basic['mastery_rank_level']; ?>
                        <small class="text-danger">/
                            <?php
                            $list = nexon_first_descendant_meta_mastery_rank_level_detail();
                            echo $list[count($list) - 1]['mastery_level'];
                            ?>
                        </small>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.mastery_rank_exp'); ?></div>
                    <div class="datagrid-content">
                        <?php
                        echo number_format($basic['mastery_rank_exp']);

                        $exp = nexon_first_descendant_meta_mastery_rank_level_detail_level($basic['mastery_rank_level']);
                        if ($exp > 0)
                        {
                            ?>
                        <small class="text-danger">/ <?php echo number_format($exp); ?></small>
                        <small class="text-info">/ <?php echo 100 - number_format($basic['mastery_rank_exp'] / $exp * 100, 2); ?>%</small>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.title_prefix'); ?></div>
                    <div class="datagrid-content"><?php echo nexon_first_descendant_meta_title_id($basic['title_prefix_id']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.title_suffix'); ?></div>
                    <div class="datagrid-content"><?php echo nexon_first_descendant_meta_title_id($basic['title_suffix_id']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.os_language'); ?></div>
                    <div class="datagrid-content"><?php echo $basic['os_language']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.game_language'); ?></div>
                    <div class="datagrid-content"><?php echo $basic['game_language']; ?></div>
                </div>
            </div>
        </div>

        <?php
        $medal = nexon_first_descendant_meta_medal_id($basic['medal_id'])['medal_detail'][$basic['medal_level'] - 1];
        ?>
        <div class="card-footer">
            <div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img
                            class="avatar"
                            alt="<?php echo $medal['medal_name']; ?>"
                            src="<?php echo $medal['medal_image_url']; ?>"
                        >
                    </div>
                    <div class="col">
                        <h3 class="card-title"><?php echo $medal['medal_name']; ?></h3>
                        <p class="card-subtitle mb-0"><?php echo $medal['medal_tier_id']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <?php
        }
        ?>
    <hr>
        <?php
        if (isset($data['response']['descendant']) && is_array($data['response']['descendant']))
        {
            $descendant = $data['response']['descendant'];
            $dataDescendant = nexon_first_descendant_meta_descendant_id($descendant['descendant_id']);
            ?>
    <div class="card mb-3" id="descendant">
        <div class="card-header">
            <div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $dataDescendant['descendant_name']; ?>" src="<?php echo $dataDescendant['descendant_image_url']; ?>">
                    </div>
                    <div class="col">
                        <h3 class="card-title">
                            <?php
                            $url = site_to('nexon_first_descendant_meta_descendant_detail', $dataDescendant['descendant_id']);
                            $url .= '?' . current_url(true)->getQuery();
                            ?>
                            <a href="<?php echo $url; ?>"><?php echo $dataDescendant['descendant_name']; ?></a>
                        </h3>
                        <p class="card-subtitle"><?php echo $dataDescendant['descendant_id']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.descendant_slot'); ?></div>
                    <div class="datagrid-content"><?php echo $descendant['descendant_slot_id']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.descendant_level'); ?></div>
                    <div class="datagrid-content">
                        <?php echo $descendant['descendant_level']; ?>
                        <small class="text-danger">/
                            <?php
                            $list = nexon_first_descendant_meta_descendant_level_detail();
                            echo $list[count($list) - 1]['descendant_level'];
                            ?>
                        </small>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.module_capacity'); ?></div>
                    <div class="datagrid-content">
                        <?php echo $descendant['module_capacity']; ?>
                        <small class="text-danger">/ <?php echo $descendant['module_max_capacity']; ?></small>
                        <small class="text-info">/
                            <?php echo $descendant['module_max_capacity'] - $descendant['module_capacity']; ?>
                        </small>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.energy_activator_use_count'); ?></div>
                    <div class="datagrid-content"><?php echo number_format($descendant['energy_activator_use_count']); ?></div>
                </div>
            </div>
        </div>

        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($descendant['module'] as $row)
            {
                $dataModule = nexon_first_descendant_meta_module_id($row['module_id']);
                $url = site_to('nexon_first_descendant_meta_module_detail', $row['module_id']);
                ?>
            <a class="list-group-item" href="<?php echo $url; ?>">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $dataModule['module_name']; ?>" src="<?php echo $dataModule['image_url']; ?>">
                    </div>
                    <div class="col text-truncate">
                        <div class="text-reset d-block"><?php echo $dataModule['module_name']; ?> / Lv. <?php echo $row['module_enchant_level']; ?></div>
                        <div class="d-block text-secondary text-truncate mt-n1" style="white-space: normal;"><?php echo $row['module_slot_id']; ?></div>
                    </div>
                </div>
            </a>
                <?php
            }
            ?>
        </div>
    </div>

            <?php
            if (count($descendant['customizing']) > 0)
            {
                ?>
    <div class="row row-cards">
                <?php
                foreach ($descendant['customizing'] as $rowCustomizing)
                {
                    $customizingItem = nexon_first_descendant_meta_customizing_item_id($rowCustomizing['customizing_item_id']);
                    ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-header">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img
                                    class="avatar"
                                    alt="<?php echo $customizingItem['customizing_item_id']; ?>"
                                    src="<?php echo $customizingItem['customizing_item_image_url']; ?>"
                                >
                            </div>
                            <div class="col">
                                <h3 class="card-title"><?php echo $customizingItem['customizing_item_name']; ?></h3>
                                <p class="card-subtitle">
                                    <?php echo $customizingItem['customizing_item_tier_id']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                    <?php
                    if (count($rowCustomizing['paint']) > 0)
                    {
                        ?>
                <div class="list-group list-group-flush list-group-hoverable">
                        <?php
                        foreach ($rowCustomizing['paint'] as $rowPaint)
                        {
                            $customizingItemPaint = nexon_first_descendant_meta_customizing_item_id($rowPaint['customizing_item_id']);
                            ?>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img
                                    class="avatar"
                                    alt="<?php echo $customizingItemPaint['customizing_item_id']; ?>"
                                    src="<?php echo $customizingItemPaint['customizing_item_image_url']; ?>"
                                >
                            </div>
                            <div class="col text-truncate">
                                <div class="text-reset d-block">
                                    <?php echo $customizingItemPaint['customizing_item_name']; ?>
                                </div>
                                <div class="d-block text-secondary text-truncate mt-n1" style="white-space: normal;">
                                    <?php echo $customizingItemPaint['customizing_item_tier_id']; ?>
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
            </div>
        </div>
                    <?php
                }
                ?>
    </div>
                <?php
            }
        }
        ?>
    <hr>
        <?php
        if (isset($data['response']['weapon']) && $data['response']['weapon'])
        {
            ?>
    <div class="row row-cards">
            <?php
            foreach ($data['response']['weapon'] as $row)
            {
                $dataWeapon = nexon_first_descendant_meta_weapon_id($row['weapon_id']);
                ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-header">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img class="avatar" alt="<?php echo $dataWeapon['weapon_name']; ?>" src="<?php echo $dataWeapon['image_url']; ?>">
                            </div>
                            <div class="col">
                                <h3 class="card-title">
                                    <?php
                                    $url = site_to('nexon_first_descendant_meta_weapon_detail', $dataWeapon['weapon_id']);
                                    $url .= '?' . current_url(true)->getQuery();
                                    ?>
                                    <a href="<?php echo $url; ?>"><?php echo $dataWeapon['weapon_name']; ?></a>
                                </h3>
                                <p class="card-subtitle"><?php echo $dataWeapon['weapon_tier_id'] . ' / ' . $dataWeapon['weapon_type'] . ' / ' . $dataWeapon['weapon_rounds_type']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.weapon_slot'); ?></div>
                            <div class="datagrid-content"><?php echo $row['weapon_slot_id']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.module_capacity'); ?></div>
                            <div class="datagrid-content">
                                <?php
                                if (empty($row['module_capacity']))
                                {
                                    echo '&nbsp;';
                                }
                                else
                                {
                                    echo $row['module_capacity'];
                                    ?>
                                <small class="text-danger">/ <?php echo $row['module_max_capacity']; ?></small>
                                <small class="text-info">
                                    /
                                    <?php echo $row['module_max_capacity'] - $row['module_capacity']; ?>
                                </small>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.weapon_slot'); ?></div>
                            <div class="datagrid-content"><?php echo $row['weapon_slot_id']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.weapon_level'); ?></div>
                            <div class="datagrid-content"><?php echo $row['weapon_level']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.perk_ability_enchant_level'); ?></div>
                            <div class="datagrid-content"><?php echo $row['perk_ability_enchant_level']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.energy_activator_use_count'); ?></div>
                            <div class="datagrid-content"><?php echo $row['energy_activator_use_count']; ?></div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="datagrid">
                        <?php
                        foreach ($row['weapon_additional_stat'] as $rowStat)
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo $rowStat['additional_stat_name']; ?></div>
                            <div class="datagrid-content"><?php echo number_format_float($rowStat['additional_stat_value']); ?></div>
                        </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <?php
                if (is_array($row['module']) && count($row['module']) > 0)
                {
                    ?>
                <div class="list-group list-group-flush list-group-hoverable">
                    <?php
                    foreach ($row['module'] as $rowModule)
                    {
                        $dataModule = nexon_first_descendant_meta_module_id($rowModule['module_id']);
                        $url = site_to('nexon_first_descendant_meta_module_detail', $rowModule['module_id']);
                        ?>
                    <a class="list-group-item" href="<?php echo $url; ?>">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img class="avatar" alt="<?php echo $dataModule['module_name']; ?>" src="<?php echo $dataModule['image_url']; ?>">
                            </div>
                            <div class="col text-truncate">
                                <div class="text-reset d-block"><?php echo $dataModule['module_name']; ?> / Lv. <?php echo $rowModule['module_enchant_level']; ?></div>
                                <div class="d-block text-secondary text-truncate mt-n1" style="white-space: normal;">Slot <?php echo $rowModule['module_slot_id']; ?></div>
                            </div>
                        </div>
                    </a>
                        <?php
                    }
                    ?>
                </div>
                    <?php
                }

                if ($row['core_unlock_flag'])
                {
                    ?>
                <div class="card-body">
                    <div class="datagrid">
                        <?php
                        foreach ($row['core'] as $rowCore)
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo $rowCore['core_option_name']; ?></div>
                            <div class="datagrid-content"><?php echo $rowCore['core_option_value']; ?></div>
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
        </div>
                <?php
            }
            ?>
    </div>
            <?php
        }
        ?>
    <hr>
        <?php
        if (isset($data['response']['reactor']) && is_array($data['response']['reactor']))
        {
            $reactor = $data['response']['reactor'];
            $dataReactor = nexon_first_descendant_meta_reactor_id($reactor['reactor_id']);
            ?>
    <div class="card mb-3" id="reactor">
        <div class="card-header">
            <div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $dataReactor['reactor_name']; ?>" src="<?php echo $dataReactor['image_url']; ?>">
                    </div>
                    <div class="col">
                        <h3 class="card-title">
                            <?php
                            $url = site_to('nexon_first_descendant_meta_reactor_detail', $dataReactor['reactor_id']);
                            $url .= '?' . current_url(true)->getQuery();
                            ?>
                            <a href="<?php echo $url; ?>"><?php echo $dataReactor['reactor_name']; ?></a>
                        </h3>
                        <p class="card-subtitle"><?php echo $dataReactor['reactor_tier_id']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.reactor_slot'); ?></div>
                    <div class="datagrid-content"><?php echo $reactor['reactor_slot_id']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.reactor_level'); ?></div>
                    <div class="datagrid-content"><?php echo $reactor['reactor_level']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.reactor_enchant_level'); ?></div>
                    <div class="datagrid-content"><?php echo $reactor['reactor_enchant_level']; ?></div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <?php
                foreach ($reactor['reactor_additional_stat'] as $row)
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo $row['additional_stat_name']; ?></div>
                    <div class="datagrid-content"><?php echo $row['additional_stat_value']; ?></div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
            <?php
        }
        ?>
    <hr>
        <?php
        if (isset($data['response']['externalComponent']) && is_array($data['response']['externalComponent']))
        {
            ?>
    <div class="row row-cards">
        <?php
        foreach ($data['response']['externalComponent'] as $row)
        {
            $dataExternalComponent = nexon_first_descendant_meta_external_component_id($row['external_component_id']);
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-header">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img class="avatar" alt="<?php echo $dataExternalComponent['external_component_name']; ?>" src="<?php echo $dataExternalComponent['image_url']; ?>">
                            </div>
                            <div class="col">
                                <h3 class="card-title">
                                    <?php
                                    $url = site_to('nexon_first_descendant_meta_reactor_detail', $dataExternalComponent['external_component_id']);
                                    $url .= '?' . current_url(true)->getQuery();
                                    ?>
                                    <a href="<?php echo $url; ?>"><?php echo $dataExternalComponent['external_component_name']; ?></a>
                                </h3>
                                <p class="card-subtitle"><?php echo $dataExternalComponent['external_component_tier_id'] . ' / ' . $dataExternalComponent['external_component_equipment_type']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.external_component_slot'); ?></div>
                            <div class="datagrid-content"><?php echo $row['external_component_slot_id']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.external_component_level'); ?></div>
                            <div class="datagrid-content"><?php echo $row['external_component_level']; ?></div>
                        </div>

                        <?php
                        foreach ($row['external_component_additional_stat'] as $rowStat)
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo $rowStat['additional_stat_name']; ?></div>
                            <div class="datagrid-content"><?php echo number_format_float($rowStat['additional_stat_value']); ?></div>
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
    <hr>
        <?php
        if (isset($data['response']['archeTuning']) && is_array($data['response']['archeTuning']))
        {
            $descendantId = $data['response']['descendant']['descendant_id'];
            echo view('\Modules\Nexon\FirstDescendant\Views\Tabler\template\arche-tuning', [
                'data'  => [
                    'descendantId'  => $descendantId,
                    'archeTuning'   => $data['response']['archeTuning'],
                ],
            ]);
        }
    }
    ?>
</section>
