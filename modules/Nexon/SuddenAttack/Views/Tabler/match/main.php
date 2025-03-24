<section id="view-nexon-sudden-attack-match-main">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            ?>

            <input type="hidden" name="user_name" value="<?php echo $data['get']['user_name'] ?? ''; ?>">
            <input type="hidden" name="ouid" value="<?php echo $data['get']['ouid'] ?? ''; ?>">

            <?php
            if (isset($data['match']['modes']) && is_array($data['match']['modes']))
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="mode">게임 모드</label>
                <select class="form-select" name="mode" id="mode">
                    <?php
                    foreach ($data['match']['modes'] as $mode)
                    {
                        ?>
                    <option
                        value="<?php echo $mode; ?>"
                        <?php
                        echo set_select(
                            'mode',
                            $mode,
                            isset($data['get']['mode']) && $data['get']['mode'] === $mode
                        );
                        ?>
                    ><?php echo $mode; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }

            if (isset($data['match']['types']) && is_array($data['match']['types']))
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="type">매치 유형</label>
                <select class="form-select" name="type" id="type">
                    <option value="">전체</option>

                    <?php
                    foreach ($data['match']['types'] as $type)
                    {
                        ?>
                    <option
                            value="<?php echo $type; ?>"
                        <?php
                        echo set_select(
                            'type',
                            $type,
                            isset($data['get']['type']) && $data['get']['type'] === $type
                        );
                        ?>
                    ><?php echo $type; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }
            ?>

            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-outline-success">검색</button>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>

    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        ?>
    <div class="row row-cards">
        <?php
        foreach ($data['response']['match'] as $row)
        {
            $href = site_to('nexon_sudden_attack_match_detail', $row['match_id'])
                . '?' . current_url(true)->getQuery();
            ;
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3" id="<?php echo $row['match_id']; ?>">
                <div class="card-header">
                    <div>
                        <a class="card-title" href="<?php echo $href; ?>">
                            <?php echo $row['match_mode']; ?>
                            /
                            <?php echo $row['match_type']; ?>
                        </a>
                        <p class="card-subtitle">
                            <?php echo date('Y-m-d H:i:s', strtotime($row['date_match'])); ?>
                        </p>
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

    <div class="btn-list justify-content-end">
        <?php
        $href = site_to('nexon_sudden_attack_main')
            . '?' . current_url(true)->getQuery()
        ;
        ?>
        <a class="btn btn-outline-success" href="<?php echo $href; ?>">기본 정보 조회</a>
    </div>
</section>
