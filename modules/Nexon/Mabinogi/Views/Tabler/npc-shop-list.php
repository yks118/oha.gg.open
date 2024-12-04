<section id="view-nexon-mabinogi-npc-shop-list">
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

        <div class="card-footer">
            Total: <?php echo number_format($data['total'] ?? 0); ?><br>
            다음 업데이트 일시에서 5분(API 갱신 대기시간)뒤에 순차적으로 갱신이 시작됩니다.
        </div>
    </div>

    <?php
    if (isset($data['total'], $data['list']) && is_array($data['list']) && $data['total'] > 0)
    {
        ?>
    <div class="row row-cards">
        <?php
        foreach ($data['list'] as $eNpcShopListShopItem)
        {
            if ($eNpcShopListShopItem instanceof \Modules\Nexon\Mabinogi\Entities\NpcShopListShopItem)
            {
                ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-header">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img class="avatar" alt="" src="<?php echo $eNpcShopListShopItem->image_url; ?>">
                            </div>
                            <div class="col">
                                <a
                                    class="card-title"
                                    href="<?php echo $eNpcShopListShopItem->search('item_display_name'); ?>"
                                ><?php echo $eNpcShopListShopItem->item_display_name; ?></a>
                                <div class="card-subtitle">
                                    <a href="<?php echo $eNpcShopListShopItem->search('price_type'); ?>"><?php echo $eNpcShopListShopItem->price_type; ?></a>:
                                    <?php echo number_format($eNpcShopListShopItem->price_value); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">서버 이름</div>
                            <a
                                class="datagrid-content"
                                href="<?php echo $eNpcShopListShopItem->npcShopList->search('server_name'); ?>"
                            ><?php echo $eNpcShopListShopItem->npcShopList->server_name; ?></a>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">채널 번호</div>
                            <a
                                class="datagrid-content"
                                href="<?php echo $eNpcShopListShopItem->npcShopList->search('channel'); ?>"
                            ><?php echo $eNpcShopListShopItem->npcShopList->channel; ?></a>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">NPC 이름</div>
                            <a
                                class="datagrid-content"
                                href="<?php echo $eNpcShopListShopItem->npcShopList->search('npc_name'); ?>"
                            ><?php echo $eNpcShopListShopItem->npcShopList->npc_name; ?></a>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">탭 이름</div>
                            <div class="datagrid-content"><?php echo $eNpcShopListShopItem->tab_name; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">묶음 수량</div>
                            <div class="datagrid-content"><?php echo $eNpcShopListShopItem->item_count; ?></div>
                        </div>

                        <?php
                        if ($eNpcShopListShopItem->limit_type && $eNpcShopListShopItem->limit_value)
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title"><?php echo $eNpcShopListShopItem->limit_type; ?></div>
                            <div class="datagrid-content"><?php echo number_format($eNpcShopListShopItem->limit_value); ?></div>
                        </div>
                            <?php
                        }
                        ?>

                        <?php
                        foreach ($eNpcShopListShopItem->option as $eNpcShopListShopItemOption)
                        {
                            ?>
                        <div class="datagrid-item">
                            <div class="datagrid-title">
                                <?php
                                echo trim(
                                    $eNpcShopListShopItemOption->option_type
                                    . ' '
                                    . $eNpcShopListShopItemOption->option_sub_type
                                );
                                ?>
                            </div>
                            <div class="datagrid-content">
                                <?php
                                if ($eNpcShopListShopItemOption->isColorPart())
                                {
                                    echo '<a href="' . $eNpcShopListShopItemOption->search() . '" style="color: rgb(' . $eNpcShopListShopItemOption->option_value . ');">' . $eNpcShopListShopItemOption->option_value . '</a>';

                                    if ($eNpcShopListShopItemOption->dyeColor)
                                    {
                                        echo '&nbsp;<small style="color: rgb(' . $eNpcShopListShopItemOption->option_value . ');">' . $eNpcShopListShopItemOption->dyeColor->name . '</small>';
                                    }
                                }
                                else
                                {
                                    ?>
                                <a
                                    href="<?php echo $eNpcShopListShopItemOption->search(); ?>"
                                ><?php echo trim($eNpcShopListShopItemOption->option_value . ' / ' . $eNpcShopListShopItemOption->option_value2, ' /0'); ?></a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">업데이트 일시</div>
                            <div class="datagrid-content"><?php echo $eNpcShopListShopItem->npcShopList->date_inquire->format('Y-m-d H:i:s'); ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">다음 업데이트 일시</div>
                            <div class="datagrid-content">
                                <?php
                                if ($eNpcShopListShopItem->npcShopList->date_shop_next_update->getTimestamp() < time())
                                {
                                    ?>
                                <span class="text-danger"><?php echo $eNpcShopListShopItem->npcShopList->date_shop_next_update->format('Y-m-d H:i:s'); ?></span>
                                    <?php
                                }
                                else
                                {
                                    echo $eNpcShopListShopItem->npcShopList->date_shop_next_update->format('Y-m-d H:i:s');
                                }
                                ?>
                            </div>
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

    <?php echo $data['pagination'] ?? ''; ?>
</section>
