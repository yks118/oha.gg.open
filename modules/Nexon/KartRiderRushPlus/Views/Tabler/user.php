<section id="view-nexon-kart-rider-rush-plus-user">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            ?>

            <div class="mb-3">
                <label class="form-label" for="racer_name">라이더(계정) 명</label>
                <input
                    type="text" class="form-control" name="racer_name" id="racer_name" required
                    value="<?php echo set_value('racer_name', $data['get']['racer_name'] ?? ''); ?>"
                >
            </div>

            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-outline-success">검색</button>
            </div>

            <?php echo form_close(); ?>
        </div>

        <div class="card-footer">
            <ol class="mb-0">
                <li>카트라이더 러쉬플러스의 게임 데이터는 평균 10분 후 확인 가능합니다.</li>
                <li>2022년 1월 1일 이후 데이터를 조회할 수 있습니다. (단, 2022년 1월 이전에 발생한 데이터는 응답 결과에 포함되지 않을 수 있음)</li>
            </ol>
        </div>
    </div>

    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        if (isset($data['response']['basic'], $data['response']['titleEquipment']) && is_array($data['response']['basic']) && is_array($data['response']['titleEquipment']))
        {
            $basic          = $data['response']['basic'];
            $titleEquipment = $data['response']['titleEquipment'];
            ?>
    <div class="card mb-3" id="basic">
        <div class="card-header">
            <div>
                <h3 class="card-title"><?php echo $basic['racer_name']; ?></h3>
                <p class="card-subtitle"><?php echo date('Y-m-d H:i:s', strtotime($basic['racer_date_create'])); ?></p>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">라이더(계정) 레벨</div>
                    <div class="datagrid-content"><?php echo number_format($basic['racer_level']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">장착 칭호 명</div>
                    <div class="datagrid-content"><?php echo $titleEquipment[0]['title_name']; ?></div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">마지막 로그인 일시</div>
                    <div class="datagrid-content"><?php echo date('Y-m-d H:i:s', strtotime($basic['racer_date_last_login'])); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">마지막 로그아웃 일시</div>
                    <div class="datagrid-content"><?php echo date('Y-m-d H:i:s', strtotime($basic['racer_date_last_logout'])); ?></div>
                </div>
            </div>
        </div>
    </div>
            <?php
        }
    }
    ?>
</section>
