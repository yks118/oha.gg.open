<section id="view-nexon-crazy-arcade-main">
    <div class="row row-cards">
        <?php
        if (isset($data['notice']) && is_array($data['notice']))
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">공지사항</h3>
                </div>

                <div class="list-group list-group-flush list-group-hoverable">
                    <?php
                    foreach ($data['notice'] as $row)
                    {
                        ?>
                        <a class="list-group-item" href="<?php echo $row['url']; ?>">
                            <div class="text-truncate">
                                <div class="text-reset d-block"><?php echo $row['title']; ?></div>
                                <div class="d-block text-secondary text-truncate mt-n1"><?php echo date('Y-m-d H:i:s', strtotime($row['date'])); ?></div>
                            </div>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
            <?php
        }

        if (isset($data['monthly']) && is_array($data['monthly']))
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">월간크아</h3>
                </div>

                <div class="list-group list-group-flush list-group-hoverable">
                    <?php
                    foreach ($data['monthly'] as $row)
                    {
                        ?>
                    <a class="list-group-item" href="<?php echo $row['url']; ?>">
                        <div class="text-truncate">
                            <div class="text-reset d-block"><?php echo $row['title']; ?></div>
                            <div class="d-block text-secondary text-truncate mt-n1"><?php echo date('Y-m-d H:i:s', strtotime($row['date'])); ?></div>
                        </div>
                    </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
            <?php
        }

        if (isset($data['event']) && is_array($data['event']))
        {
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">이벤트</h3>
                    </div>

                    <div class="list-group list-group-flush list-group-hoverable">
                        <?php
                        foreach ($data['event'] as $row)
                        {
                            ?>
                        <a class="list-group-item" href="<?php echo $row['url']; ?>">
                            <div class="text-truncate">
                                <div class="text-reset d-block"><?php echo $row['title']; ?></div>
                                <div class="d-block text-secondary text-truncate mt-n1">
                                    <?php echo date('Y-m-d H:i:s', strtotime($row['date_event_start'])); ?>
                                    ~
                                    <?php echo is_null($row['date_event_end']) ? '' : date('Y-m-d H:i:s', strtotime($row['date_event_end'])); ?>
                                </div>
                            </div>
                        </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>
