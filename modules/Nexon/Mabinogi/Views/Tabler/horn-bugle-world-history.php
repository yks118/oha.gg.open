<section id="view-nexon-mabinogi-horn-bugle-world-history">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            $cCms = core_config_cms();
            ?>

            <div class="mb-3">
                <label class="form-label" for="<?php echo $cCms->searchName; ?>">검색</label>
                <input
                    type="text" class="form-control"
                    name="<?php echo $cCms->searchName; ?>" id="<?php echo $cCms->searchName; ?>"
                    value="<?php echo isset($data['get'][$cCms->searchName]) ? quotes_to_entities($data['get'][$cCms->searchName]) : ''; ?>"
                >
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-outline-success">검색</button>
            </div>

            <?php echo form_close(); ?>
        </div>

        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            if (isset($data['list']) && is_array($data['list']) && count($data['list']) > 0)
            {
                foreach ($data['list'] as $eHornBugleWorldHistory)
                {
                    if ($eHornBugleWorldHistory instanceof \Modules\Nexon\Mabinogi\Entities\HornBugleWorldHistory)
                    {
                        ?>
            <div class="list-group-item">
                <div class="text-truncate">
                    <div class="text-reset d-block"><?php echo trim($eHornBugleWorldHistory->message); ?></div>
                    <div class="d-block text-secondary text-truncate mt-n1">
                        [<a href="<?php echo $eHornBugleWorldHistory->search('server_name'); ?>"><?php echo $eHornBugleWorldHistory->server_name; ?></a>]
                        <a href="<?php echo $eHornBugleWorldHistory->search('character_name'); ?>"><?php echo $eHornBugleWorldHistory->character_name; ?></a>
                    </div>
                    <div class="d-block text-secondary text-truncate mt-n1"><?php echo $eHornBugleWorldHistory->date_send->format('Y-m-d H:i:s'); ?></div>
                </div>
            </div>
                        <?php
                    }
                }
            }
            else
            {
                ?>
            <div class="list-group-item">
                <div class="text-truncate">
                    <div class="text-reset d-block">데이터가 존재하지 않습니다.</div>
                </div>
            </div>
                <?php
            }
            ?>
        </div>

        <?php /* ?><div class="card-footer">Total: <?php echo number_format($data['total'] ?? 0); ?></div><?php */ ?>
    </div>

    <?php
    // echo $data['pagination'] ?? '';
    if (isset($data['get']['page']))
    {
        ?>
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
