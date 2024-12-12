<section id="view-nexon-maple-story-m-character-main">
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
                <li>메이플스토리M의 게임 데이터는 평균 30분 후 확인 가능합니다.</li>
                <li>2022년 1월 1일 이후 데이터를 조회할 수 있습니다. (단, 2022년 1월 이전에 발생한 데이터는 응답 결과에 포함되지 않을 수 있음)</li>
            </ol>
        </div>
    </div>

    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        if (isset($data['response']['basic'], $data['response']['stat']) && is_array($data['response']['basic']) && is_array($data['response']['stat']))
        {
            $basic = $data['response']['basic'];
            ?>
    <div class="card mb-3" id="basic">
        <div class="card-header">
            <div>
                <h3 class="card-title">[<?php echo $basic['world_name']; ?>] <?php echo $basic['character_name']; ?></h3>
                <p class="card-subtitle">
                    <?php
                    if ($basic['character_date_create'])
                    {
                        echo date('Y-m-d H:i:s', strtotime($basic['character_date_create']));
                    }
                    ?>
                </p>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">캐릭터 직업 명</div>
                    <div class="datagrid-content"><?php echo $basic['character_job_name']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">캐릭터 성별</div>
                    <div class="datagrid-content"><?php echo convert_gender($basic['character_gender']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">캐릭터 레벨</div>
                    <div class="datagrid-content"><?php echo number_format($basic['character_level']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">캐릭터 경험치</div>
                    <div class="datagrid-content"><?php echo number_format($basic['character_exp']); ?></div>
                </div>

                <?php
                foreach ($data['response']['stat'] as $row)
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo $row['stat_name']; ?></div>
                    <div class="datagrid-content"><?php echo number_format($row['stat_value']); ?></div>
                </div>
                    <?php
                }
                ?>

                <div class="datagrid-item">
                    <div class="datagrid-title">가입한 길드 명</div>
                    <div class="datagrid-content"><?php echo $data['response']['guild']; ?></div>
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

        if (isset($data['response']['itemEquipment']) && is_array($data['response']['itemEquipment']))
        {
            ?>
    <div class="card mb-3" id="itemEquipment">
        <div class="card-header">
            <div>
                <h3 class="card-title">장착 아이템</h3>
                <p class="card-subtitle">일반 아이템</p>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <?php
                foreach ($data['response']['itemEquipment'] as $row)
                {
                    if (str_ends_with($row['item_name'], '(Cash)'))
                    {
                        continue;
                    }
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo $row['item_equipment_slot_name']; ?></div>
                    <div class="datagrid-content"><?php echo $row['item_name']; ?></div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="card mb-3" id="itemEquipmentCash">
        <div class="card-header">
            <div>
                <h3 class="card-title">장착 아이템</h3>
                <p class="card-subtitle">캐시 아이템</p>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <?php
                foreach ($data['response']['itemEquipment'] as $row)
                {
                    if (! str_ends_with($row['item_name'], '(Cash)'))
                    {
                        continue;
                    }
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo $row['item_equipment_slot_name']; ?></div>
                    <div class="datagrid-content"><?php echo $row['item_name']; ?></div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
            <?php
        }

        if (isset($data['response']['beautyEquipment']) && is_array($data['response']['beautyEquipment']))
        {
            $beautyEquipment = $data['response']['beautyEquipment'];
            ?>
    <div class="card mb-3" id="beautyEquipment">
        <div class="card-header">
            <div>
                <h3 class="card-title">장착중인 헤어, 성형, 피부</h3>
                <p class="card-subtitle">
                    <?php
                    echo trim($beautyEquipment['character_skin_name'] . ' / ' . $beautyEquipment['additional_character_skin_name'], ' /');
                    ?>
                </p>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">헤어 명</div>
                    <div class="datagrid-content">
                        <?php
                        echo trim($beautyEquipment['character_hair']['hair_name'] . ' / ' . $beautyEquipment['additional_character_hair']['hair_name'], ' /');
                        ?>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">헤어 베이스 컬러</div>
                    <div class="datagrid-content">
                        <?php
                        echo trim($beautyEquipment['character_hair']['base_color'] . ' / ' . $beautyEquipment['additional_character_hair']['base_color'], ' /');
                        ?>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">헤어 믹스 컬러</div>
                    <div class="datagrid-content">
                        <?php
                        echo trim($beautyEquipment['character_hair']['mix_color'] . ' / ' . $beautyEquipment['additional_character_hair']['mix_color'], ' /');
                        ?>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">헤어 믹스 컬러의 염색 비율</div>
                    <div class="datagrid-content">
                        <?php
                        echo trim($beautyEquipment['character_hair']['mix_rate'] . ' / ' . $beautyEquipment['additional_character_hair']['mix_rate'], ' /');
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">성형 명</div>
                    <div class="datagrid-content">
                        <?php
                        echo trim($beautyEquipment['character_face']['face_name'] . ' / ' . $beautyEquipment['additional_character_face']['face_name'], ' /');
                        ?>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">성형 베이스 컬러</div>
                    <div class="datagrid-content">
                        <?php
                        echo trim($beautyEquipment['character_face']['base_color'] . ' / ' . $beautyEquipment['additional_character_face']['base_color'], ' /');
                        ?>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">성형 믹스 컬러</div>
                    <div class="datagrid-content">
                        <?php
                        echo trim($beautyEquipment['character_face']['mix_color'] . ' / ' . $beautyEquipment['additional_character_face']['mix_color'], ' /');
                        ?>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">성형 믹스 컬러의 염색 비율</div>
                    <div class="datagrid-content">
                        <?php
                        echo trim($beautyEquipment['character_face']['mix_rate'] . ' / ' . $beautyEquipment['additional_character_face']['mix_rate'], ' /');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <?php
        }

        if (isset($data['response']['petEquipment']) && is_array($data['response']['petEquipment']))
        {
            $petEquipment = $data['response']['petEquipment'];
            ?>
    <div class="card mb-3" id="petEquipment">
        <div class="card-header">
            <div>
                <h3 class="card-title">장착중인 펫</h3>
                <p class="card-subtitle"></p>
            </div>
        </div>

        <?php
        for ($i = 1; $i <= 3; $i++)
        {
            ?>
        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">펫<?php echo $i; ?> 명</div>
                    <div class="datagrid-content"><?php echo $petEquipment['pet_' . $i . '_name']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">펫<?php echo $i; ?> 원더 펫 종류</div>
                    <div class="datagrid-content"><?php echo $petEquipment['pet_' . $i . '_pet_type']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">펫<?php echo $i; ?> 마법의 시간</div>
                    <div class="datagrid-content">~ <?php echo date('Y-m-d H:i:s', strtotime($petEquipment['pet_' . $i . '_date_expire'])); ?></div>
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
            href="<?php echo site_to('nexon_maple_story_m_character_skill') . '?' . current_url(true)->getQuery(); ?>"
        >장착 스킬</a>
        <a
            class="btn btn-outline-primary"
            href="<?php echo site_to('nexon_maple_story_m_character_vmatrix') . '?' . current_url(true)->getQuery(); ?>"
        >V매트릭스</a>
    </div>
        <?php
    }
    ?>
</section>
