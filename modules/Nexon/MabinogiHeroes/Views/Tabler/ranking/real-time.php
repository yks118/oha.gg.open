<section id="view-nexon-mabinogi-heroes-ranking-real-time">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            $cCms = core_config_cms();
            ?>

            <div class="mb-3">
                <label class="form-label" for="ranking_type">랭킹 유형</label>
                <select class="form-select" name="ranking_type" id="ranking_type">
                    <option value="">전체</option>
                    <option
                        value="0"
                        <?php echo set_select('ranking_type', '0', isset($data['get']['ranking_type']) && $data['get']['ranking_type'] === '0'); ?>
                    >공격력 기준 순위</option>
                    <option
                        value="1"
                        <?php echo set_select('ranking_type', '1', isset($data['get']['ranking_type']) && $data['get']['ranking_type'] === '1'); ?>
                    >마법 공격력 기준 순위</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="<?php echo $cCms->searchName; ?>">검색</label>
                <input
                    type="text" class="form-control"
                    name="<?php echo $cCms->searchName; ?>" id="<?php echo $cCms->searchName; ?>"
                    value="<?php echo isset($data['get'][$cCms->searchName]) ? quotes_to_entities($data['get'][$cCms->searchName]) : ''; ?>"
                >
            </div>

            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-outline-success">검색</button>
            </div>

            <?php echo form_close(); ?>
        </div>

        <div class="card-footer">
            Total: <?php echo number_format($data['total'] ?? 0); ?><br>
            데이터는 매시 05분에 갱신됩니다.
        </div>
    </div>

    <?php
    if (isset($data['list']) && is_array($data['list']))
    {
        ?>
    <div class="card mb-3">
        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($data['list'] as $eRankingRealTime)
            {
                if ($eRankingRealTime instanceof \Modules\Nexon\MabinogiHeroes\Entities\RankingRealTime)
                {
                    ?>
            <div class="list-group-item">
                <div class="row align-items-center">
                    <div class="col-auto"><?php echo number_format($eRankingRealTime->ranking); ?></div>
                    <div class="col text-truncate">
                        [<?php echo $eRankingRealTime->ranking_type === 0 ? '물공' : '마공'; ?>]
                        <?php echo $eRankingRealTime->character_name; ?>
                        <div class="d-block text-secondary text-truncate mt-n1"><?php echo number_format($eRankingRealTime->score); ?></div>
                    </div>
                </div>
            </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
        <?php

        echo $data['pagination'] ?? '';
    }
    ?>
</section>
