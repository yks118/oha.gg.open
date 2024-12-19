<section id="view-nexon-first-descendant-meta-consumable-material-main">
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
            $languageCode = $data['get']['language_code'] ?? '';
            if (isset($data['materialTypes']) && is_array($data['materialTypes']) && count($data['materialTypes']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="material_type"><?php echo lang('NexonFirstDescendant.material_type'); ?></label>
                <select class="form-select" name="material_type" id="material_type">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['materialTypes'] as $materialType)
                    {
                        ?>
                    <option
                        value="<?php echo $materialType ?>"
                        <?php echo set_select('material_type', $materialType, isset($data['get']['material_type']) && $data['get']['material_type'] === $materialType); ?>
                    ><?php echo lang('NexonFirstDescendant.' . $materialType); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }

            if (isset($data['acquisitionDetails']) && is_array($data['acquisitionDetails']) && count($data['acquisitionDetails']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="acquisition_detail"><?php echo lang('NexonFirstDescendant.acquisition_detail'); ?></label>
                <select class="form-select" name="acquisition_detail" id="acquisition_detail">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['acquisitionDetails'] as $acquisitionDetail)
                    {
                        ?>
                    <option
                        value="<?php echo $acquisitionDetail ?>"
                        <?php echo set_select('acquisition_detail', $acquisitionDetail, isset($data['get']['acquisition_detail']) && $data['get']['acquisition_detail'] === $acquisitionDetail); ?>
                    ><?php echo nexon_first_descendant_meta_acquisition_detail_id($acquisitionDetail, $languageCode); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }

            if (isset($data['amorphousRewards']) && is_array($data['amorphousRewards']) && count($data['amorphousRewards']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="amorphous_reward"><?php echo lang('NexonFirstDescendant.amorphous_reward'); ?></label>
                <select class="form-select" name="amorphous_reward" id="amorphous_reward">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['amorphousRewards'] as $amorphousReward)
                    {
                        ?>
                    <option
                        value="<?php echo $amorphousReward ?>"
                        <?php echo set_select('amorphous_reward', $amorphousReward, isset($data['get']['amorphous_reward']) && $data['get']['amorphous_reward'] === $amorphousReward); ?>
                    ><?php echo nexon_first_descendant_meta_amorphous_open_condition_description_id($amorphousReward, $languageCode); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }

            if (isset($data['amorphousOpenConditions']) && is_array($data['amorphousOpenConditions']) && count($data['amorphousOpenConditions']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="amorphous_open_condition"><?php echo lang('NexonFirstDescendant.amorphous_open_condition'); ?></label>
                <select class="form-select" name="amorphous_open_condition" id="amorphous_open_condition">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['amorphousOpenConditions'] as $amorphousOpenCondition)
                    {
                        ?>
                    <option
                        value="<?php echo $amorphousOpenCondition ?>"
                        <?php echo set_select('amorphous_open_condition', $amorphousOpenCondition, isset($data['get']['amorphous_open_condition']) && $data['get']['amorphous_open_condition'] === $amorphousOpenCondition); ?>
                    ><?php echo nexon_first_descendant_meta_amorphous_open_condition_description_id($amorphousOpenCondition, $languageCode); ?></option>
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
            <div class="card mb-3" id="<?php echo $row['consumable_material_id']; ?>">
                <div class="card-header">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img class="avatar" alt="<?php echo $row['consumable_material_name']; ?>" src="<?php echo $row['image_url']; ?>">
                            </div>
                            <div class="col">
                                <h3 class="card-title">
                                    <a
                                        href="<?php echo site_to('nexon_first_descendant_meta_consumable_material_detail', $row['consumable_material_id']) . '?' . current_url(true)->getQuery(); ?>"
                                    ><?php echo $row['consumable_material_name']; ?></a>
                                </h3>
                                <p class="card-subtitle"><?php echo $row['consumable_material_id']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.required_mastery_rank_level'); ?></div>
                            <div class="datagrid-content"><?php echo $row['required_mastery_rank_level']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.material_type'); ?></div>
                            <div class="datagrid-content"><?php echo lang('NexonFirstDescendant.' . $row['material_type']); ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.acquisition_detail'); ?></div>
                            <div class="datagrid-content">
                                <?php
                                if (empty($row['acquisition_detail']))
                                {
                                    ?>&nbsp;<?php
                                }
                                else
                                {
                                    echo implode(
                                        ', ',
                                        array_map(
                                            function($value) use($languageCode)
                                            {
                                                return nexon_first_descendant_meta_acquisition_detail_id($value, $languageCode);
                                            },
                                            $row['acquisition_detail']
                                        )
                                    );
                                }
                                ?>
                            </div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.amorphous_open_condition'); ?></div>
                            <div class="datagrid-content">
                                <?php
                                if (empty($row['amorphous_open_condition']))
                                {
                                    ?>&nbsp;<?php
                                }
                                else
                                {
                                    echo implode(
                                        ', ',
                                        array_map(
                                            function($value) use($languageCode)
                                            {
                                                return nexon_first_descendant_meta_amorphous_open_condition_description_id($value, $languageCode);
                                            },
                                            $row['amorphous_open_condition']
                                        )
                                    );
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
