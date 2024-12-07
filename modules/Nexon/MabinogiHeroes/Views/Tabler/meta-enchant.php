<section id="view-nexon-mabinogi-heroes-meta-enchant">
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
                <label class="form-label" for="type">접두/접미</label>
                <select class="form-select" name="type" id="type">
                    <option value="">전체</option>
                    <option
                        value="0"
                        <?php echo set_select('type', '0', isset($data['get']['type']) && $data['get']['type'] === '0'); ?>
                    >접두</option>
                    <option
                        value="1"
                        <?php echo set_select('type', '1', isset($data['get']['type']) && $data['get']['type'] === '1'); ?>
                    >접미</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="name">인챈트 명</label>
                <input
                    type="text" class="form-control" name="name" id="name"
                    value="<?php echo isset($data['get']['name']) ? quotes_to_entities($data['get']['name']) : ''; ?>"
                >
            </div>

            <div class="mb-3">
                <label class="form-label" for="<?php echo $cCms->searchName; ?>">검색</label>
                <input
                    type="text" class="form-control"
                    name="<?php echo $cCms->searchName; ?>" id="<?php echo $cCms->searchName; ?>"
                    value="<?php echo isset($data['get'][$cCms->searchName]) ? quotes_to_entities($data['get'][$cCms->searchName]) : ''; ?>"
                >
            </div>

            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-outline-success">검색</button>
            </div>

            <?php echo form_close(); ?>
        </div>

        <div class="card-footer">
            Total: <?php echo number_format($data['total'] ?? 0); ?><br>
            검색이 되지 않는 데이터는 접두와 접미를 선택 후 인챈트명을 정확히 기입해서 검색해주세요.
        </div>
    </div>

    <?php
    if (isset($data['list'], $data['total']) && is_array($data['list']) && $data['total'] > 0)
    {
        ?>
    <div class="row row-cards">
        <?php
        foreach ($data['list'] as $eMetaEnchant)
        {
            if ($eMetaEnchant instanceof \Modules\Nexon\MabinogiHeroes\Entities\MetaEnchant)
            {
                ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3" id="item<?php echo $eMetaEnchant->type . $eMetaEnchant->name; ?>">
                <div class="card-header">
                    <div>
                        <div class="card-title"><?php echo $eMetaEnchant->name; ?></div>
                        <div class="card-subtitle"><?php echo $eMetaEnchant->getTypeGrade(); ?></div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="datagrid">
                        <?php
                        foreach ($eMetaEnchant->getStatGoodBad() as $key => $row)
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title">인챈트 능력치 <?php echo $key + 1; ?></div>
                            <div class="datagrid-content">
                                <?php
                                if ($row['goodBad'] === '+')
                                {
                                    ?>
                                <span class="text-success"><?php echo $row['stat']; ?></span>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                <span class="text-danger"><?php echo $row['stat']; ?></span>
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

                <div class="card-footer">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">인챈트 가능 부위</div>
                            <div class="datagrid-content"><?php echo implode(', ', $eMetaEnchant->getAvailableSlotNameLanguage()); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <?php
            }
        }
        ?>
    </div>
        <?php
        echo $data['pagination'] ?? '';
    }
    ?>
</section>
