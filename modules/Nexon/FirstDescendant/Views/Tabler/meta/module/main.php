<section id="view-nexon-first-descendant-meta-module-main">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            ?>

            <div class="mb-3">
                <label class="form-label" for="language_code"><?php echo lang('Core.language.core'); ?></label>
                <select class="form-select" name="language_code" id="language_code">
                    <?php
                    foreach (nexon_first_descendant_config_api()->languageCodes as $languageCode)
                    {
                        ?>
                    <option
                        value="<?php echo $languageCode; ?>"
                        <?php echo set_select('language_code', $languageCode, isset($data['get']['language_code']) && $data['get']['language_code'] === $languageCode); ?>
                    ><?php echo lang('Core.language.' . $languageCode); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <?php
            if (isset($data['tiers']) && is_array($data['tiers']) && count($data['tiers']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="module_tier"><?php echo lang('NexonFirstDescendant.module_tier'); ?></label>
                <select class="form-select" name="module_tier" id="module_tier">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['tiers'] as $tier)
                    {
                        ?>
                    <option
                        value="<?php echo $tier; ?>"
                        <?php echo set_select('module_tier', $tier, isset($data['get']['module_tier']) && $data['get']['module_tier'] === $tier); ?>
                    ><?php echo $tier; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }

            if (isset($data['socketTypes']) && is_array($data['socketTypes']) && count($data['socketTypes']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="module_socket_type"><?php echo lang('NexonFirstDescendant.module_socket_type'); ?></label>
                <select class="form-select" name="module_socket_type" id="module_socket_type">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['socketTypes'] as $socketType)
                    {
                        ?>
                    <option
                        value="<?php echo $socketType; ?>"
                        <?php echo set_select('module_socket_type', $socketType, isset($data['get']['module_socket_type']) && $data['get']['module_socket_type'] === $socketType); ?>
                    ><?php echo $socketType; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }

            if (isset($data['classes']) && is_array($data['classes']) && count($data['classes']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="module_class"><?php echo lang('NexonFirstDescendant.module_class'); ?></label>
                <select class="form-select" name="module_class" id="module_class">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['classes'] as $class)
                    {
                        ?>
                    <option
                        value="<?php echo $class; ?>"
                        <?php echo set_select('module_class', $class, isset($data['get']['module_class']) && $data['get']['module_class'] === $class); ?>
                    ><?php echo $class; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }

            if (isset($data['availableWeaponTypes']) && is_array($data['availableWeaponTypes']) && count($data['availableWeaponTypes']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="available_weapon_type"><?php echo lang('NexonFirstDescendant.available_weapon_type'); ?></label>
                <select class="form-select" name="available_weapon_type" id="available_weapon_type">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['availableWeaponTypes'] as $availableWeaponType)
                    {
                        ?>
                        <option
                            value="<?php echo $availableWeaponType; ?>"
                            <?php echo set_select('available_weapon_type', $availableWeaponType, isset($data['get']['available_weapon_type']) && $data['get']['available_weapon_type'] === $availableWeaponType); ?>
                        ><?php echo nexon_first_descendant_meta_weapon_type_id($availableWeaponType); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }

            if (isset($data['availableDescendantIds']) && is_array($data['availableDescendantIds']) && count($data['availableDescendantIds']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="available_descendant_id"><?php echo lang('NexonFirstDescendant.available_descendant'); ?></label>
                <select class="form-select" name="available_descendant_id" id="available_descendant_id">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['availableDescendantIds'] as $availableDescendantId)
                    {
                        ?>
                    <option
                        value="<?php echo $availableDescendantId; ?>"
                        <?php echo set_select('available_descendant_id', $availableDescendantId, isset($data['get']['available_descendant_id']) && $data['get']['available_descendant_id'] === $availableDescendantId); ?>
                    ><?php echo nexon_first_descendant_meta_descendant_id($availableDescendantId)['descendant_name']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }

            if (isset($data['slotTypes']) && is_array($data['slotTypes']) && count($data['slotTypes']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="available_module_slot_type"><?php echo lang('NexonFirstDescendant.available_module_slot_type'); ?></label>
                <select class="form-select" name="available_module_slot_type" id="available_module_slot_type">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['slotTypes'] as $slotType)
                    {
                        ?>
                    <option
                        value="<?php echo $slotType; ?>"
                        <?php echo set_select('available_module_slot_type', $slotType, isset($data['get']['available_module_slot_type']) && $data['get']['available_module_slot_type'] === $slotType); ?>
                    ><?php echo $slotType; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }
            ?>

            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-outline-success"><?php echo lang('Core.button.search'); ?></button>
            </div>

            <?php echo form_close(); ?>
        </div>

        <div class="card-footer">Total: <?php echo number_format($data['total'] ?? 0); ?></div>
    </div>

    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        ?>
    <div class="row row-cards">
        <?php
        foreach ($data['response'] as $row)
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3" id="<?php echo $row['module_id']; ?>">
                <div class="card-header">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img class="avatar" alt="<?php echo $row['module_name']; ?>" src="<?php echo $row['image_url']; ?>">
                            </div>
                            <div class="col">
                                <h3 class="card-title">
                                    <?php
                                    $url = site_to('nexon_first_descendant_meta_module_detail', $row['module_id']);
                                    $url .= '?' . current_url(true)->getQuery();
                                    ?>
                                    <a href="<?php echo $url; ?>"><?php echo $row['module_name']; ?></a>
                                </h3>
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
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.module_tier'); ?></div>
                            <div class="datagrid-content"><?php echo $row['module_tier']; ?></div>
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
        </div>
            <?php
        }
        ?>
    </div>

    <div class="card">
        <div class="card-body">
            <ul class="pagination">
                <?php
                $page = $data['get']['page'] - 1;
                $url = clone current_url(true);
                ?>
                <li class="page-item page-prev <?php echo $data['get']['page'] === 1 ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo $url->addQuery('page', $page); ?>">
                        <div class="page-item-subtitle">previous</div>
                        <div class="page-item-title"><?php echo $page; ?></div>
                    </a>
                </li>

                <?php
                $page = $data['get']['page'] + 1;
                $url = clone current_url(true);
                ?>
                <li class="page-item page-next">
                    <a class="page-link" href="<?php echo $url->addQuery('page', $page); ?>">
                        <div class="page-item-subtitle">next</div>
                        <div class="page-item-title"><?php echo $page; ?></div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
        <?php
    }
    ?>
</section>
