<section id="view-nexon-first-descendant-meta-reactor-detail">
    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        $row = $data['response'];
        ?>
    <div class="card mb-3">
        <div class="card-header">
            <div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $row['reactor_name']; ?>" src="<?php echo $row['image_url']; ?>">
                    </div>
                    <div class="col">
                        <h3 class="card-title"><?php echo $row['reactor_name']; ?></h3>
                        <p class="card-subtitle"><?php echo $row['reactor_tier']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $keySkillPowerEnd = count($row['reactor_skill_power']) - 1;
        ?>
        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">Lv.</div>
                    <div class="datagrid-content">
                        <?php echo number_format_float($row['reactor_skill_power'][0]['level']); ?>
                        /
                        <?php echo number_format_float($row['reactor_skill_power'][$keySkillPowerEnd]['level']); ?>
                        <small class="text-success">+<?php echo number_format_float($row['reactor_skill_power'][$keySkillPowerEnd]['level'] - $row['reactor_skill_power'][0]['level']); ?></small>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.reactor_skill_power'); ?></div>
                    <div class="datagrid-content">
                        <?php echo number_format_float($row['reactor_skill_power'][0]['skill_atk_power']); ?>
                        /
                        <?php
                        echo number_format_float($row['reactor_skill_power'][$keySkillPowerEnd]['skill_atk_power']);

                        if ($row['reactor_skill_power'][$keySkillPowerEnd]['skill_atk_power'] !== $row['reactor_skill_power'][0]['skill_atk_power'])
                        {
                            ?>
                        <small class="text-success">+<?php echo number_format_float($row['reactor_skill_power'][$keySkillPowerEnd]['skill_atk_power'] - $row['reactor_skill_power'][0]['skill_atk_power']); ?></small>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.sub_skill_atk_power'); ?></div>
                    <div class="datagrid-content">
                        <?php echo number_format_float($row['reactor_skill_power'][0]['sub_skill_atk_power']); ?>
                        /
                        <?php
                        echo number_format_float($row['reactor_skill_power'][$keySkillPowerEnd]['sub_skill_atk_power']);

                        if ($row['reactor_skill_power'][$keySkillPowerEnd]['sub_skill_atk_power'] !== $row['reactor_skill_power'][0]['sub_skill_atk_power'])
                        {
                            ?>
                        <small class="text-success">+<?php echo number_format_float($row['reactor_skill_power'][$keySkillPowerEnd]['sub_skill_atk_power'] - $row['reactor_skill_power'][0]['sub_skill_atk_power']); ?></small>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <?php
                foreach ($row['reactor_skill_power'][$keySkillPowerEnd]['enchant_effect'] as $keySkillPowerEnchantEffect => $rowSkillPowerEnchantEffect)
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title">Lv. <?php echo $rowSkillPowerEnchantEffect['enchant_level'] . ' - ' . $rowSkillPowerEnchantEffect['stat_type']; ?></div>
                    <div class="datagrid-content">
                        <?php echo number_format_float($row['reactor_skill_power'][0]['enchant_effect'][$keySkillPowerEnchantEffect]['value'] ?? 0); ?>
                        /
                        <?php
                        echo number_format_float($rowSkillPowerEnchantEffect['value']);

                        if (! isset($row['reactor_skill_power'][0]['enchant_effect'][$keySkillPowerEnchantEffect]['value']))
                        {
                            ?>
                        <small class="text-success">+<?php echo number_format_float($rowSkillPowerEnchantEffect['value']); ?></small>
                            <?php
                        }
                        elseif ($row['reactor_skill_power'][0]['enchant_effect'][$keySkillPowerEnchantEffect]['value'] !== $rowSkillPowerEnchantEffect['value'])
                        {
                            ?>
                        <small class="text-success">+<?php echo number_format_float($rowSkillPowerEnchantEffect['value'] - $row['reactor_skill_power'][0]['enchant_effect'][$keySkillPowerEnchantEffect]['value']); ?></small>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                    <?php
                }

                foreach ($row['reactor_skill_power'][0]['skill_power_coefficient'] as $keySkillPowerCoefficient => $rowSkillPowerCoefficient)
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo $rowSkillPowerCoefficient['coefficient_stat_id']; ?></div>
                    <div class="datagrid-content">
                        <?php echo number_format_float($rowSkillPowerCoefficient['coefficient_stat_value']); ?>
                        /
                        <?php
                        echo number_format_float($row['reactor_skill_power'][$keySkillPowerEnd]['skill_power_coefficient'][$keySkillPowerCoefficient]['coefficient_stat_value']);

                        if ($row['reactor_skill_power'][$keySkillPowerEnd]['skill_power_coefficient'][$keySkillPowerCoefficient]['coefficient_stat_value'] !== $rowSkillPowerCoefficient['coefficient_stat_value'])
                        {
                            ?>
                        <small class="text-success">+<?php echo number_format_float($row['reactor_skill_power'][$keySkillPowerEnd]['skill_power_coefficient'][$keySkillPowerCoefficient]['coefficient_stat_value'] - $rowSkillPowerCoefficient['coefficient_stat_value']); ?></small>
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

    <div class="row row-cards">
        <?php
        foreach ($row['reactor_skill_power'] as $keySkillPower => $rowSkillPower)
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3" id="<?php echo $rowSkillPower['level']; ?>">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">Lv. <?php echo $rowSkillPower['level']; ?></h3>
                        <p class="card-subtitle"></p>
                    </div>
                </div>

                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.reactor_skill_power'); ?></div>
                            <div class="datagrid-content">
                                <?php
                                echo number_format_float($rowSkillPower['skill_atk_power']);

                                if ($keySkillPower > 0 && $rowSkillPower['skill_atk_power'] !== $row['reactor_skill_power'][$keySkillPower - 1]['skill_atk_power'])
                                {
                                    ?>
                                <small class="text-success">+<?php echo number_format_float($rowSkillPower['skill_atk_power'] - $row['reactor_skill_power'][$keySkillPower - 1]['skill_atk_power']); ?></small>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.sub_skill_atk_power'); ?></div>
                            <div class="datagrid-content">
                                <?php
                                echo number_format_float($rowSkillPower['sub_skill_atk_power']);

                                if ($keySkillPower > 0 && $rowSkillPower['sub_skill_atk_power'] !== $row['reactor_skill_power'][$keySkillPower - 1]['sub_skill_atk_power'])
                                {
                                    ?>
                                <small class="text-success">+<?php echo number_format_float($rowSkillPower['sub_skill_atk_power'] - $row['reactor_skill_power'][$keySkillPower - 1]['sub_skill_atk_power']); ?></small>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="datagrid">
                        <?php
                        foreach ($rowSkillPower['enchant_effect'] as $keySkillPowerEnchantEffect => $rowSkillPowerEnchantEffect)
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Lv. <?php echo $rowSkillPowerEnchantEffect['enchant_level'] . ' - ' . $rowSkillPowerEnchantEffect['stat_type']; ?></div>
                            <div class="datagrid-content">
                                <?php
                                echo number_format_float($rowSkillPowerEnchantEffect['value']);

                                if ($keySkillPower > 0)
                                {
                                    if (! isset($row['reactor_skill_power'][$keySkillPower - 1]['enchant_effect'][$keySkillPowerEnchantEffect]['value']))
                                    {
                                        ?>
                                <small class="text-success">+<?php echo number_format_float($rowSkillPowerEnchantEffect['value']); ?></small>
                                        <?php
                                    }
                                    elseif ($rowSkillPowerEnchantEffect['value'] !== $row['reactor_skill_power'][$keySkillPower - 1]['enchant_effect'][$keySkillPowerEnchantEffect]['value'])
                                    {
                                        ?>
                                <small class="text-success">+<?php echo number_format_float($rowSkillPowerEnchantEffect['value'] - $row['reactor_skill_power'][$keySkillPower - 1]['enchant_effect'][$keySkillPowerEnchantEffect]['value']); ?></small>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="card-body">
                    <div class="datagrid">
                        <?php
                        foreach ($rowSkillPower['skill_power_coefficient'] as $keySkillPowerCoefficient => $rowSkillPowerCoefficient)
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo $rowSkillPowerCoefficient['coefficient_stat_id']; ?></div>
                            <div class="datagrid-content">
                                <?php
                                echo number_format_float($rowSkillPowerCoefficient['coefficient_stat_value']);

                                if ($keySkillPower > 0 && $rowSkillPowerCoefficient['coefficient_stat_value'] !== $row['reactor_skill_power'][$keySkillPower - 1]['skill_power_coefficient'][$keySkillPowerCoefficient]['coefficient_stat_value'])
                                {
                                    ?>
                                <small class="text-success">+<?php echo number_format_float($rowSkillPowerCoefficient['coefficient_stat_value'] - $row['reactor_skill_power'][$keySkillPower - 1]['skill_power_coefficient'][$keySkillPowerCoefficient]['coefficient_stat_value']); ?></small>
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
