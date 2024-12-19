<section id="view-nexon-first-descendant-meta-research-detail">
    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        $row = $data['response'];
        ?>
    <div class="card mb-3" id="<?php echo $row['research_id']; ?>">
        <div class="card-header">
            <div>
                <h3 class="card-title"><?php echo $row['research_name']; ?></h3>
                <p class="card-subtitle"><?php echo $row['research_id']; ?></p>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.repeatable_research'); ?></div>
                    <div class="datagrid-content">
                        <?php
                        if ($row['repeatable_research'])
                        {
                            ?>
                        <span class="text-success"><?php echo lang('NexonFirstDescendant.repeatable_research_true'); ?></span>
                            <?php
                        }
                        else
                        {
                            ?>
                        <span class="text-danger"><?php echo lang('NexonFirstDescendant.repeatable_research_false'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.research_type'); ?></div>
                    <div class="datagrid-content"><?php echo lang('NexonFirstDescendant.' . $row['research_type']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.research_time'); ?></div>
                    <div class="datagrid-content">
                        <?php echo number_format($row['research_time']); ?>
                        <small class="text-info">/ <?php echo convert_second_to_sns($row['research_time']); ?></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3" id="researchCost">
        <div class="card-header">
            <div>
                <h3 class="card-title"><?php echo lang('NexonFirstDescendant.research_cost'); ?></h3>
                <p class="card-subtitle"></p>
            </div>
        </div>

        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($row['research_cost'] as $rowResearchCost)
            {
                ?>
            <div class="list-group-item">
                <div class="text-reset d-block"><?php echo number_format($rowResearchCost['currency_value']); ?></div>
                <div class="d-block text-secondary text-truncate mt-n1"><?php echo $rowResearchCost['currency_type']; ?></div>
            </div>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="card mb-3" id="researchBoostCost">
        <div class="card-header">
            <div>
                <h3 class="card-title"><?php echo lang('NexonFirstDescendant.research_boost_cost'); ?></h3>
                <p class="card-subtitle"></p>
            </div>
        </div>

        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($row['research_boost_cost'] as $rowResearchBoostCost)
            {
                ?>
                <div class="list-group-item">
                    <div class="text-reset d-block"><?php echo number_format($rowResearchBoostCost['currency_value']); ?></div>
                    <div class="d-block text-secondary text-truncate mt-n1"><?php echo $rowResearchBoostCost['currency_type']; ?></div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="card mb-3" id="researchResult">
        <div class="card-header">
            <div>
                <h3 class="card-title"><?php echo lang('NexonFirstDescendant.research_result'); ?></h3>
                <p class="card-subtitle"></p>
            </div>
        </div>

        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($row['research_result'] as $rowResearchResult)
            {
                if ($rowResearchResult['meta_type'] === 'descendant_id')
                {
                    $rowDescendant = nexon_first_descendant_meta_descendant_id($rowResearchResult['meta_id']);

                    $url = site_to('nexon_first_descendant_meta_descendant_detail', $rowDescendant['descendant_id']);
                    $url .= '?' . current_url(true)->getQuery();
                    ?>
            <a class="list-group-item" href="<?php echo $url; ?>">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $rowDescendant['descendant_name']; ?>" src="<?php echo $rowDescendant['descendant_image_url']; ?>">
                    </div>

                    <div class="col text-truncate">
                        <div class="text-reset d-block"><?php echo $rowDescendant['descendant_name']; ?></div>
                        <div class="d-block text-secondary text-truncate mt-n1"><?php echo number_format($rowResearchResult['result_count']); ?></div>
                    </div>
                </div>
            </a>
                    <?php
                }
                elseif ($rowResearchResult['meta_type'] === 'consumable_material_id')
                {
                    $rowConsumableMaterial = nexon_first_descendant_meta_consumable_material_id($rowResearchResult['meta_id']);

                    $url = site_to('nexon_first_descendant_meta_consumable_material_detail', $rowResearchResult['meta_id']);
                    $url .= '?' . current_url(true)->getQuery();
                    ?>
            <a class="list-group-item" href="<?php echo $url; ?>">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $rowConsumableMaterial['consumable_material_name']; ?>" src="<?php echo $rowConsumableMaterial['image_url']; ?>">
                    </div>

                    <div class="col text-truncate">
                        <div class="text-reset d-block"><?php echo $rowConsumableMaterial['consumable_material_name']; ?></div>
                        <div class="d-block text-secondary text-truncate mt-n1"><?php echo number_format($rowResearchResult['result_count']); ?></div>
                    </div>
                </div>
            </a>
                    <?php
                }
                elseif ($rowResearchResult['meta_type'] === 'weapon_id')
                {
                    $rowWeapon = nexon_first_descendant_meta_weapon_id($rowResearchResult['meta_id']);

                    $url = site_to('nexon_first_descendant_meta_weapon_detail', $rowResearchResult['meta_id']);
                    $url .= '?' . current_url(true)->getQuery();
                    ?>
            <a class="list-group-item" href="<?php echo $url; ?>">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $rowWeapon['weapon_name']; ?>" src="<?php echo $rowWeapon['image_url']; ?>">
                    </div>

                    <div class="col text-truncate">
                        <div class="text-reset d-block"><?php echo $rowWeapon['weapon_name']; ?></div>
                        <div class="d-block text-secondary text-truncate mt-n1"><?php echo number_format($rowResearchResult['result_count']); ?></div>
                    </div>
                </div>
            </a>
                    <?php
                }
                elseif ($rowResearchResult['meta_type'] === 'fellow_id')
                {
                    $rowFellow = nexon_first_descendant_meta_fellow_id($rowResearchResult['meta_id']);

                    $url = site_to('nexon_first_descendant_meta_fellow_detail', $rowResearchResult['meta_id']);
                    $url .= '?' . current_url(true)->getQuery();
                    ?>
            <a class="list-group-item" href="<?php echo $url; ?>">
                <div class="text-reset d-block"><?php echo $rowFellow['fellow_name']; ?></div>
                <div class="d-block text-secondary text-truncate mt-n1"><?php echo number_format($rowResearchResult['result_count']); ?></div>
            </a>
                    <?php
                }
            }
            ?>
        </div>
    </div>

    <div class="card mb-3" id="researchMaterial">
        <div class="card-header">
            <div>
                <h3 class="card-title"><?php echo lang('NexonFirstDescendant.research_material'); ?></h3>
                <p class="card-subtitle"></p>
            </div>
        </div>

        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($row['research_material'] as $rowResearchMaterial)
            {
                if ($rowResearchMaterial['meta_type'] === 'consumable_material_id')
                {
                    $rowConsumableMaterial = nexon_first_descendant_meta_consumable_material_id($rowResearchMaterial['meta_id']);

                    $url = site_to('nexon_first_descendant_meta_consumable_material_detail', $rowResearchMaterial['meta_id']);
                    $url .= '?' . current_url(true)->getQuery();
                    ?>
            <a class="list-group-item" href="<?php echo $url; ?>">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $rowConsumableMaterial['consumable_material_name']; ?>" src="<?php echo $rowConsumableMaterial['image_url']; ?>">
                    </div>

                    <div class="col text-truncate">
                        <div class="text-reset d-block"><?php echo $rowConsumableMaterial['consumable_material_name']; ?></div>
                        <div class="d-block text-secondary text-truncate mt-n1"><?php echo number_format($rowResearchMaterial['material_count']); ?></div>
                    </div>
                </div>
            </a>
                    <?php
                }
            }
            ?>
        </div>
    </div>
        <?php
    }
    ?>
</section>
