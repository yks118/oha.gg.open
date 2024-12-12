<section id="view-nexon-maple-story-m-main">
    <div class="row row-cards">
        <?php
        if (isset($data['response']['notice']) && is_array($data['response']['notice']))
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
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

        if (isset($data['response']['patch']) && is_array($data['response']['patch']))
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">패치노트</h3>
                </div>

                <div class="list-group list-group-flush list-group-hoverable">
                    <?php
                    foreach ($data['response']['patch'] as $row)
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

        if (isset($data['response']['event']) && is_array($data['response']['event']))
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">이벤트</h3>
                </div>

                <div class="list-group list-group-flush list-group-hoverable">
                    <?php
                    foreach ($data['response']['event'] as $row)
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
