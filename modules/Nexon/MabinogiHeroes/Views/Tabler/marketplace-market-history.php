<section id="view-nexon-mabinogi-heroes-marketplace-market-history">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            ?>

            <div class="mb-3">
                <label class="form-label" for="item_name">아이템 명</label>
                <input
                    type="text" class="form-control" name="item_name" id="item_name"
                    value="<?php echo isset($data['get']['item_name']) ? quotes_to_entities($data['get']['item_name']) : ''; ?>"
                >
            </div>

            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-outline-success">검색</button>
            </div>

            <?php echo form_close(); ?>
        </div>

        <div class="card-footer">
            현재 평균가는 마지막으로 갱신된 거래 기록의 평균 거래가로 확인 가능합니다.<br>
            최근 24시간 내 10건 이상의 거래가 발생한 아이템의 거래 기록이 조회됩니다.
        </div>
    </div>

    <?php
    if (isset($data['response'], $data['response']['item']) && is_array($data['response']['item']))
    {
        ?>
    <div class="row row-cards">
        <?php
        foreach ($data['response']['item'] as $keyItem => $rowItem)
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3" id="item<?php echo $keyItem; ?>">
                <div class="card-header">
                    <div>
                        <div class="card-title"><?php echo $rowItem['item_name']; ?></div>
                        <div class="card-subtitle">
                            최소 거래가: <?php echo number_format($rowItem['min_price']); ?>
                            /
                            평균 거래가: <?php echo number_format($rowItem['average_price']); ?>
                            /
                            최대 거래가: <?php echo number_format($rowItem['max_price']); ?>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($rowItem['item_option']) && is_array($rowItem['item_option']) && count($rowItem['item_option']) > 0)
                {
                    ?>
                <div class="card-body">
                    <div class="datagrid">
                        <?php
                        foreach ($rowItem['item_option'] as $keyItemOption => $valueItemOption)
                        {
                            if (in_array($keyItemOption, ['tuning_stat', 'power_infusion_preset_1', 'power_infusion_preset_2', 'bracelet_gem_composite']))
                            {
                                continue;
                            }
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title">
                                <?php
                                echo match ($keyItemOption) {
                                    'description'               => '아이템 옵션 정보',
                                    'enhancement_level'         => '강화 단계',
                                    'ability_name'              => '장비에 부여된 어빌리티 명',
                                    'prefix_enchant_preset_1'   => '1번 프리셋 접두 인챈트 명',
                                    'suffix_enchant_preset_1'   => '1번 프리셋 접미 인챈트 명',
                                    'prefix_enchant_preset_2'   => '2번 프리셋 접두 인챈트 명',
                                    'suffix_enchant_preset_2'   => '2번 프리셋 접미 인챈트 명',
                                    'bind_release_limit'        => '아이템 귀속 해제 제한 횟수',
                                    'item_shape_name'           => '매혹의 룬(변경한 외형의 아이템 명)',
                                    'item_quality'              => '아이템 품질',
                                    'value'                     => '기타 아이템 속성',
                                    default => $keyItemOption,
                                };
                                ?>
                            </div>
                            <div class="datagrid-content"><?php echo $valueItemOption; ?></div>
                        </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                    <?php
                    // 아이템 연마 능력치
                    if (isset($rowItem['tuning_stat']) && is_array($rowItem['tuning_stat']) && count($rowItem['tuning_stat']) > 0)
                    {
                        ?>
                <div class="card-body">
                    <div class="datagrid">
                        <?php
                        foreach ($rowItem['tuning_stat'] as $rowItemTuningStat)
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo $rowItemTuningStat['stat_name']; ?></div>
                            <div class="datagrid-content"><?php echo $rowItemTuningStat['stat_value']; ?></div>
                        </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                        <?php
                    }

                    // 1번 프리셋 정령합성 능력치
                    if (isset($rowItem['power_infusion_preset_1']) && is_array($rowItem['power_infusion_preset_1']) && count($rowItem['power_infusion_preset_1']) > 0)
                    {
                        ?>
                <div class="card-body">
                    <div class="datagrid">
                        <?php
                        foreach ($rowItem['power_infusion_preset_1'] as $rowItemPowerInfusionPreset1)
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo $rowItemPowerInfusionPreset1['stat_name']; ?></div>
                            <div class="datagrid-content"><?php echo $rowItemPowerInfusionPreset1['stat_value']; ?></div>
                        </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                        <?php
                    }

                    // 2번 프리셋 정령합성 능력치
                    if (isset($rowItem['power_infusion_preset_2']) && is_array($rowItem['power_infusion_preset_2']) && count($rowItem['power_infusion_preset_2']) > 0)
                    {
                        ?>
                <div class="card-body">
                    <div class="datagrid">
                        <?php
                        foreach ($rowItem['power_infusion_preset_2'] as $rowItemPowerInfusionPreset2)
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo $rowItemPowerInfusionPreset2['stat_name']; ?></div>
                            <div class="datagrid-content"><?php echo $rowItemPowerInfusionPreset2['stat_value']; ?></div>
                        </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                        <?php
                    }

                    // 팔찌 보석 장착 정보
                    if (isset($rowItem['bracelet_gem_composite']) && is_array($rowItem['bracelet_gem_composite']) && count($rowItem['bracelet_gem_composite']) > 0)
                    {
                        ?>
                <div class="card-body">
                    <div class="datagrid">
                        <?php
                        foreach ($rowItem['bracelet_gem_composite'] as $rowItemBraceletGemComposite)
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title">장착 보석 명</div>
                            <div class="datagrid-content"><?php echo $rowItemBraceletGemComposite['item_name']; ?></div>
                        </div>
                            <?php

                            foreach ($rowItemBraceletGemComposite['stat'] as $rowItemBraceletGemCompositeStat)
                            {
                                ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo $rowItemBraceletGemCompositeStat['stat_name']; ?></div>
                            <div class="datagrid-content"><?php echo $rowItemBraceletGemCompositeStat['stat_value']; ?></div>
                        </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                        <?php
                    }
                }
                ?>

                <div class="card-footer">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">갱신 일시</div>
                            <div class="datagrid-content"><?php echo date('Y-m-d H:i:s', strtotime($rowItem['date_update'])); ?></div>
                        </div>
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
