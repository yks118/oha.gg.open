<section id="view-nexon-first-descendant-meta-fellow-main">
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
                <button type="submit" class="btn btn-outline-success"><?php echo lang('Core.button.search'); ?></button>
            </div>

            <?php echo form_close(); ?>
        </div>

        <div class="card-footer">Total: <?php echo number_format($data['total'] ?? 0); ?></div>
    </div>

    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        $languageCode = $data['get']['language_code'];
        ?>
    <div class="card mb-3" id="list">
        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($data['response'] as $row)
            {
                $url = site_to('nexon_first_descendant_meta_fellow_detail', $row['fellow_id']);
                $url .= '?' . current_url(true)->getQuery();
                ?>
            <a class="list-group-item" href="<?php echo $url; ?>">
                <div class="text-reset d-block"><?php echo $row['fellow_name']; ?></div>
                <div class="d-block text-secondary text-truncate mt-n1"><?php echo nexon_first_descendant_meta_tier_id($row['fellow_tier_id'], $languageCode); ?></div>
            </a>
                <?php
            }
            ?>
        </div>
    </div>
        <?php
    }
    ?>
</section>
