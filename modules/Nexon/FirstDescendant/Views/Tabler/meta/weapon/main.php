<section id="view-nexon-first-descendant-meta-weapon-main">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            ?>

            <div class="mb-3">
                <label class="form-label" for="language_code"><?php echo lang('Core.language.code'); ?></label>
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
            if (isset($data['types']) && is_array($data['types']) && count($data['types']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="weapon_type"><?php echo lang('NexonFirstDescendant.weapon_type'); ?></label>
                <select class="form-select" name="weapon_type" id="weapon_type">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['types'] as $type)
                    {
                        ?>
                    <option
                        value="<?php echo $type ?>"
                        <?php echo set_select('weapon_type', $type, isset($data['get']['weapon_type']) && $data['get']['weapon_type'] === $type); ?>
                    ><?php echo $type; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }

            if (isset($data['tiers']) && is_array($data['tiers']) && count($data['tiers']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="weapon_tier"><?php echo lang('NexonFirstDescendant.weapon_tier'); ?></label>
                <select class="form-select" name="weapon_tier" id="weapon_tier">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['tiers'] as $tier)
                    {
                        ?>
                        <option
                            value="<?php echo $tier ?>"
                            <?php echo set_select('weapon_tier', $tier, isset($data['get']['weapon_tier']) && $data['get']['weapon_tier'] === $tier); ?>
                        ><?php echo $tier; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }

            if (isset($data['roundsTypes']) && is_array($data['roundsTypes']) && count($data['roundsTypes']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="weapon_rounds_type"><?php echo lang('NexonFirstDescendant.weapon_rounds_type'); ?></label>
                <select class="form-select" name="weapon_rounds_type" id="weapon_rounds_type">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['roundsTypes'] as $roundsType)
                    {
                        ?>
                    <option
                        value="<?php echo $roundsType ?>"
                        <?php echo set_select('weapon_rounds_type', $roundsType, isset($data['get']['weapon_rounds_type']) && $data['get']['weapon_rounds_type'] === $roundsType); ?>
                    ><?php echo $roundsType; ?></option>
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
            if (empty($row['image_url']))
            {
                continue;
            }
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3" id="<?php echo $row['weapon_id']; ?>">
                <div class="card-header">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img class="avatar" alt="<?php echo $row['weapon_name']; ?>" src="<?php echo $row['image_url']; ?>">
                            </div>
                            <div class="col">
                                <h3 class="card-title">
                                    <?php
                                    $url = site_to('nexon_first_descendant_meta_weapon_detail', $row['weapon_id']);
                                    $url .= '?' . current_url(true)->getQuery();
                                    ?>
                                    <a href="<?php echo $url; ?>"><?php echo $row['weapon_name']; ?></a>
                                </h3>
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
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.weapon_tier'); ?></div>
                            <div class="datagrid-content"><?php echo $row['weapon_tier']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.weapon_rounds_type'); ?></div>
                            <div class="datagrid-content"><?php echo $row['weapon_rounds_type']; ?></div>
                        </div>

                        <?php
                        $firearmAtkEnd = $row['firearm_atk'][count($row['firearm_atk']) - 1];
                        ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Lv 1 / Lv <?php echo $firearmAtkEnd['level']; ?></div>
                            <div class="datagrid-content">
                                <?php echo $row['firearm_atk'][0]['firearm'][0]['firearm_atk_value']; ?>
                                /
                                <?php echo number_format($firearmAtkEnd['firearm'][0]['firearm_atk_value']); ?>
                                <small class="text-success">+<?php echo number_format($firearmAtkEnd['firearm'][0]['firearm_atk_value'] - $row['firearm_atk'][0]['firearm'][0]['firearm_atk_value']); ?></small>
                            </div>
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
