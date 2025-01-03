<section id="view-nexon-mabinogi-heroes-marketplace-gold-top-detail">
    <div class="row row-cards">
        <?php
        if (isset($data['list']) && is_array($data['list']))
        {
            foreach ($data['list'] as $eMarketplaceGoldTop)
            {
                if ($eMarketplaceGoldTop instanceof \Modules\Nexon\MabinogiHeroes\Entities\MarketplaceGoldTop)
                {
                    ?>
        <div class="col-sm-6" id="<?php echo $eMarketplaceGoldTop->type; ?>">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title"><?php echo $eMarketplaceGoldTop->getTypeText(); ?></h3>
                </div>

                <div class="list-group list-group-flush list-group-hoverable">
                    <?php
                    foreach ($eMarketplaceGoldTop->data as $key => $row)
                    {
                        ?>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar"><?php echo $key + 1; ?></span>
                            </div>
                            <div class="col text-truncate">
                                <div class="text-reset d-block"><?php echo number_format($row['gold']); ?></div>
                                <div class="d-block text-secondary text-truncate mt-n1" style="white-space: normal;"><?php echo $row['cairde_name']; ?></div>
                            </div>
                        </div>
                    </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
                    <?php
                }
            }
        }
        ?>
    </div>
</section>
