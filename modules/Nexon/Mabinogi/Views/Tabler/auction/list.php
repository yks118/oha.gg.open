<section id="view-nexon-mabinogi-auction-list">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            $cApi = nexon_mabinogi_config_api();
            ?>

            <div class="mb-3">
                <label class="form-label" for="auction_item_category">아이템 카테고리</label>
                <select class="form-select" name="auction_item_category" id="auction_item_category">
                    <option value="">단어 검색</option>
                    <?php
                    foreach ($cApi->auctionItemCategories as $auctionItemCategory)
                    {
                        ?>
                    <option
                            value="<?php echo $auctionItemCategory; ?>"
                        <?php
                        echo set_select(
                            'auction_item_category',
                            $auctionItemCategory,
                            isset($data['get']['auction_item_category'])
                            && $data['get']['auction_item_category'] === $auctionItemCategory
                        );
                        ?>
                    ><?php echo $auctionItemCategory; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="keyword">검색</label>
                <input
                    type="text" class="form-control" name="keyword" id="keyword"
                    value="<?php echo set_value('keyword', $data['get']['keyword'] ?? ''); ?>"
                >
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-outline-success">검색</button>
            </div>

            <?php echo form_close(); ?>
        </div>

        <?php
        if (isset($data['total']))
        {
            ?>
        <div class="card-footer">Total: <?php echo number_format($data['total']); ?></div>
            <?php
        }
        ?>
    </div>

    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        ?>
    <div class="row row-cards">
        <?php
        foreach ($data['response']['auction_item'] as $rowItem)
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <?php
            echo view('\Modules\Nexon\Mabinogi\Views\Tabler\template\item', [
                'rowItem'  => $rowItem,
            ]);
            ?>
        </div>
            <?php
        }
        ?>
    </div>
        <?php
    }
    ?>
</section>
