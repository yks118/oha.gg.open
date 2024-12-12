<section id="view-nexon-maple-story-m-character-vmatrix">
    <?php
    if (isset($data['response']['vmatrix']) && is_array($data['response']['vmatrix']))
    {
        $vmatrix = $data['response']['vmatrix'];
        ?>
    <div class="card mb-3" id="vmatrix">
        <div class="card-header">
            <div>
                <h3 class="card-title">V매트릭스 정보</h3>
                <p class="card-subtitle"><?php echo $vmatrix['character_class']; ?></p>
            </div>
        </div>
    </div>

    <div class="row row-cards">
        <?php
        foreach ($vmatrix['character_v_core_equipment'] as $row)
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">슬롯 인덱스</div>
                            <div class="datagrid-content"><?php echo $row['slot_id']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">슬롯 레벨</div>
                            <div class="datagrid-content"><?php echo $row['slot_level']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">코어 명</div>
                            <div class="datagrid-content"><?php echo $row['v_core_name']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">코어 타입</div>
                            <div class="datagrid-content"><?php echo $row['v_core_type']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">코어 레벨</div>
                            <div class="datagrid-content"><?php echo $row['v_core_level']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">코어에 해당하는 스킬 명</div>
                            <div class="datagrid-content"><?php echo $row['v_core_skill_name_1']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">(강화 코어인 경우) 코어에 해당하는 두 번째 스킬 명</div>
                            <div class="datagrid-content"><?php echo $row['v_core_skill_name_2']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">(강화 코어인 경우) 코어에 해당하는 세 번째 스킬 명</div>
                            <div class="datagrid-content"><?php echo $row['v_core_skill_name_3']; ?></div>
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

    <div class="btn-list justify-content-end">
        <a
            class="btn btn-outline-primary"
            href="<?php echo site_to('nexon_maple_story_m_character_main') . '?' . current_url(true)->getQuery(); ?>"
        >캐릭터 정보 조회</a>
        <a
            class="btn btn-outline-primary"
            href="<?php echo site_to('nexon_maple_story_m_character_skill') . '?' . current_url(true)->getQuery(); ?>"
        >장착 스킬</a>
    </div>
</section>
