<section id="view-nexon-first-descendant-meta-adapt-level-exp">
    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        ?>
    <div class="card mb-3">
        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($data['response'] as $key => $row)
            {
                ?>
            <div class="list-group-item">
                <div class="text-reset d-block">
                    <?php
                    echo number_format($row['exp_per_level']);

                    if ($key > 0 && $row['exp_per_level'] !== 0)
                    {
                        ?>
                    <small class="text-success">+<?php echo number_format($row['exp_per_level'] - $data['response'][$key - 1]['exp_per_level']); ?></small>
                        <?php
                    }
                    ?>
                </div>
                <div class="d-block text-secondary text-truncate mt-n1">Lv. <?php echo $row['level']; ?></div>
            </div>
                <?php
            }
            ?>
        </div>
    </div>
        <?php
    }
    ?>
</section>
