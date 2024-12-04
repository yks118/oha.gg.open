<section id="view-nexon-mabinogi-dye-color">
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

            <div class="btn-list justify-content-end">
                <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('add-dye-color').style.display = 'block';">추가</button>
                <button type="submit" class="btn btn-outline-success">검색</button>
            </div>

            <?php echo form_close(); ?>
        </div>

        <div class="card-footer">Total: <?php echo number_format($data['total'] ?? 0); ?></div>
    </div>

    <div class="card mb-3" id="add-dye-color" style="display: none;">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'autocomplete'  => 'off',
            ]);
            ?>

            <div class="mb-3">
                <label class="form-label" for="hex">
                    Hex
                    <small>(Ex. ffffff)</small>
                </label>
                <input
                    type="text" class="form-control" name="hex" id="hex"
                    value="<?php echo set_value('hex'); ?>"
                >
            </div>

            <div class="mb-3">
                <label class="form-label" for="rgb">
                    RGB
                    <small>(Ex. 255,255,255)</small>
                </label>
                <input
                    type="text" class="form-control" name="rgb" id="rgb"
                    value="<?php echo set_value('rgb'); ?>"
                >
            </div>

            <div class="mb-3">
                <label class="form-label" for="name">
                    색상 짧은 이름
                    <small>(Ex. 리화)</small>
                </label>
                <input
                    type="text" class="form-control" name="name" id="name"
                    value="<?php echo set_value('name'); ?>"
                >
            </div>

            <div class="mb-3">
                <label class="form-label" for="name_full">
                    색상 전체 이름
                    <small>(Ex. 리얼 화이트)</small>
                </label>
                <input
                    type="text" class="form-control" name="name_full" id="name_full"
                    value="<?php echo set_value('name_full'); ?>"
                >
            </div>

            <div class="btn-list justify-content-end">
                <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('add-dye-color').style.display = 'none';">닫기</button>
                <button type="submit" class="btn btn-outline-success">추가</button>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>

    <?php
    if (isset($data['list'], $data['total']) && is_array($data['list']) && $data['total'] > 0)
    {
        ?>
    <div class="row row-cards">
        <?php
        foreach ($data['list'] as $eDyeColor)
        {
            if ($eDyeColor instanceof \Modules\Nexon\Mabinogi\Entities\DyeColor)
            {
                ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-header">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar" style="background-color: rgb(<?php echo $eDyeColor->rgb; ?>);"></span>
                            </div>
                            <div class="col">
                                <div class="card-title"><?php echo $eDyeColor->name; ?></div>
                                <div class="card-subtitle"><?php echo $eDyeColor->name_full; ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="card-actions">
                        <div class="dropdown">
                            <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- Download SVG icon from https://tabler-icons.io/i/dots-vertical -->
                                <i class="ti ti-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <?php
                                foreach ($eDyeColor->getUrlViews() as $rowUrlView)
                                {
                                    ?>
                                <a class="dropdown-item" href="<?php echo $rowUrlView['href']; ?>"><?php echo $rowUrlView['text']; ?></a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Hex</div>
                            <div class="datagrid-content">#<?php echo $eDyeColor->hex; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">RGB</div>
                            <div class="datagrid-content"><?php echo $eDyeColor->rgb; ?></div>
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
    }
    ?>

    <?php echo $data['pagination'] ?? ''; ?>
</section>
