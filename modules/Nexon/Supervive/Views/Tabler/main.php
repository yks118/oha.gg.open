<section id="view-nexon-supervive-main">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            ?>

            <div class="mb-3">
                <label class="form-label" for="user_name">User Name</label>
                <input
                    type="text" class="form-control" name="user_name" id="user_name" required
                    value="<?php echo set_value('user_name', $data['get']['user_name'] ?? ''); ?>"
                >
            </div>

            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-outline-success">검색</button>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>

    <?php
    if (isset($data['profile']))
    {
        $profile = $data['profile'];
        ?>
    <div class="card mb-3">
        <div class="card-header">
            <div>
                <h3 class="card-title"><?php echo $profile['display_name'] . '#' . $profile['tag']; ?></h3>
                <p class="card-subtitle">Level: <?php echo $profile['account_level']; ?></p>
            </div>
        </div>

        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($profile['item'] as $item)
            {
                ?>
            <div class="list-group-item">
                <div class="text-truncate">
                    <div class="text-reset d-block"><?php echo $item['item_name']; ?></div>
                    <div class="d-block text-secondary text-truncate mt-n1">Count: <?php echo $item['item_count']; ?></div>
                </div>
            </div>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="btn-list justify-content-end">
        <a
            class="btn btn-outline-success"
            href="<?php echo site_to('nexon_supervive_match_main') . '?' . current_url(true)->getQuery(); ?>"
        >Match</a>
    </div>
        <?php
    }
    ?>
</section>
