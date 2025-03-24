<?php
if (isset($rowItem))
{
    ?>
<div class="card mb-3">
    <div class="card-header">
        <div>
            <div class="row align-items-center">
                <?php
                if (isset($rowItem['image_url']) && $rowItem['image_url'])
                {
                    ?>
                <div class="col-auto">
                    <img
                        class="avatar"
                        alt="<?php echo $rowItem['item_display_name']; ?>"
                        src="<?php echo $rowItem['image_url']; ?>"
                    >
                </div>
                    <?php
                }
                ?>

                <div class="col">
                    <div class="card-title"><?php echo $rowItem['item_display_name']; ?></div>
                    <div class="card-subtitle">
                        <?php
                        if (isset($rowItem['price']))
                        {
                            echo $rowItem['price'][0]['price_type'];
                            echo ': ';
                            echo number_format($rowItem['price'][0]['price_value']);
                        }
                        else
                        {
                            echo $rowItem['item_name'];
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">아이템 개수</div>
                <div class="datagrid-content"><?php echo number_format($rowItem['item_count']); ?></div>
            </div>

            <?php
            if (
                isset($rowItem['limit_type'], $rowItem['limit_value'])
                && $rowItem['limit_type'] && $rowItem['limit_value']
            )
            {
                ?>
            <div class="datagrid-item">
                <div class="datagrid-title"><?php echo $rowItem['limit_type']; ?></div>
                <div class="datagrid-content"><?php echo number_format($rowItem['limit_value']); ?></div>
            </div>
                <?php
            }
            ?>

            <?php
            if (isset($rowItem['auction_price_per_unit']))
            {
                ?>
            <div class="datagrid-item">
                <div class="datagrid-title">개당 판매 가격</div>
                <div class="datagrid-content">
                    <?php
                    echo number_format($rowItem['auction_price_per_unit']);
                    ?>
                </div>
            </div>
                <?php
            }
            ?>

            <?php
            if (isset($rowItem['item_option']))
            {
                foreach ($rowItem['item_option'] as $rowItemOption)
                {
                    ?>
            <div class="datagrid-item">
                <div class="datagrid-title">
                    <?php
                    echo trim(
                        $rowItemOption['option_type']
                        . ' '
                        . $rowItemOption['option_sub_type']
                    );
                    ?>
                </div>

                <div class="datagrid-content">
                    <?php
                    if (in_array($rowItemOption['option_type'], ['아이템 색상', '색상']))
                    {
                        if (empty($rowItemOption['option_value']))
                        {
                            echo $rowItemOption['option_desc'];
                        }
                        else
                        {
                            ?>
                    <span
                        class="avatar avatar-xs me-2 rounded"
                        style="background-color: rgb(<?php echo $rowItemOption['option_value']; ?>);"
                    ></span>
                            <?php
                            echo $rowItemOption['option_value'];
                        }
                    }
                    else
                    {
                        echo trim(
                            $rowItemOption['option_value'] . ' / ' . $rowItemOption['option_value2'],
                            ' /0'
                        );

                        if ($rowItemOption['option_desc'])
                        {
                            ?>
                    <small><?php echo $rowItemOption['option_desc']; ?></small>
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

    <?php
    if (isset($rowItem['date_auction_expire']))
    {
        ?>
    <div class="card-footer">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">판매 종료 일시</div>
                <div class="datagrid-content">
                    <?php
                    echo date('Y-m-d H:i:s', strtotime($rowItem['date_auction_expire']));
                    ?>
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