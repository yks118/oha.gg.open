<section id="view-nexon-first-descendant-meta-reactor-main">
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
            if (isset($data['tiers']) && is_array($data['tiers']) && count($data['tiers']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="reactor_tier"><?php echo lang('NexonFirstDescendant.reactor_tier'); ?></label>
                <select class="form-select" name="reactor_tier" id="reactor_tier">
                    <option value=""><?php echo lang('Core.select.all'); ?></option>

                    <?php
                    foreach ($data['tiers'] as $tier)
                    {
                        ?>
                    <option
                        value="<?php echo $tier ?>"
                        <?php echo set_select('reactor_tier', $tier, isset($data['get']['reactor_tier']) && $data['get']['reactor_tier'] === $tier); ?>
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
    <div class="card mb-3">
        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($data['response'] as $row)
            {
                $url = site_to('nexon_first_descendant_meta_reactor_detail', $row['reactor_id']);
                $url .= '?' . current_url(true)->getQuery();
                ?>
            <a class="list-group-item" href="<?php echo $url; ?>">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $row['reactor_name']; ?>" src="<?php echo $row['image_url']; ?>">
                    </div>
                    <div class="col text-truncate">
                        <div class="text-reset d-block"><?php echo $row['reactor_name']; ?></div>
                        <div class="d-block text-secondary text-truncate mt-n1"><?php echo $row['reactor_tier']; ?></div>
                    </div>
                </div>
            </a>
                <?php
            }
            ?>
        </div>
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
