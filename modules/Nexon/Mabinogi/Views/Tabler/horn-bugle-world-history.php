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
            if (isset($data['total'], $data['list']) && is_array($data['list']) && $data['total'] > 0)
            {
                foreach ($data['list'] as $eHornBugleWorldHistory)
                {
                    if ($eHornBugleWorldHistory instanceof \Modules\Nexon\Mabinogi\Entities\HornBugleWorldHistory)
                    {
                        ?>
            <div class="list-group-item">
                <div class="text-truncate">
                    <div class="text-reset d-block"><?php echo $eHornBugleWorldHistory->message; ?></div>
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

        <div class="card-footer">Total: <?php echo number_format($data['total'] ?? 0); ?></div>
    </div>

    <?php echo $data['pagination'] ?? ''; ?>
</section>
