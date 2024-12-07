<section id="view-nexon-mabinogi-heroes-character-item-equipment">
    <?php
    if (isset($data['response']['item_equipment']) && is_array($data['response']['item_equipment']))
    {
        foreach ($data['response']['item_equipment'] as $rowItem)
        {
            ?>
    <div class="card mb-3">
        <div class="card-header">
            <div>
                <div class="card-title"><?php echo $rowItem['item_name']; ?></div>
                <div class="card-subtitle">
                    <?php echo lang('MabinogiHeroes.' . strtolower($rowItem['item_equipment_slot_name'])); ?>
                    <small><?php echo lang('MabinogiHeroes.' . strtolower($rowItem['item_equipment_page'])); ?></small>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <?php
                $option = $rowItem['item_option'];
                ?>
                <div class="datagrid-item">
                    <div class="datagrid-title">강화 단계</div>
                    <div class="datagrid-content"><?php echo number_format($option['enhancement_level']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">장비에 부여된 어빌리티 명</div>
                    <div class="datagrid-content"><?php echo $option['ability_name']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">접두 인챈트</div>
                    <div class="datagrid-content">
                        <span class="<?php echo $option['prefix_enchant_use_preset_no'] === 1 ? 'text-success' : ''; ?>"><?php echo $option['prefix_enchant_preset_1']; ?></span>
                        /
                        <span class="<?php echo $option['prefix_enchant_use_preset_no'] === 2 ? 'text-success' : ''; ?>"><?php echo $option['prefix_enchant_preset_2']; ?></span>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">접미 인챈트</div>
                    <div class="datagrid-content">
                        <span class="<?php echo $option['suffix_enchant_use_preset_no'] === 1 ? 'text-success' : ''; ?>"><?php echo $option['suffix_enchant_preset_1']; ?></span>
                        /
                        <span class="<?php echo $option['suffix_enchant_use_preset_no'] === 2 ? 'text-success' : ''; ?>"><?php echo $option['suffix_enchant_preset_2']; ?></span>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">정령합성 능력치</div>
                    <div class="datagrid-content">
                        <?php
                        if (isset($option['power_infusion_preset_1']))
                        {
                            ?>
                        <span class="<?php echo $option['power_infusion_use_preset_no'] === 1 ? 'text-success' : ''; ?>">
                            <?php echo $option['power_infusion_preset_1']['stat_name']; ?>
                            <?php echo $option['power_infusion_preset_1']['stat_value']; ?>
                        </span>
                            <?php
                        }
                        ?>
                        /
                        <?php
                        if (isset($option['power_infusion_preset_2']))
                        {
                            ?>
                        <span class="<?php echo $option['power_infusion_use_preset_no'] === 2 ? 'text-success' : ''; ?>">
                            <?php echo $option['power_infusion_preset_2']['stat_name']; ?>
                            <?php echo $option['power_infusion_preset_2']['stat_value']; ?>
                        </span>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <?php
                for ($i = 1; $i <= 3; $i++)
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title">캐시 색상 파트 <?php echo $i; ?></div>
                    <div class="datagrid-content">
                        <span class="avatar avatar-xs me-2 rounded" style="background-color: rgb(<?php echo $option['cash_item_color']['color_' . $i]; ?>);"></span>
                        <?php echo $option['cash_item_color']['color_' . $i]; ?>
                    </div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <?php
        if (count($option['tuning_stat']) > 0)
        {
            ?>
        <div class="card-footer">
            <div class="datagrid">
                <?php
                foreach ($option['tuning_stat'] as $row)
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo $row['stat_name']; ?></div>
                    <div class="datagrid-content"><?php echo number_format($row['stat_value']); ?></div>
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
    }
    ?>

    <div class="btn-list justify-content-end">
        <a
            class="btn btn-outline-primary"
            href="<?php echo site_to('nexon_mabinogi_heroes_character_main') . '?' . current_url(true)->getQuery(); ?>"
        >캐릭터 정보 조회</a>
        <a
            class="btn btn-outline-primary"
            href="<?php echo site_to('nexon_mabinogi_heroes_character_title_equipment') . '?' . current_url(true)->getQuery(); ?>"
        >타이틀/문양 정보 조회</a>
    </div>
</section>
