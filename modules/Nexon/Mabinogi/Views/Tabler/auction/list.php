<section id="view-nexon-mabinogi-auction-list">
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
                <label class="form-label" for="<?php echo $cCms->searchName; ?>">검색</label>
                <input
                    type="text" class="form-control"
                    name="<?php echo $cCms->searchName; ?>" id="<?php echo $cCms->searchName; ?>"
                    value="<?php echo isset($data['get'][$cCms->searchName]) ? quotes_to_entities($data['get'][$cCms->searchName]) : ''; ?>"
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
    if (isset($data['list']) && is_array($data['list']))
    {
        ?>
    <div class="row row-cards">
        <?php
        foreach ($data['list'] as $eAuctionList)
        {
            if ($eAuctionList instanceof \Modules\Nexon\Mabinogi\Entities\AuctionList)
            {
                ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3" id="<?php echo $eAuctionList->auction_item_category . $eAuctionList->id; ?>">
                <div class="card-header">
                    <div>
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="card-title"><?php echo $eAuctionList->item->item_display_name; ?></div>
                                <div class="card-subtitle">
                                    <a
                                        href="<?php echo $eAuctionList->search('item_name'); ?>"
                                    ><?php echo $eAuctionList->item->item_name; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-actions">
                        <div class="dropdown">
                            <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- Download SVG icon from https://tabler-icons.io/i/dots-vertical -->
                                <i class="ti ti-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <?php
                                foreach ($eAuctionList->item->getUrlViews() as $rowUrlView)
                                {
                                    ?>
                                <a class="dropdown-item" href="<?php echo $rowUrlView['href']; ?>"><?php echo $rowUrlView['text']; ?></a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">아이템 개수</div>
                            <div class="datagrid-content"><?php echo number_format($eAuctionList->item_count); ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">개당 판매 가격</div>
                            <div class="datagrid-content"><?php echo number_format($eAuctionList->auction_price_per_unit); ?></div>
                        </div>

                        <?php
                        foreach ($eAuctionList->item->option as $eItemOption)
                        {
                            if ($eItemOption instanceof \Modules\Nexon\Mabinogi\Entities\ItemOption)
                            {
                                ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title">
                                <?php
                                echo trim(
                                    $eItemOption->option_type
                                    . ' '
                                    . $eItemOption->option_sub_type
                                );
                                ?>
                            </div>
                            <div class="datagrid-content">
                                <?php
                                if ($eItemOption->isColorPart())
                                {
                                    if (empty($eItemOption->option_value))
                                    {
                                        echo $eItemOption->option_desc;
                                    }
                                    else
                                    {
                                        ?>
                                <span class="avatar avatar-xs me-2 rounded" style="background-color: rgb(<?php echo $eItemOption->option_value; ?>);"></span>
                                <a href="<?php echo $eItemOption->search(); ?>"><?php echo $eItemOption->option_value; ?></a>
                                        <?php
                                    }

                                    if ($eItemOption->dyeColor)
                                    {
                                        ?>
                                <small><?php echo $eItemOption->dyeColor->name_full; ?></small>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <a
                                        href="<?php echo $eItemOption->search(); ?>"
                                    ><?php echo trim($eItemOption->option_value . ' / ' . $eItemOption->option_value2, ' /0'); ?></a>
                                    <?php
                                    if ($eItemOption->option_desc)
                                    {
                                        ?>
                                    <small><?php echo $eItemOption->option_desc; ?></small>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">판매 종료 일시</div>
                            <div class="datagrid-content"><?php echo $eAuctionList->date_auction_expire->format('Y-m-d H:i:s'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <?php
            }
        }
        ?>
    </div>
        <?php
    }
    ?>

    <?php
    if (isset($data['get']['page']))
    {
        if (isset($data['pagination']))
        {
            echo $data['pagination'];
        }
        else
        {
            ?>
    <div class="card">
        <div class="card-body">
            <ul class="pagination">
                <?php
                $page = $data['get']['page'];
                $url = clone current_url(true);
                if (isset($data['get']['next_cursor']) && $data['get']['next_cursor'])
                {
                    $url->addQuery('next_cursor', $data['get']['next_cursor']);
                }
                ?>
                <li class="page-item page-prev <?php echo $data['get']['page'] === 1 ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo $url->addQuery('page', $page - 1); ?>">
                        <div class="page-item-subtitle">previous</div>
                        <div class="page-item-title"><?php echo $page - 1; ?></div>
                    </a>
                </li>

                <li class="page-item page-next">
                    <a class="page-link" href="<?php echo $url->addQuery('page', $page + 1); ?>">
                        <div class="page-item-subtitle">next</div>
                        <div class="page-item-title"><?php echo $page + 1; ?></div>
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
