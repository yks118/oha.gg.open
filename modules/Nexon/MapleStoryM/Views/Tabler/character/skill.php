<section id="view-nexon-maple-story-m-character-skill">
    <?php
    if (isset($data['response']['skillEquipment']) && is_array($data['response']['skillEquipment']))
    {
        $skillEquipment = $data['response']['skillEquipment'];
        ?>
    <div class="card mb-3" id="skillEquipment">
        <div class="card-header">
            <div>
                <h3 class="card-title">장착 스킬 정보</h3>
                <p class="card-subtitle"><?php echo $skillEquipment['character_class']; ?></p>
            </div>
        </div>
    </div>

    <div class="row row-cards">
        <?php
        foreach ($skillEquipment['skill']['equipment_skill'] as $row)
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">현재 사용 중인 스킬 모드</div>
                            <div class="datagrid-content"><?php echo $row['skill_mode']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">해당 스킬을 장착한 스킬 세팅</div>
                            <div class="datagrid-content"><?php echo $row['equipment_skill_set']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">스킬 장착 슬롯 인덱스</div>
                            <div class="datagrid-content"><?php echo $row['slot_id']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">스킬 명</div>
                            <div class="datagrid-content"><?php echo $row['skill_name']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">스킬 타입</div>
                            <div class="datagrid-content"><?php echo empty($row['skill_type']) ? '&nbsp;' : str_replace('SkillType_', '', $row['skill_type']); ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">스킬 차수</div>
                            <div class="datagrid-content"><?php echo empty($row['skill_grade']) ? '&nbsp;' : $row['skill_grade']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">추가 기능 활성화 여부</div>
                            <div class="datagrid-content"><?php echo empty($row['add_feature_flag']) ? '&nbsp;' : $row['add_feature_flag']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php
        }
        ?>
    </div>

    <div class="card mb-3" id="preset">
        <div class="card-header">
            <div>
                <h3 class="card-title">스킬 프리셋</h3>
                <p class="card-subtitle"></p>
            </div>
        </div>

        <?php
        foreach ($skillEquipment['skill']['preset'] as $row)
        {
            ?>
        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">스킬 프리셋의 번호</div>
                    <div class="datagrid-content"><?php echo $row['preset_slot_no']; ?></div>
                </div>

                <?php
                for ($i = 1; $i <= 4; $i++)
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo $i; ?>번 슬롯에 등록된 스킬 명</div>
                    <div class="datagrid-content"><?php echo $row['skill_name_' . $i]; ?></div>
                </div>
                    <?php
                }
                ?>

                <div class="datagrid-item">
                    <div class="datagrid-title">스킬 프리셋의 커맨드 ON 활성화 여부</div>
                    <div class="datagrid-content"><?php echo $row['preset_command_flag']; ?></div>
                </div>
            </div>
        </div>
            <?php
        }
        ?>
    </div>

    <div class="card mb-3" id="stealSkill">
        <div class="card-header">
            <div>
                <h3 class="card-title">팬텀–탤런트 오브 팬텀시프를 통해 장착한 스킬 정보</h3>
                <p class="card-subtitle"></p>
            </div>
        </div>

        <?php
        foreach ($skillEquipment['skill']['steal_skill'] as $row)
        {
            ?>
        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">스킬 명</div>
                    <div class="datagrid-content"><?php echo $row['preset_slot_no']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">스킬 슬롯 정보</div>
                    <div class="datagrid-content"><?php echo $row['skill_slot']; ?></div>
                </div>
            </div>
        </div>
            <?php
        }
        ?>
    </div>

    <div class="card mb-3" id="stellaMemorize">
        <div class="card-header">
            <div>
                <h3 class="card-title">시아–스텔라 메모라이즈에 등록된 스킬 정보</h3>
                <p class="card-subtitle"></p>
            </div>
        </div>

        <?php
        foreach ($skillEquipment['skill']['stella_memorize'] as $row)
        {
            ?>
        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">스킬 명</div>
                    <div class="datagrid-content"><?php echo $row['skill_name']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">스킬을 장착한 스킬 세팅</div>
                    <div class="datagrid-content"><?php echo $row['equipment_skill_set']; ?></div>
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
            href="<?php echo site_to('nexon_maple_story_m_character_vmatrix') . '?' . current_url(true)->getQuery(); ?>"
        >V매트릭스</a>
    </div>
</section>
