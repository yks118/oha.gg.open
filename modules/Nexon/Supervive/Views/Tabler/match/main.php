<section id="view-nexon-supervive-match-main">
    <?php
    if (isset($data['response']))
    {
        foreach ($data['response']['match'] as $rowMatch)
        {
            ?>
    <div class="card mb-3" id="<?php echo $rowMatch['match_id']; ?>">
        <div class="card-header">
            <div>
                <h3 class="card-title"><?php echo $rowMatch['map_id']; ?></h3>
                <p class="card-subtitle"><?php echo lang('NexonSupervive.queue_id.' . $rowMatch['queue_id']); ?></p>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">
                        <?php echo lang('NexonSupervive.hunter_name'); ?>
                        <small>(Level)</small>
                    </div>
                    <div class="datagrid-content">
                        <?php echo $rowMatch['hunter_name']; ?>
                        <small>(<?php echo $rowMatch['hunter_level']; ?>)</small>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonSupervive.stormshift'); ?></div>
                    <div class="datagrid-content"><?php echo $rowMatch['stormshift']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonSupervive.rank_mode_flag'); ?></div>
                    <div class="datagrid-content"><?php echo empty($rowMatch['rank_mode_flag']) ? 'False' : 'True'; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonSupervive.team.placement'); ?></div>
                    <div class="datagrid-content"><?php echo $rowMatch['team']['placement']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonSupervive.team.survival_duration'); ?></div>
                    <div class="datagrid-content"><?php echo $rowMatch['team']['survival_duration']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonSupervive.date_match_start'); ?></div>
                    <div class="datagrid-content">
                        <?php echo date('Y-m-d H:i:s', strtotime($rowMatch['date_match_start'])); ?>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonSupervive.date_match_end'); ?></div>
                    <div class="datagrid-content">
                        <?php echo date('Y-m-d H:i:s', strtotime($rowMatch['date_match_end'])); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <?php
                foreach ($rowMatch['personal_stat'] as $keyPersonalStat => $valuePersonalStat)
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title"><?php echo lang('NexonSupervive.personal_stat.' . $keyPersonalStat); ?></div>
                    <div class="datagrid-content"><?php echo number_format($valuePersonalStat); ?></div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
            <?php
        }

        if (isset($data['response']['next_cursor']))
        {
            ?>
    <div class="card">
        <div class="card-body">
            <ul class="pagination">
                <?php
                $url = current_url(true);
                ?>
                <li class="page-item page-prev">
                    <a class="page-link" href="?<?php echo $url->getQuery(['except' => 'cursor']); ?>">
                        <div class="page-item-subtitle">first</div>
                        <div class="page-item-title"></div>
                    </a>
                </li>

                <li class="page-item page-next">
                    <a class="page-link" href="?<?php echo $url->addQuery('cursor', $data['response']['next_cursor']); ?>">
                        <div class="page-item-subtitle">next</div>
                        <div class="page-item-title"></div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
            <?php
        }
    }
    ?>
</section>
