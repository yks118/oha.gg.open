<section id="view-nexon-first-descendant-meta-research-main">
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
            if (isset($data['repeatables']) && is_array($data['repeatables']) && count($data['repeatables']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="repeatable_research"><?php echo lang('NexonFirstDescendant.repeatable_research'); ?></label>
                <select class="form-select" name="repeatable_research" id="repeatable_research">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['repeatables'] as $repeatable)
                    {
                        ?>
                    <option
                        value="<?php echo $repeatable ?>"
                        <?php echo set_select('repeatable_research', $repeatable, isset($data['get']['repeatable_research']) && $data['get']['repeatable_research'] === $repeatable); ?>
                    ><?php echo $repeatable ? lang('NexonFirstDescendant.repeatable_research_true') : lang('NexonFirstDescendant.repeatable_research_false'); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }

            if (isset($data['types']) && is_array($data['types']) && count($data['types']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="research_type"><?php echo lang('NexonFirstDescendant.research_type'); ?></label>
                <select class="form-select" name="research_type" id="research_type">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['types'] as $type)
                    {
                        ?>
                    <option
                        value="<?php echo $type ?>"
                        <?php echo set_select('research_type', $type, isset($data['get']['research_type']) && $data['get']['research_type'] === $type); ?>
                    ><?php echo lang('NexonFirstDescendant.' . $type); ?></option>
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
            <div class="card mb-3" id="<?php echo $row['research_id']; ?>">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">
                            <?php
                            $url = site_to('nexon_first_descendant_meta_research_detail', $row['research_id']);
                            $url .= '?' . current_url(true)->getQuery();
                            ?>
                            <a href="<?php echo $url; ?>"><?php echo $row['research_name']; ?></a>
                        </h3>
                        <p class="card-subtitle"><?php echo $row['research_id']; ?></p>
                    </div>
                </div>

                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.repeatable_research'); ?></div>
                            <div class="datagrid-content">
                                <?php
                                if ($row['repeatable_research'])
                                {
                                    ?>
                                <span class="text-success"><?php echo lang('NexonFirstDescendant.repeatable_research_true'); ?></span>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                <span class="text-danger"><?php echo lang('NexonFirstDescendant.repeatable_research_false'); ?></span>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.research_type'); ?></div>
                            <div class="datagrid-content"><?php echo lang('NexonFirstDescendant.' . $row['research_type']); ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.research_time'); ?></div>
                            <div class="datagrid-content">
                                <?php echo number_format($row['research_time']); ?>
                                <small class="text-info">/ <?php echo convert_second_to_sns($row['research_time']); ?></small>
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