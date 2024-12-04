<section id="view-nexon-mabinogi-main">
    <div class="row row-cards">
        <?php
        if (isset($data['listAuctionListStatus']) && is_array($data['listAuctionListStatus']))
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">경매장 매물 갱신 상황</h3>
                </div>

                <div class="list-group list-group-flush list-group-hoverable">
                    <?php
                    foreach ($data['listAuctionListStatus'] as $eAuctionListStatus)
                    {
                        if ($eAuctionListStatus instanceof \Modules\Nexon\Mabinogi\Entities\AuctionListStatus)
                        {
                            ?>
                    <a
                        class="list-group-item"
                        href="<?php echo site_to('nexon_mabinogi_auction_list') . htmlentities('?keyword=auction_item_category:"' . $eAuctionListStatus->auction_item_category . '"'); ?>"
                    >
                        <div class="text-truncate">
                            <div class="text-reset d-block">
                                <?php echo $eAuctionListStatus->auction_item_category; ?>

                                <?php
                                if ($eAuctionListStatus->status === 'i')
                                {
                                    ?>
                                <small class="text-info">갱신 진행중</small>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="d-block text-secondary text-truncate mt-n1"><?php echo $eAuctionListStatus->updated_at->format('Y-m-d H:i:s'); ?></div>
                        </div>
                    </a>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
            <?php
        }

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
        if (isset($data['eNpcShopList']) && $data['eNpcShopList'] instanceof \Modules\Nexon\Mabinogi\Entities\NpcShopList)
        {
            $eNpcShopList = $data['eNpcShopList'];
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">NPC 상점 정보 갱신 정보</h3>
                </div>

                <div class="list-group list-group-flush list-group-hoverable">
                    <div class="list-group-item">
                        <div class="text-truncate">
                            <div class="text-reset d-block">마지막 갱신 일시</div>
                            <div class="d-block text-secondary text-truncate mt-n1"><?php echo $eNpcShopList->date_inquire->format('Y-m-d H:i:s'); ?></div>
                        </div>
                    </div>

                    <div class="list-group-item">
                        <div class="text-truncate">
                            <div class="text-reset d-block">다음 갱신 일시</div>
                            <div class="d-block text-secondary text-truncate mt-n1"><?php echo $eNpcShopList->date_shop_next_update->format('Y-m-d H:i:s'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php
        }
        ?>
    </div>
</section>
