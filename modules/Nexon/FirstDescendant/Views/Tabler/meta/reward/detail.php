<section id="view-nexon-first-descendant-meta-external-component-detail">
    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        $row = $data['response'];
        $languageCode = $data['get']['language_code'];
        ?>
    <div class="card mb-3">
        <div class="card-header">
            <div>
                <h3 class="card-title"><?php echo $row['map_name']; ?></h3>
                <p class="card-subtitle"><?php echo $row['map_id']; ?></p>
            </div>
        </div>
    </div>

    <div class="row row-cards">
        <?php
        foreach ($row['battle_zone'] as $rowBattleZone)
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3" id="<?php echo $rowBattleZone['battle_zone_id']; ?>">
                <div class="card-header">
                    <div>
                        <h3 class="card-title"><?php echo $rowBattleZone['battle_zone_name']; ?></h3>
                        <p class="card-subtitle"><?php echo $rowBattleZone['battle_zone_id']; ?></p>
                    </div>
                </div>

                <?php
                foreach ($rowBattleZone['reward'] as $rowReward)
                {
                    ?>
                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.reward_rotation'); ?></div>
                            <div class="datagrid-content"><?php echo $rowReward['rotation']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.reward_type'); ?></div>
                            <div class="datagrid-content"><?php echo $rowReward['reward_type']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.reactor_element_type'); ?></div>
                            <div class="datagrid-content"><?php echo empty($rowReward['reactor_element_type']) ? '&nbsp;' : $rowReward['reactor_element_type']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.weapon_rounds_type'); ?></div>
                            <div class="datagrid-content"><?php echo empty($rowReward['weapon_rounds_type']) ? '&nbsp;' : $rowReward['weapon_rounds_type']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.arche_type'); ?></div>
                            <div class="datagrid-content"><?php echo empty($rowReward['arche_type']) ? '&nbsp;' : $rowReward['arche_type']; ?></div>
                        </div>
                    </div>
                </div>
                    <?php
                }
                ?>
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
