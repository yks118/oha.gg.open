<section id="view-nexon-first-descendant-meta-descendant-detail">
    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        $row = $data['response'];
        ?>
    <div class="card mb-3" id="<?php echo $row['descendant_id']; ?>">
        <div class="card-header">
            <div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $row['descendant_name']; ?>" src="<?php echo $row['descendant_image_url']; ?>">
                    </div>
                    <div class="col">
                        <h3 class="card-title"><?php echo $row['descendant_name']; ?></h3>
                        <p class="card-subtitle"><?php echo $row['descendant_id']; ?></p>
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
                        <?php echo $rowStat['stat_type']; ?>
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

    <div class="row row-cards">
        <?php
        foreach ($row['descendant_stat'] as $keyStat => $rowStat)
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Level</div>
                            <div class="datagrid-content"><?php echo $rowStat['level']; ?></div>
                        </div>

                        <?php
                        foreach ($rowStat['stat_detail'] as $keyStatDetail => $rowStatDetail)
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo $rowStatDetail['stat_type']; ?></div>
                            <div class="datagrid-content">
                                <?php
                                echo number_format_float($rowStatDetail['stat_value']);

                                if ($keyStat > 0 && $rowStatDetail['stat_value'] !== $row['descendant_stat'][$keyStat - 1]['stat_detail'][$keyStatDetail]['stat_value'])
                                {
                                    ?>
                                <small class="text-success">+<?php echo number_format_float($rowStatDetail['stat_value'] - $row['descendant_stat'][$keyStat - 1]['stat_detail'][$keyStatDetail]['stat_value']); ?></small>
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
            </div>
        </div>
            <?php
        }
        ?>
    </div>
        <?php
    }
    ?>
</section>
