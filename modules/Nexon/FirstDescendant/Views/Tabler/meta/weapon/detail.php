<section id="view-nexon-first-descendant-meta-weapon-detail">
    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        $row = $data['response'];
        $languageCode = $data['get']['language_code'];
        ?>
    <div class="card mb-3" id="<?php echo $row['weapon_id']; ?>">
        <div class="card-header">
            <div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $row['weapon_name']; ?>" src="<?php echo $row['image_url']; ?>">
                    </div>
                    <div class="col">
                        <h3 class="card-title"><?php echo $row['weapon_name']; ?></h3>
                        <p class="card-subtitle"><?php echo $row['weapon_id']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.weapon_type'); ?></div>
                    <div class="datagrid-content"><?php echo $row['weapon_type']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.weapon_tier_id'); ?></div>
                    <div class="datagrid-content"><?php echo $row['weapon_tier_id']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.weapon_rounds_type'); ?></div>
                    <div class="datagrid-content"><?php echo $row['weapon_rounds_type']; ?></div>
                </div>
            </div>
        </div>

        <?php
        if ($row['weapon_perk_ability_image_url'])
        {
            ?>
        <div class="card-footer">
            <div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $row['weapon_perk_ability_name']; ?>" src="<?php echo $row['weapon_perk_ability_image_url']; ?>">
                    </div>
                    <div class="col">
                        <h3 class="card-title"><?php echo $row['weapon_perk_ability_name']; ?></h3>
                        <p class="card-subtitle mb-0"><?php echo nl2br($row['weapon_perk_ability_description']); ?></p>
                    </div>
                </div>
            </div>
        </div>
            <?php
        }
        ?>
    </div>

    <div class="card mb-3" id="baseStat">
        <div class="card-body">
            <div class="datagrid">
                <?php
                foreach ($row['base_stat'] as $rowBaseStat)
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo nexon_first_descendant_meta_stat_id($rowBaseStat['stat_id'], $languageCode); ?></div>
                    <div class="datagrid-content"><?php echo $rowBaseStat['stat_value']; ?></div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="card mb-3" id="firearmAtk">
        <?php
        foreach ($row['firearm_atk'] as $keyFirearmAtk => $rowFirearmAtk)
        {
            ?>
        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">Level</div>
                    <div class="datagrid-content"><?php echo $rowFirearmAtk['level']; ?></div>
                </div>

                    <?php
                    foreach ($rowFirearmAtk['firearm'] as $rowFirearmAtkFirearm)
                    {
                        ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo nexon_first_descendant_meta_stat_id($rowFirearmAtkFirearm['firearm_atk_type'], $languageCode); ?></div>
                    <div class="datagrid-content">
                        <?php
                        echo number_format($rowFirearmAtkFirearm['firearm_atk_value']);

                        if ($keyFirearmAtk > 0)
                        {
                            ?>
                        <small class="text-success">+<?php echo number_format($rowFirearmAtkFirearm['firearm_atk_value'] - $row['firearm_atk'][$keyFirearmAtk - 1]['firearm'][0]['firearm_atk_value']); ?></small>
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
    if ($row['available_core_slot'])
    {
        foreach ($row['available_core_slot'] as $valueAvailableCoreSlot)
        {
            $rowAvailableCoreSlot = nexon_first_descendant_meta_core_slot_id($valueAvailableCoreSlot);
            foreach ($rowAvailableCoreSlot['available_core_type_id'] as $valueAvailableCoreTypeId)
            {
                $rowAvailableCoreTypeId = nexon_first_descendant_meta_core_type_id($valueAvailableCoreTypeId);
                ?>
    <hr>

    <div class="card mb-3" id="availableCoreSlot">
        <div class="card-header">
            <div>
                <h3 class="card-title"><?php echo $rowAvailableCoreTypeId['core_type']; ?></h3>
                <p class="card-subtitle"><?php echo $rowAvailableCoreTypeId['core_type_id']; ?></p>
            </div>
        </div>
    </div>

                <?php
                foreach ($rowAvailableCoreTypeId['core_option'] as $rowCoreOption)
                {
                    ?>
    <div class="row row-cards">
                    <?php
                    foreach ($rowCoreOption['detail'] as $rowCoreOptionDetail)
                    {
                        ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                        <?php
                        if ($rowCoreOptionDetail['required_core_item']['meta_type'] === 'consumable_material_id')
                        {
                            $rowConsumableMaterialId = nexon_first_descendant_meta_consumable_material_id($rowCoreOptionDetail['required_core_item']['meta_id']);
                            ?>
                <div class="card-header">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img class="avatar" alt="<?php echo $rowConsumableMaterialId['consumable_material_name']; ?>" src="<?php echo $rowConsumableMaterialId['image_url']; ?>">
                            </div>
                            <div class="col">
                                <h3 class="card-title"><?php echo $rowConsumableMaterialId['consumable_material_name']; ?></h3>
                                <p class="card-subtitle">Count: <?php echo $rowCoreOptionDetail['required_core_item']['count']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                            <?php
                        }
                        ?>

                <div class="card-body">
                    <div class="datagrid">
                        <?php
                        foreach ($rowCoreOptionDetail['available_item_option'] as $rowAvailableItemOption)
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title">
                                <?php echo $rowAvailableItemOption['item_option']; ?>
                                <small>(<?php echo lang('NexonFirstDescendant.' . $rowAvailableItemOption['option_effect']['operator_type']); ?>)</small>
                            </div>
                            <div class="datagrid-content">
                                <?php echo $rowAvailableItemOption['option_effect']['min_stat_value']; ?>
                                ~
                                <?php echo $rowAvailableItemOption['option_effect']['max_stat_value']; ?>
                                <small>(<?php echo $rowAvailableItemOption['rate']; ?>%)</small>
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
            }
        }
    }
    ?>

        <?php
    }
    ?>

    <div class="btn-list justify-content-end">
        <a
            class="btn btn-outline-primary"
            href="<?php echo site_to('nexon_first_descendant_meta_weapon_main'); ?>"
        >List</a>
    </div>
</section>
