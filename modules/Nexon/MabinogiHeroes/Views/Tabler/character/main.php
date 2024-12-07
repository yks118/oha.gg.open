<section id="view-nexon-mabinogi-heroes-character-main">
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
                    type="text" class="form-control" name="character_name" id="character_name"
                    value="<?php echo set_value('character_name', $data['get']['character_name'] ?? ''); ?>"
                >
            </div>

            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-outline-success">검색</button>
            </div>

            <?php echo form_close(); ?>
        </div>

        <div class="card-footer"></div>
    </div>

    <?php
    if (isset($data['response']) && $data['response'])
    {
        if (isset($data['response']['basic']) && $data['response']['basic'])
        {
            $basic = $data['response']['basic'];
            ?>
    <div class="card mb-3" id="basic">
        <div class="card-header">
            <div>
                <div class="card-title"><?php echo $basic['character_name']; ?></div>
                <div class="card-subtitle">
                    <?php
                    echo $basic['character_class_name'] . ' <small>' . ($basic['character_gender'] === 'F' ? '여' : '남') . '자</small>';
                    ?>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">생성 일시</div>
                    <div class="datagrid-content">
                        <?php
                        // null 이 리턴되는 경우가 있음..
                        if ($basic['character_date_create'])
                        {
                            echo date('Y-m-d H:i:s', strtotime($basic['character_date_create']));
                        }
                        ?>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">마지막 로그인 일시</div>
                    <div class="datagrid-content"><?php echo date('Y-m-d H:i:s', strtotime($basic['character_date_last_login'])); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">마지막 로그아웃 일시</div>
                    <div class="datagrid-content"><?php echo date('Y-m-d H:i:s', strtotime($basic['character_date_last_logout'])); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">레벨</div>
                    <div class="datagrid-content"><?php echo number_format($basic['character_level']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">경험치</div>
                    <div class="datagrid-content"><?php echo number_format($basic['character_exp']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">카르제 이름</div>
                    <div class="datagrid-content"><?php echo $basic['cairde_name']; ?></div>
                </div>

                <?php
                if (isset($data['response']['guild']['guild_name']) && $data['response']['guild']['guild_name'])
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title">가입/신청한 길드 명</div>
                    <div class="datagrid-content"><?php echo $data['response']['guild']['guild_name']; ?></div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <?php
    if (isset($data['response']['stat']['stat']) && is_array($data['response']['stat']['stat']))
    {
        ?>
    <div class="card mb-3" id="stat">
        <div class="card-header">
            <div>
                <div class="card-title">능력치</div>
                <div class="card-subtitle"></div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <?php
                foreach ($data['response']['stat']['stat'] as $row)
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo $row['stat_name']; ?></div>
                    <div class="datagrid-content"><?php echo number_format($row['stat_value']); ?></div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
        <?php
    }
    ?>

    <div class="card mb-3" id="title">
        <div class="card-header">
            <div>
                <div class="card-title">타이틀</div>
                <div class="card-subtitle"></div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <?php
                foreach ($basic['title_stat'] as $row)
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo $row['stat_name']; ?></div>
                    <div class="datagrid-content"><?php echo number_format($row['stat_value']); ?></div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="card-footer">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">획득한 내 타이틀 개수</div>
                    <div class="datagrid-content"><?php echo number_format($basic['title_count']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">내 타이틀로 획득하지 않은 ID 타이틀 개수</div>
                    <div class="datagrid-content"><?php echo number_format($basic['id_title_count']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">획득한 모든 타이틀 총 개수</div>
                    <div class="datagrid-content"><?php echo number_format($basic['total_title_count']); ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3" id="skillAwakening">
        <div class="card-header">
            <div>
                <div class="card-title">각성의 돌이 적용된 스킬 목록과 스킬 별 각성의 돌 정보</div>
                <div class="card-subtitle"></div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <?php
                foreach ($basic['skill_awakening'] as $row)
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo $row['skill_name']; ?></div>
                    <div class="datagrid-content"><?php echo $row['item_name']; ?></div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="card mb-3" id="dressPoint">
        <div class="card-header">
            <div>
                <div class="card-title">드레스 수집 포인트 정보</div>
                <div class="card-subtitle">총 <?php echo number_format($basic['dress_point']['total_point']); ?></div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">아바타 수집 포인트</div>
                    <div class="datagrid-content"><?php echo number_format($basic['dress_point']['avatar_point']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">등 수집 포인트</div>
                    <div class="datagrid-content"><?php echo number_format($basic['dress_point']['back_point']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">꼬리 수집 포인트</div>
                    <div class="datagrid-content"><?php echo number_format($basic['dress_point']['tail_point']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">오브젝트 수집 포인트</div>
                    <div class="datagrid-content"><?php echo number_format($basic['dress_point']['object_point']); ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="btn-list justify-content-end">
        <a
            class="btn btn-outline-primary"
            href="<?php echo site_to('nexon_mabinogi_heroes_character_item_equipment') . '?' . current_url(true)->getQuery(); ?>"
        >장착 아이템 조회</a>
        <a
            class="btn btn-outline-primary"
            href="<?php echo site_to('nexon_mabinogi_heroes_character_title_equipment') . '?' . current_url(true)->getQuery(); ?>"
        >타이틀/문양 정보 조회</a>
    </div>
            <?php
        }
    }
    ?>
</section>
