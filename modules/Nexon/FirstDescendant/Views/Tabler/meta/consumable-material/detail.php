<section id="view-nexon-first-descendant-meta-consumable-material-detail">
    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        $row = $data['response'];
        $languageCode = $data['get']['language_code'];
        ?>
    <div class="card mb-3" id="<?php echo $row['consumable_material_id']; ?>">
        <div class="card-header">
            <div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $row['consumable_material_name']; ?>" src="<?php echo $row['image_url']; ?>">
                    </div>
                    <div class="col">
                        <h3 class="card-title"><?php echo $row['consumable_material_name']; ?></h3>
                        <p class="card-subtitle"><?php echo $row['consumable_material_id']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.required_mastery_rank_level'); ?></div>
                    <div class="datagrid-content"><?php echo $row['required_mastery_rank_level']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.material_type'); ?></div>
                    <div class="datagrid-content"><?php echo lang('NexonFirstDescendant.' . $row['material_type']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.acquisition_detail'); ?></div>
                    <div class="datagrid-content">
                        <?php
                        if (empty($row['acquisition_detail']))
                        {
                            ?>&nbsp;<?php
                        }
                        else
                        {
                            echo implode(
                                '<br>',
                                array_map(
                                    function($value) use($languageCode)
                                    {
                                        return nexon_first_descendant_meta_acquisition_detail_id($value, $languageCode);
                                    },
                                    $row['acquisition_detail']
                                )
                            );
                        }
                        ?>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.amorphous_open_condition'); ?></div>
                    <div class="datagrid-content">
                        <?php
                        if (empty($row['amorphous_open_condition']))
                        {
                            ?>&nbsp;<?php
                        }
                        else
                        {
                            echo implode(
                                ', ',
                                array_map(
                                    function($value) use($languageCode)
                                    {
                                        return nexon_first_descendant_meta_amorphous_open_condition_description_id($value, $languageCode);
                                    },
                                    $row['amorphous_open_condition']
                                )
                            );
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <?php
        foreach ($row['amorphous_reward'] as $valueAmorphousReward)
        {
            $listAmorphousReward = nexon_first_descendant_meta_amorphous_reward_id($valueAmorphousReward);
            ?>
    <div class="card mb-3" id="amorphousReward<?php echo $valueAmorphousReward; ?>">
        <div class="card-header">
            <div>
                <h3 class="card-title">비정형 물질 오픈 보상</h3>
                <p class="card-subtitle"><?php echo $valueAmorphousReward; ?></p>
            </div>
        </div>
    </div>

            <?php
            foreach ($listAmorphousReward as $rowAmorphousReward)
            {
                $listRewardGroup = nexon_first_descendant_meta_amorphous_reward_group_id($rowAmorphousReward['reward_group_id']);
                ?>
    <div class="card mb-3" id="amorphousReward<?php echo $valueAmorphousReward . $rowAmorphousReward['reward_group_id']; ?>">
        <div class="card-header">
            <div>
                <h3 class="card-title">보상 구분</h3>
                <p class="card-subtitle"><?php echo $rowAmorphousReward['reward_type']; ?></p>
            </div>
        </div>

        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($listRewardGroup as $rowRewardGroup)
            {
                if ($rowRewardGroup['meta_type'] === 'consumable_material_id')
                {
                    $rowConsumableMaterial = nexon_first_descendant_meta_consumable_material_id($rowRewardGroup['meta_id']);
                    $url = site_to('nexon_first_descendant_meta_consumable_material_detail', $rowConsumableMaterial['consumable_material_id']);
                    $url .= '?' . current_url(true)->getQuery();
                    ?>
            <a class="list-group-item" href="<?php echo $url; ?>">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $rowConsumableMaterial['consumable_material_name']; ?>" src="<?php echo $rowConsumableMaterial['image_url']; ?>">
                    </div>

                    <div class="col text-truncate">
                        <div class="text-reset d-block"><?php echo $rowConsumableMaterial['consumable_material_name']; ?></div>
                        <div class="d-block text-secondary text-truncate mt-n1"><?php echo $rowRewardGroup['rate']; ?>%</div>
                    </div>
                </div>
            </a>
                    <?php
                }
            }
            ?>
        </div>

        <?php
        if ($rowAmorphousReward['required_stabilizer'])
        {
            $rowConsumableMaterial = nexon_first_descendant_meta_consumable_material_id($rowAmorphousReward['required_stabilizer']);
            ?>
        <div class="card-footer">
            <div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $rowConsumableMaterial['consumable_material_name']; ?>" src="<?php echo $rowConsumableMaterial['image_url']; ?>">
                    </div>
                    <div class="col">
                        <h3 class="card-title">
                            <?php
                            $url = site_to('nexon_first_descendant_meta_consumable_material_detail', $rowAmorphousReward['required_stabilizer']);
                            $url .= '?' . current_url(true)->getQuery();
                            ?>
                            <a href="<?php echo $url; ?>"><?php echo $rowConsumableMaterial['consumable_material_name']; ?></a>
                        </h3>
                        <p class="card-subtitle mb-0">업그레이드에 필요한 형태 안정제</p>
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
            <?php
        }
        ?>
        <?php
    }
    ?>
</section>
