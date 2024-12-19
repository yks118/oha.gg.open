<section id="view-nexon-first-descendant-meta-external-component-main">
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
            if (isset($data['equipmentTypes']) && is_array($data['equipmentTypes']) && count($data['equipmentTypes']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="external_component_equipment_type"><?php echo lang('NexonFirstDescendant.external_component_equipment_type'); ?></label>
                <select class="form-select" name="external_component_equipment_type" id="external_component_equipment_type">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['equipmentTypes'] as $equipmentType)
                    {
                        ?>
                    <option
                        value="<?php echo $equipmentType ?>"
                        <?php echo set_select('external_component_equipment_type', $equipmentType, isset($data['get']['external_component_equipment_type']) && $data['get']['external_component_equipment_type'] === $equipmentType); ?>
                    ><?php echo $equipmentType; ?></option>
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
                <label class="form-label" for="external_component_tier"><?php echo lang('NexonFirstDescendant.external_component_tier'); ?></label>
                <select class="form-select" name="external_component_tier" id="external_component_tier">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['tiers'] as $tier)
                    {
                        ?>
                    <option
                        value="<?php echo $tier ?>"
                        <?php echo set_select('external_component_tier', $tier, isset($data['get']['external_component_tier']) && $data['get']['external_component_tier'] === $tier); ?>
                    ><?php echo $tier; ?></option>
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
            <div class="card mb-3" id="<?php echo $row['external_component_id']; ?>">
                <div class="card-header">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img class="avatar" alt="<?php echo $row['external_component_name']; ?>" src="<?php echo $row['image_url']; ?>">
                            </div>
                            <div class="col">
                                <h3 class="card-title">
                                    <?php
                                    $url = site_to('nexon_first_descendant_meta_external_component_detail', $row['external_component_id']);
                                    $url .= '?' . current_url(true)->getQuery();
                                    ?>
                                    <a href="<?php echo $url; ?>"><?php echo $row['external_component_name']; ?></a>
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
