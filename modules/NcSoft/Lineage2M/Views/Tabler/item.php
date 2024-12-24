<section id="view-ncsoft-lineage2m-item">
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
                <label class="form-label" for="enchant_level">강화 수치</label>
                <input
                    type="number" class="form-control" name="enchant_level" id="enchant_level"
                    value="<?php echo set_value('enchant_level', $data['get']['enchant_level'] ?? ''); ?>"
                >
            </div>

            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-outline-success">검색</button>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>

    <?php
    if (isset($data['item'], $data['item']['item_name']) && is_array($data['item']))
    {
        $row = $data['item'];
        ?>
    <div class="card mb-3">
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
                        <div class="card-title"><?php echo $row['item_name']; ?></div>
                        <div class="card-subtitle"><?php echo $row['grade_name']; ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">카테고리</div>
                    <div class="datagrid-content"><?php echo $row['trade_category_name']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">사망 시 드랍 여부</div>
                    <div class="datagrid-content">
                        <?php
                        if ($row['attribute']['droppable'])
                        {
                            ?>
                        <span class="text-danger">True</span>
                            <?php
                        }
                        else
                        {
                            ?>
                        <span class="text-success">False</span>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">거래 가능 여부</div>
                    <div class="datagrid-content">
                        <?php
                        if ($row['attribute']['tradeable'])
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

                <div class="datagrid-item">
                    <div class="datagrid-title">창고 저장 가능 여부</div>
                    <div class="datagrid-content">
                        <?php
                        if ($row['attribute']['storable'])
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

                <div class="datagrid-item">
                    <div class="datagrid-title">
                        강화 가능 여부
                        <small>/ 안전강화 단계</small>
                    </div>
                    <div class="datagrid-content">
                        <?php
                        if ($row['attribute']['enchantable'])
                        {
                            ?>
                        <span class="text-success">
                            True
                            <small>/ <?php echo $row['attribute']['safe_enchant_level']; ?></small>
                        </span>
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

                <div class="datagrid-item">
                    <div class="datagrid-title">컬렉션 수</div>
                    <div class="datagrid-content"><?php echo $row['attribute']['collection_count']; ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">무게</div>
                    <div class="datagrid-content"><?php echo number_format_float($row['attribute']['weight'] / 10000); ?></div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">재료</div>
                    <div class="datagrid-content"><?php echo $row['attribute']['material_name']; ?></div>
                </div>
            </div>
        </div>

        <?php
        if (isset($row['options']) && count($row['options']) > 0)
        {
            ?>
        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($row['options'] as $rowOption)
            {
                ?>
            <div class="list-group-item">
                <div class="row align-items-center">
                    <div class="text-reset d-block"><?php echo $rowOption['option_name']; ?></div>
                    <div class="d-block text-secondary text-truncate mt-n1" style="white-space: normal;">
                        <?php
                        echo $rowOption['display'];

                        if ($rowOption['extra_display'])
                        {
                            ?>
                        <small class="text-success"><?php echo $rowOption['extra_display']; ?></small>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="d-block text-secondary text-truncate mt-n1" style="white-space: normal;"><?php echo $rowOption['description'] ?? ''; ?></div>
                </div>
            </div>
                <?php
            }
            ?>
        </div>
            <?php
        }
        ?>

        <?php
        if ($row['attribute']['description'])
        {
            ?>
        <div class="card-footer"><?php echo $row['attribute']['description']; ?></div>
            <?php
        }
        ?>
    </div>
        <?php
    }

    if (isset($data['price'], $data['price']['now']['unit_price']) && is_array($data['price']))
    {
        $price = $data['price'];
        ?>
    <div class="card mb-3">
        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">
                        현 최저가
                        <small>/ 등록 서버 / 월드 거래소 유무</small>
                    </div>
                    <div class="datagrid-content">
                        <?php echo number_format($price['now']['unit_price']); ?>
                        <small>
                            /
                            <?php echo $price['now']['server_name']; ?>
                            /
                            <?php
                            if ($price['now']['world'])
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
                        </small>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">
                        최저 거래가
                        <small>/ 등록 서버 / 월드 거래소 유무</small>
                    </div>
                    <div class="datagrid-content">
                        <?php echo number_format($price['min']['unit_price']); ?>
                        <small>
                            /
                            <?php echo $price['min']['server_name']; ?>
                            /
                            <?php
                            if ($price['min']['world'])
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
                        </small>
                    </div>
                </div>

                <?php
                if (isset($price['avg'], $price['avg']['unit_price']))
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title">평균 거래가</div>
                    <div class="datagrid-content"><?php echo number_format($price['avg']['unit_price']); ?></div>
                </div>
                    <?php
                }
                ?>

                <div class="datagrid-item">
                    <div class="datagrid-title">
                        최고 거래가
                        <small>/ 등록 서버 / 월드 거래소 유무</small>
                    </div>
                    <div class="datagrid-content">
                        <?php echo number_format($price['max']['unit_price']); ?>
                        <small>
                            /
                            <?php echo $price['max']['server_name']; ?>
                            /
                            <?php
                            if ($price['max']['world'])
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
                        </small>
                    </div>
                </div>

                <?php
                if (isset($price['last'], $price['last']['unit_price']))
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title">
                        마지막 거래가
                        <small>/ 월드 거래소 유무</small>
                    </div>
                    <div class="datagrid-content">
                        <?php echo number_format($price['last']['unit_price']); ?>
                        <small>
                            /
                            <?php
                            if ($price['last']['world'])
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
                        </small>
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
</section>
