<section id="view-nexon-kart-rider-rush-plus-main">
    <div class="row row-cards">
        <?php
        if (isset($data['response']['notice']) && is_array($data['response']['notice']))
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3" id="notice">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">공지사항</h3>
                </div>

                <div class="list-group list-group-flush list-group-hoverable">
                    <?php
                    foreach ($data['response']['notice'] as $row)
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

        if (isset($data['response']['noticeSeason']) && is_array($data['response']['noticeSeason']))
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3" id="noticeSeason">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">시즌 알림판</h3>
                </div>

                <div class="list-group list-group-flush list-group-hoverable">
                    <?php
                    foreach ($data['response']['noticeSeason'] as $row)
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

        if (isset($data['response']['noticeEvent']) && is_array($data['response']['noticeEvent']))
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3" id="noticeEvent">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">이벤트 & 대회 공지</h3>
                </div>

                <div class="list-group list-group-flush list-group-hoverable">
                    <?php
                    foreach ($data['response']['noticeEvent'] as $row)
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
        ?>
    </div>
</section>
