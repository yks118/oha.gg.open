<section id="view-nexon-mabinogi-main">
    <div class="row row-cards">
        <?php
        if (isset($data['listAuctionHistoryStatus']) && is_array($data['listAuctionHistoryStatus']))
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">경매장 거래내역 갱신 상황</h3>
                </div>

                <div class="list-group list-group-flush list-group-hoverable">
                    <?php
                    foreach ($data['listAuctionHistoryStatus'] as $eAuctionHistoryStatus)
                    {
                        if ($eAuctionHistoryStatus instanceof \Modules\Nexon\Mabinogi\Entities\AuctionHistoryStatus)
                        {
                            ?>
                    <div class="list-group-item">
                        <div class="text-truncate">
                            <div class="text-reset d-block">
                                <?php echo $eAuctionHistoryStatus->auction_item_category; ?>

                                <?php
                                if ($eAuctionHistoryStatus->status === 'i')
                                {
                                    ?>
                                <small class="text-info">갱신 진행중</small>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="d-block text-secondary text-truncate mt-n1"><?php echo $eAuctionHistoryStatus->updated_at->format('Y-m-d H:i:s'); ?></div>
                        </div>
                    </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
            <?php
        }
        ?>

        <?php
        if (isset($data['salesCommission']) && is_array($data['salesCommission']))
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">경매장 수수료 할인 쿠폰 최저가</h3>
                </div>

                <div class="list-group list-group-flush list-group-hoverable">
                    <?php
                    foreach ($data['salesCommission'] as $row)
                    {
                        ?>
                    <div class="list-group-item">
                        <div class="text-truncate">
                            <div class="text-reset d-block"><?php echo number_format($row['min']); ?> Gold</div>
                            <div class="d-block text-secondary text-truncate mt-n1">
                                <?php echo $row['item_name']; ?>
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
        ?>
    </div>
</section>
