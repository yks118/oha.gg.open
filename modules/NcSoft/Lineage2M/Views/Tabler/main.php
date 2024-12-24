<section id="view-ncsoft-lineage2m-main">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            ?>

            <?php
            if (isset($data['servers']) && is_array($data['servers']))
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="server_id">서버 명</label>
                <select class="form-select" name="server_id" id="server_id">
                    <option value="">전체</option>

                    <?php
                    foreach ($data['servers'] as $rowWorld)
                    {
                        if (isset($rowWorld['world_id']))
                        {
                            ?>
                    <option
                        value="<?php echo $rowWorld['world_id']; ?>"
                        <?php echo set_select('server_id', $rowWorld['world_id'], isset($data['get']['server_id']) && $data['get']['server_id'] == $rowWorld['world_id']); ?>
                    ><?php echo $rowWorld['world_name']; ?></option>
                            <?php
                        }

                        foreach ($rowWorld['servers'] as $rowServer)
                        {
                            ?>
                    <option
                        value="<?php echo $rowServer['server_id']; ?>"
                        <?php echo set_select('server_id', $rowServer['server_id'], isset($data['get']['server_id']) && $data['get']['server_id'] == $rowServer['server_id']); ?>
                    ><?php echo $rowServer['server_name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
                <?php
            }
            ?>

            <div class="mb-3">
                <label class="form-label" for="search_keyword">아이템 이름</label>
                <input
                    type="text" class="form-control" name="search_keyword" id="search_keyword"
                    value="<?php echo set_value('search_keyword', $data['get']['search_keyword'] ?? ''); ?>"
                >
            </div>

            <div class="row row-cards">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="from_enchant_level">최소 강화 수치</label>
                        <input
                            type="number" class="form-control" name="from_enchant_level" id="from_enchant_level"
                            value="<?php echo set_value('from_enchant_level', $data['get']['from_enchant_level'] ?? ''); ?>"
                        >
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="to_enchant_level">최대 강화 수치</label>
                        <input
                            type="number" class="form-control" name="to_enchant_level" id="to_enchant_level"
                            value="<?php echo set_value('to_enchant_level', $data['get']['to_enchant_level'] ?? ''); ?>"
                        >
                    </div>
                </div>
            </div>

            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-outline-success">검색</button>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>

    <?php
    if (isset($data['response'], $data['response']['contents']) && is_array($data['response']))
    {
        ?>
    <div class="row row-cards">
        <?php
        foreach ($data['response']['contents'] as $key => $row)
        {
            ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3" id="<?php echo $key; ?>">
                <div class="card-header">
                    <div>
                        <div class="row align-items-center">
                            <?php
                            if (isset($row['image']))
                            {
                                ?>
                            <div class="col-auto">
                                <img class="avatar" alt="" src="<?php echo $row['image']; ?>">
                            </div>
                                <?php
                            }
                            ?>

                            <div class="col">
                                <div class="card-title">
                                    <?php
                                    $url = site_to('ncsoft_lineage2m_item', $row['item_id']);
                                    if ($data['get']['server_id'])
                                    {
                                        $url .= '?server_id=' . $data['get']['server_id'];
                                    }
                                    ?>
                                    <a href="<?php echo $url; ?>"><?php echo $row['item_name']; ?></a>
                                </div>
                                <div class="card-subtitle"><?php echo $row['server_name']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">등급</div>
                            <div class="datagrid-content"><?php echo $row['grade']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">강화 수치</div>
                            <div class="datagrid-content"><?php echo $row['enchant_level']; ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">월드 거래소 여부</div>
                            <div class="datagrid-content">
                                <?php
                                if ($row['world'])
                                {
                                    ?>
                                <span class="text-success">True</span>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                <span class="text-danger">False</span>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">현 최저가</div>
                            <div class="datagrid-content"><?php echo number_format($row['now_min_unit_price']); ?></div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">28일 평균가</div>
                            <div class="datagrid-content"><?php echo number_format($row['avg_unit_price']); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php
        }
        ?>
    </div>
        <?php
        echo $data['pagination'] ?? '';
    }
    ?>
</section>
