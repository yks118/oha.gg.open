<section id="view-nexon-baram-y-main">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            ?>

            <?php
            if (isset($data['serverNames']) && is_array($data['serverNames']))
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="server_name">서버 명</label>
                <select class="form-select" name="server_name" id="server_name">
                    <?php
                    foreach ($data['serverNames'] as $serverName)
                    {
                        ?>
                        <option
                            value="<?php echo $serverName; ?>"
                            <?php echo set_select('server_name', $serverName, isset($data['get']['server_name']) && $data['get']['server_name'] === $serverName); ?>
                        ><?php echo $serverName; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }
            ?>

            <div class="mb-3">
                <label class="form-label" for="character_name">캐릭터 명</label>
                <input
                    type="text" class="form-control" name="character_name" id="character_name" required
                    value="<?php echo set_value('character_name', $data['get']['character_name'] ?? ''); ?>"
                >
            </div>

            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-outline-success">검색</button>
            </div>

            <?php echo form_close(); ?>
        </div>

        <div class="card-footer">
            <ol class="mb-0">
                <li>바람의나라:연의 게임 데이터는 평균 10분 후 확인 가능합니다.</li>
                <li>2022년 1월 1일 이후 데이터를 조회할 수 있습니다. (단, 2022년 1월 이전에 발생한 데이터는 응답 결과에 포함되지 않을 수 있음)</li>
            </ol>
        </div>
    </div>

    <?php
    if (isset($data['response']))
    {
        if (isset($data['response']['basic']) && is_array($data['response']['basic']))
        {
            $basic = $data['response']['basic'];
            ?>
    <div class="card mb-3" id="basic">
        <div class="card-header">
            <div>
                <h3 class="card-title">[<?php echo $basic['server_name']; ?>] <?php echo $basic['character_name']; ?></h3>
                <p class="card-subtitle"><?php echo date('Y-m-d H:i:s', strtotime($basic['character_date_create'])); ?></p>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">캐릭터 직업군 명</div>
                    <div class="datagrid-content"><?php echo $basic['character_class_group_name']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">캐릭터 직업 명</div>
                    <div class="datagrid-content"><?php echo $basic['character_class_name']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">캐릭터 국적</div>
                    <div class="datagrid-content"><?php echo $basic['character_nation']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">캐릭터 성별</div>
                    <div class="datagrid-content"><?php echo convert_gender($basic['character_gender']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">캐릭터 경험치</div>
                    <div class="datagrid-content"><?php echo number_format($basic['character_exp']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">캐릭터 레벨</div>
                    <div class="datagrid-content"><?php echo number_format($basic['character_level']); ?></div>
                </div>
            </div>
        </div>
    </div>
            <?php
        }

        if (isset($data['response']['title'], $data['response']['titleEquipment']) && is_array($data['response']['title']) && is_array($data['response']['titleEquipment']))
        {
            $title = $data['response']['title'];
            $titleEquipment = array_column($data['response']['titleEquipment'], 'title_name');
            ?>
    <div class="card mb-3" id="title">
        <div class="card-header">
            <div>
                <h3 class="card-title">보유중인 칭호 목록</h3>
                <p class="card-subtitle"><?php echo $data['response']['titleEquipment'][0]['title_name'] ?? ''; ?></p>
            </div>
        </div>

        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($title as $row)
            {
                ?>
            <div class="list-group-item">
                <div class="text-truncate">
                    <div class="text-reset d-block">
                        <?php
                        echo $row['title_name'];

                        if (in_array($row['title_name'], $titleEquipment))
                        {
                            ?>
                        <small class="text-success">장착중</small>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="d-block text-secondary text-truncate mt-n1"><?php echo $row['title_type_name']; ?></div>
                </div>
            </div>
                <?php
            }
            ?>
        </div>
    </div>
            <?php
        }

        echo print_r2($data['response']);
    }
    ?>
</section>
