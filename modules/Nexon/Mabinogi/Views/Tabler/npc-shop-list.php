<section id="view-nexon-mabinogi-npc-shop-list">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            ?>

            <div class="row">
                <?php
                if (isset($data['serverNames']) && is_array($data['serverNames']))
                {
                    ?>
                <div class="col-12 col-sm-4">
                    <div class="mb-3">
                        <label class="form-label" for="server_name">서버</label>
                        <select class="form-select" name="server_name" id="server_name">
                            <?php
                            foreach ($data['serverNames'] as $serverName)
                            {
                                ?>
                            <option
                                value="<?php echo $serverName; ?>"
                                <?php
                                echo set_select(
                                    'server_name',
                                    $serverName,
                                    isset($data['get']['server_name'])
                                    && $data['get']['server_name'] === $serverName
                                );
                                ?>
                            ><?php echo $serverName; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                    <?php
                }
                ?>

                <?php
                if (isset($data['npcNames']) && is_array($data['npcNames']))
                {
                    ?>
                <div class="col-12 col-sm-4">
                    <div class="mb-3">
                        <label class="form-label" for="npc_name">NPC</label>
                        <select class="form-select" name="npc_name" id="npc_name">
                            <?php
                            foreach ($data['npcNames'] as $npcName)
                            {
                                ?>
                            <option
                                value="<?php echo $npcName; ?>"
                                <?php
                                echo set_select(
                                    'npc_name',
                                    $npcName,
                                    isset($data['get']['npc_name'])
                                    && $data['get']['npc_name'] === $npcName
                                );
                                ?>
                            ><?php echo $npcName; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                    <?php
                }
                ?>

                <div class="col-12 col-sm-4">
                    <div class="mb-3">
                        <label class="form-label" for="channel">채널</label>
                        <input
                            type="number" class="form-control" min="1" name="channel" id="channel"
                            value="<?php echo set_value('channel', $data['get']['channel'] ?? 1); ?>"
                        >
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-outline-success">검색</button>
            </div>

            <?php echo form_close(); ?>
        </div>

        <div class="card-footer">
            <?php
            if (! isset($data['response']))
            {
                ?>
            API 갱신 시간동안은 API 오류가 발생 할 수 있습니다.
                <?php
            }
            else
            {
                ?>
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">업데이트 일시</div>
                    <div class="datagrid-content">
                        <?php
                        echo date(
                            'Y-m-d H:i:s',
                            strtotime($data['response']['date_inquire'])
                        );
                        ?>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">다음 업데이트 일시</div>
                    <div class="datagrid-content">
                        <?php
                        echo date(
                            'Y-m-d H:i:s',
                            strtotime($data['response']['date_shop_next_update'])
                        );
                        ?>
                    </div>
                </div>
            </div>
                <?php
            }
            ?>
        </div>
    </div>

    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        $tabNames = array_column($data['response']['shop'], 'tab_name');
        ?>
    <ul class="nav nav-bordered mb-4" data-bs-toggle="tabs" role="tablist">
        <?php
        foreach ($tabNames as $key => $tabName)
        {
            ?>
        <li class="nav-item">
            <a
                class="nav-link <?php echo empty($key) ? 'active' : ''; ?>"
                href="#tab<?php echo $key; ?>"
                data-bs-toggle="tab"
            ><?php echo $tabName; ?></a>
        </li>
            <?php
        }
        ?>
    </ul>

    <div class="tab-content">
        <?php
        foreach ($data['response']['shop'] as $key => $rowShop)
        {
            ?>
        <div
            class="tab-pane <?php echo empty($key) ? 'active show' : ''; ?>"
            id="tab<?php echo $key; ?>" role="tabpanel"
        >
            <div class="row row-cards">
                <?php
                foreach ($rowShop['item'] as $rowShopItem)
                {
                    ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <?php
                    echo view('\Modules\Nexon\Mabinogi\Views\Tabler\template\item', [
                        'rowItem'  => $rowShopItem,
                    ]);
                    ?>
                </div>
                    <?php
                }
                ?>
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
