<section id="view-nexon-baram-main">
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
                <li>바람의나라의 게임 데이터는 평균 10분 후 확인 가능합니다.</li>
                <li>2022년 1월 1일 이후 데이터를 조회할 수 있습니다. (단, 2022년 1월 이전에 발생한 데이터는 응답 결과에 포함되지 않을 수 있음)</li>
            </ol>
        </div>
    </div>

    <?php
    if (isset($data['response']))
    {
        if (isset($data['response']['basic']))
        {
            $basic = $data['response']['basic'];
            ?>
    <div class="card mb-3" id="basic">
        <div class="row row-0">
            <div class="col-auto">
                <img
                    class="w-100 h-100 object-cover card-img-start"
                    alt="<?php echo $data['get']['server_name'] . '_' . $data['get']['character_name']; ?>"
                    src="<?php echo nexon_baram_image_render_profile($data['get']['server_name'], $data['get']['character_name']); ?>"
                >
            </div>
            <div class="col">
                <div class="card-header">
                    <div>
                        <h3 class="card-title"><?php echo $basic['character_name']; ?></h3>
                        <p class="card-subtitle">생성 일시: <?php echo date('Y-m-d H:i:s', strtotime($basic['character_date_create'])); ?></p>
                    </div>
                </div>

                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">직업</div>
                            <div class="datagrid-content"><?php echo $basic['character_class_name']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">국가</div>
                            <div class="datagrid-content"><?php echo $basic['character_nation_name']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">성별</div>
                            <div class="datagrid-content"><?php echo convert_gender($basic['character_gender']); ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">레벨</div>
                            <div class="datagrid-content"><?php echo $basic['character_level']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">경험치</div>
                            <div class="datagrid-content"><?php echo number_format($basic['character_exp']); ?></div>
                        </div>

                        <?php
                        if (isset($data['response']['guild']['guild_name']) && $data['response']['guild']['guild_name'])
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title">문파 명</div>
                            <div class="datagrid-content"><?php echo $data['response']['guild']['guild_name']; ?></div>
                        </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <?php
        }

        if (isset($data['response']['stat']['stat']) && is_array($data['response']['stat']['stat']))
        {
            ?>
    <div class="card mb-3" id="stat">
        <div class="card-body">
            <div class="datagrid">
                <?php
                foreach ($data['response']['stat']['stat'] as $stat)
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo $stat['stat_name']; ?></div>
                    <div class="datagrid-content"><?php echo number_format($stat['stat_value']); ?></div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
            <?php
        }

        if (isset($data['response']['itemEquipment']['item_equipment']) && is_array($data['response']['itemEquipment']['item_equipment']))
        {
            ?>
    <div class="card mb-3" id="itemEquipment">
        <div class="card-body">
            <div class="datagrid">
                <?php
                foreach ($data['response']['itemEquipment']['item_equipment'] as $itemEquipment)
                {
                    if (! str_starts_with($itemEquipment['item_equipment_slot_name'], '캐시'))
                    {
                        ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo $itemEquipment['item_equipment_slot_name']; ?></div>
                    <div class="datagrid-content">
                        <?php
                        if ($itemEquipment['item_id'])
                        {
                            ?>
                        <img
                            class="avatar avatar-xs me-2 rounded"
                            alt="<?php echo $itemEquipment['item_equipment_slot_name'] . '_' . $itemEquipment['item_id']; ?>"
                            src="<?php echo nexon_baram_image_render_item($itemEquipment['item_id']); ?>"
                        >
                            <?php
                            echo $itemEquipment['item_id'];
                        }
                        ?>
                    </div>
                </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

        <div class="card-body" id="itemEquipmentCash">
            <div class="datagrid">
                <?php
                foreach ($data['response']['itemEquipment']['item_equipment'] as $itemEquipment)
                {
                    if (str_starts_with($itemEquipment['item_equipment_slot_name'], '캐시'))
                    {
                        ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo $itemEquipment['item_equipment_slot_name']; ?></div>
                    <div class="datagrid-content">
                        <?php
                        if ($itemEquipment['item_id'])
                        {
                            ?>
                        <img
                            class="avatar avatar-xs me-2 rounded"
                            alt="<?php echo $itemEquipment['item_equipment_slot_name'] . '_' . $itemEquipment['item_id']; ?>"
                            src="<?php echo nexon_baram_image_render_item($itemEquipment['item_id']); ?>"
                        >
                            <?php
                            echo $itemEquipment['item_id'];
                        }
                        ?>
                    </div>
                </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
            <?php
        }

        if (isset($data['response']['title']['title']) && is_array($data['response']['title']['title']))
        {
            ?>
    <div class="card mb-3" id="title">
        <div class="card-header">
            <div>
                <h3 class="card-title">보유중인 칭호 목록</h3>
            </div>
        </div>

        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            $titleEquipments = [];
            if (isset($data['response']['titleEquipment']) && is_array($data['response']['titleEquipment']))
            {
                $titleEquipments = array_column($data['response']['titleEquipment']['title_equipment'], 'title_id');
            }

            foreach ($data['response']['title']['title'] as $title)
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

                    <?php
                    // 기간제가 아닌 경우는 값이 비어있음..
                    if ($title['date_expire'])
                    {
                        ?>
                    <div class="d-block text-secondary text-truncate mt-n1"><?php echo date('Y-m-d H:i:s', strtotime($title['date_expire'])); ?></div>
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
            <?php
        }
    }
    ?>
</section>
