<section id="view-nexon-hit2-main">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
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
                <li>히트2의 게임 데이터는 평균 10분 후 확인 가능합니다.</li>
                <li>2022년 8월 25일 이후 데이터를 조회할 수 있습니다.</li>
            </ol>
        </div>
    </div>

    <?php
    if (isset($data['response']) && is_array($data['response']))
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
                    <div class="datagrid-title">캐릭터 레벨</div>
                    <div class="datagrid-content"><?php echo number_format($basic['character_level']); ?></div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">마지막 로그인 일시</div>
                    <div class="datagrid-content"><?php echo date('Y-m-d H:i:s', strtotime($basic['character_date_last_login'])); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">마지막 로그아웃 일시</div>
                    <div class="datagrid-content"><?php echo date('Y-m-d H:i:s', strtotime($basic['character_date_last_logout'])); ?></div>
                </div>
            </div>
        </div>
    </div>
            <?php
        }
    }
    ?>
</section>
