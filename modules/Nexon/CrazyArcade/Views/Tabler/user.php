<section id="view-nexon-crazy-arcade-user">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            ?>

            <?php
            if (isset($data['worldNames']) && is_array($data['worldNames']))
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="world_name">월드 명</label>
                <select class="form-select" name="world_name" id="world_name">
                    <?php
                    foreach ($data['worldNames'] as $worldNames)
                    {
                        ?>
                    <option
                        value="<?php echo $worldNames; ?>"
                        <?php echo set_select('world_name', $worldNames, isset($data['get']['world_name']) && $data['get']['world_name'] === $worldNames); ?>
                    ><?php echo $worldNames; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }
            ?>

            <div class="mb-3">
                <label class="form-label" for="user_name">아이디</label>
                <input
                    type="text" class="form-control" name="user_name" id="user_name" required
                    value="<?php echo set_value('user_name', $data['get']['user_name'] ?? ''); ?>"
                >
            </div>

            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-outline-success">검색</button>
            </div>

            <?php echo form_close(); ?>
        </div>

        <div class="card-footer">
            <ol class="mb-0">
                <li>크레이지 아케이드의 게임 데이터는 평균 10분 후 확인 가능합니다.</li>
                <li>2022년 1월 1일 이후 데이터를 조회할 수 있습니다. (단, 2022년 1월 이전에 발생한 데이터는 응답 결과에 포함되지 않을 수 있음)</li>
            </ol>
        </div>
    </div>

    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        if (isset($data['response']['basic'], $data['response']['guild']) && is_array($data['response']['basic']))
        {
            $basic = $data['response']['basic'];
            ?>
    <div class="card mb-3" id="basic">
        <div class="card-header">
            <div>
                <h3 class="card-title"><?php echo $basic['user_name']; ?></h3>
                <p class="card-subtitle"><?php echo date('Y-m-d H:i:s', strtotime($basic['user_date_create'])); ?></p>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">레벨</div>
                    <div class="datagrid-content"><?php echo number_format($basic['user_level']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">경험치</div>
                    <div class="datagrid-content"><?php echo number_format($basic['user_exp']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">길드</div>
                    <div class="datagrid-content"><?php echo $data['response']['guild']; ?></div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">마지막 로그인 일시</div>
                    <div class="datagrid-content"><?php echo date('Y-m-d H:i:s', strtotime($basic['user_date_last_login'])); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">마지막 로그아웃 일시</div>
                    <div class="datagrid-content"><?php echo date('Y-m-d H:i:s', strtotime($basic['user_date_last_logout'])); ?></div>
                </div>
            </div>
        </div>
    </div>
            <?php
        }

        if (isset($data['response']['itemEquipment']) && is_array($data['response']['itemEquipment']))
        {
            ?>
    <div class="card mb-3" id="itemEquipment">
        <div class="card-header">
            <div>
                <h3 class="card-title">장착 아이템</h3>
                <p class="card-subtitle"></p>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <?php
                foreach ($data['response']['itemEquipment'] as $itemEquipment)
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo $itemEquipment['item_equipment_slot_name']; ?></div>
                    <div class="datagrid-content"><?php echo $itemEquipment['item_name']; ?></div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
            <?php
        }

        if (
            isset($data['response']['title'], $data['response']['titleEquipment'])
            && is_array($data['response']['title']) && is_array($data['response']['titleEquipment'])
        )
        {
            ?>
    <div class="card mb-3" id="title">
        <div class="card-header">
            <div>
                <h3 class="card-title">보유중인 칭호 목록</h3>
                <p class="card-subtitle">
                    <?php
                    echo ($data['response']['titleEquipment'][0]['title_id'] ?? '') . ' ' . ($data['response']['titleEquipment'][1]['title_id'] ?? '');
                    ?>
                </p>
            </div>
        </div>

        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            $titleEquipments = array_column($data['response']['titleEquipment'], 'title_id');

            foreach ($data['response']['title'] as $title)
            {
                ?>
                <div class="list-group-item">
                    <div class="text-truncate">
                        <div class="text-reset d-block">
                            <?php
                            echo $title['title_id'];

                            if (in_array($title['title_id'], $titleEquipments))
                            {
                                ?>
                            <small class="text-success">장착중</small>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="d-block text-secondary text-truncate mt-n1"><?php echo $title['title_grade_name']; ?></div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
            <?php
        }
    }
    ?>
</section>
