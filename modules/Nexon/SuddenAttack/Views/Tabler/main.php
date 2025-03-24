<section id="view-nexon-sudden-attack-main">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            ?>

            <div class="mb-3">
                <label class="form-label" for="user_name">닉네임</label>
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

        <div class="card-footer">유저 정보는 접속 종료시 갱신됩니다.</div>
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
                <h3 class="card-title"><?php echo $basic['user_name']; ?></h3>
                <p class="card-subtitle">
                    <?php echo date('Y-m-d H:i:s', strtotime($basic['user_date_create'])); ?>
                </p>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">장착 칭호 명</div>
                    <div class="datagrid-content"><?php echo $basic['title_name']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">소속 클랜 명</div>
                    <div class="datagrid-content"><?php echo $basic['clan_name']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">매너 등급</div>
                    <div class="datagrid-content"><?php echo $basic['manner_grade']; ?></div>
                </div>
            </div>
        </div>
    </div>
            <?php
        }

        if (isset($data['response']['rank']) && is_array($data['response']['rank']))
        {
            $rank = $data['response']['rank'];
            ?>
    <div class="card mb-3" id="rank">
        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">통합 계급</div>
                    <div class="datagrid-content"><?php echo $rank['grade']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">통합 계급 경험치</div>
                    <div class="datagrid-content"><?php echo number_format($rank['grade_exp']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">통합 계급 랭킹</div>
                    <div class="datagrid-content"><?php echo number_format($rank['grade_ranking']); ?></div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">시즌 계급</div>
                    <div class="datagrid-content"><?php echo $rank['season_grade']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">시즌 계급 경험치</div>
                    <div class="datagrid-content"><?php echo number_format($rank['season_grade_exp']); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">시즌 계급 랭킹</div>
                    <div class="datagrid-content"><?php echo number_format($rank['season_grade_ranking']); ?></div>
                </div>
            </div>
        </div>
    </div>
            <?php
        }

        if (isset($data['response']['tier']) && is_array($data['response']['tier']))
        {
            $tier = $data['response']['tier'];
            ?>
    <div class="card mb-3" id="rank">
        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">솔로 랭크전 티어</div>
                    <div class="datagrid-content"><?php echo $tier['solo_rank_match_tier']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">솔로 랭크전 점수</div>
                    <div class="datagrid-content">
                        <?php echo number_format($tier['solo_rank_match_score']); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">파티 랭크전 티어</div>
                    <div class="datagrid-content"><?php echo $tier['party_rank_match_tier']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">파티 랭크전 점수</div>
                    <div class="datagrid-content">
                        <?php echo number_format($tier['party_rank_match_score']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <?php
        }

        if (isset($data['response']['recentInfo']) && is_array($data['response']['recentInfo']))
        {
            $recentInfo = $data['response']['recentInfo'];
            ?>
    <div class="card mb-3" id="rank">
        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">
                        최근 승률
                        <small>(%)</small>
                    </div>
                    <div class="datagrid-content"><?php echo $recentInfo['recent_win_rate']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">
                        최근 킬데스
                        <small>(%)</small>
                    </div>
                    <div class="datagrid-content"><?php echo $recentInfo['recent_kill_death_rate']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">
                        최근 돌격소총 킬데스
                        <small>(%)</small>
                    </div>
                    <div class="datagrid-content"><?php echo $recentInfo['recent_assault_rate']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">
                        최근 저격소총 킬데스
                        <small>(%)</small>
                    </div>
                    <div class="datagrid-content"><?php echo $recentInfo['recent_sniper_rate']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">
                        최근 특수총 킬데스
                        <small>(%)</small>
                    </div>
                    <div class="datagrid-content"><?php echo $recentInfo['recent_special_rate']; ?></div>
                </div>
            </div>
        </div>
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
        <?php
    }
    ?>
</section>
