<section id="view-nexon-supervive-meta-rankgrade">
    <?php
    if (isset($data['list']))
    {
        ?>
    <div class="row row-cards">
        <?php
        foreach ($data['list'] as $row)
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3" id="<?php echo $row['rankgrade_id']; ?>">
                <img class="card-img-top" alt="<?php echo $row['rankgrade_id']; ?>" src="<?php echo $row['rankgrade_img_url']; ?>">

                <div class="card-header">
                    <div>
                        <h3 class="card-title"><?php echo $row['rankgrade_name']; ?></h3>
                        <p class="card-subtitle"><?php echo $row['rankgrade_id']; ?></p>
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
</section>
