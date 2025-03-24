<section id="view-nexon-sudden-attack-match-main">
    <?php
    if (isset($data['response']) && $data['response'])
    {
        ?>
    <div class="card mb-3" id="match">
        <div class="card-header">
            <div>
                <h3 class="card-title"><?php echo $data['response']['match_map']; ?></h3>
                <p class="card-subtitle">
                    <?php echo date('Y-m-d H:i:s', strtotime($data['response']['date_match'])); ?>
                </p>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">게임 모드</div>
                    <div class="datagrid-content"><?php echo $data['response']['match_mode']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">매치 유형</div>
                    <div class="datagrid-content"><?php echo $data['response']['match_type']; ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cards">
        <?php
        foreach ($data['response']['match_detail'] as $row)
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">팀 정보</div>
                            <div class="datagrid-content"><?php echo $row['team_id']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">매치 결과(승: 1, 무, 패: 2)</div>
                            <div class="datagrid-content"><?php echo $row['match_result']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">닉네임</div>
                            <div class="datagrid-content"><?php echo $row['user_name']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">시즌 계급</div>
                            <div class="datagrid-content"><?php echo $row['season_grade']; ?></div>
                        </div>

                        <?php
                        if (isset($row['clan_name']))
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title">클랜 이름</div>
                            <div class="datagrid-content"><?php echo $row['clan_name']; ?></div>
                        </div>
                            <?php
                        }
                        ?>

                        <div class="datagrid-item">
                            <div class="datagrid-title">킬 기록</div>
                            <div class="datagrid-content"><?php echo number_format($row['kill']); ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">데스 기록</div>
                            <div class="datagrid-content"><?php echo number_format($row['death']); ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">헤드샷 기록</div>
                            <div class="datagrid-content"><?php echo number_format($row['headshot']); ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">데미지 기록</div>
                            <div class="datagrid-content"><?php echo number_format($row['damage']); ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">어시스트 기록</div>
                            <div class="datagrid-content"><?php echo number_format($row['assist']); ?></div>
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
        <?php
        $href = site_to('nexon_sudden_attack_match_main')
            . '?' . current_url(true)->getQuery()
        ;
        ?>
        <a class="btn btn-outline-success" href="<?php echo $href; ?>">매치 정보 조회</a>
    </div>
</section>
