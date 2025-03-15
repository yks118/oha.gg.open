<section id="view-nexon-first-descendant-meta-descendant-main">
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

            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-outline-success">검색</button>
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
            <div class="card mb-3" id="<?php echo $row['descendant_id']; ?>">
                <div class="card-header">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img class="avatar" alt="<?php echo $row['descendant_name']; ?>" src="<?php echo $row['descendant_image_url']; ?>">
                            </div>
                            <div class="col">
                                <h3 class="card-title">
                                    <?php
                                    $url = site_to('nexon_first_descendant_meta_descendant_detail', $row['descendant_id']);
                                    $url .= '?' . current_url(true)->getQuery();
                                    ?>
                                    <a href="<?php echo $url; ?>"><?php echo $row['descendant_name']; ?></a>
                                </h3>
                                <p class="card-subtitle"><?php echo nexon_first_descendant_meta_descendant_group_id($row['descendant_group_id'])['descendant_group_name']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="datagrid">
                        <?php
                        $rowStatEnd = $row['descendant_stat'][count($row['descendant_stat']) - 1];
                        foreach ($row['descendant_stat'][0]['stat_detail'] as $keyStat => $rowStat)
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title">
                                <?php echo $rowStat['stat_id']; ?>
                                <small>Lv 1 / Lv <?php echo $rowStatEnd['level']; ?></small>
                            </div>
                            <div class="datagrid-content">
                                <?php echo number_format_float($rowStat['stat_value']); ?>
                                /
                                <?php
                                echo number_format_float($rowStatEnd['stat_detail'][$keyStat]['stat_value']);

                                if ($rowStat['stat_value'] !== $rowStatEnd['stat_detail'][$keyStat]['stat_value'])
                                {
                                    ?>
                                <small class="text-success">+<?php echo number_format_float($rowStatEnd['stat_detail'][$keyStat]['stat_value'] - $rowStat['stat_value']); ?></small>
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

                <div class="list-group list-group-flush list-group-hoverable">
                    <?php
                    foreach ($row['descendant_skill'] as $rowSkill)
                    {
                        ?>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img class="avatar" alt="<?php echo $rowSkill['skill_name']; ?>" src="<?php echo $rowSkill['skill_image_url']; ?>">
                            </div>
                            <div class="col text-truncate">
                                <div class="text-reset d-block"><?php echo $rowSkill['skill_name']; ?></div>
                                <div class="d-block text-secondary text-truncate mt-n1" style="white-space: normal;"><?php echo nl2br($rowSkill['skill_description']); ?></div>
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
