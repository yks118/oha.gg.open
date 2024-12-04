<section id="view-core-ratio-calculator">
    <div class="card">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);
            ?>

            <div class="mb-3">
                <label class="form-label" for="ratio1">비율 1</label>
                <input
                    type="number" class="form-control" name="ratio1" id="ratio1" required
                    value="<?php echo set_value('ratio1', $data['get']['ratio1'] ?? ''); ?>"
                >
            </div>

            <div class="mb-3">
                <label class="form-label" for="ratio2">비율 2</label>
                <input
                    type="number" class="form-control" name="ratio2" id="ratio2" required
                    value="<?php echo set_value('ratio2', $data['get']['ratio2'] ?? ''); ?>"
                >
            </div>

            <div class="mb-3">
                <label class="form-label" for="price1">금액 1</label>
                <input
                    type="number" class="form-control" name="price1" id="price1"
                    value="<?php echo set_value('price1', $data['get']['price1'] ?? ''); ?>"
                >
            </div>

            <div class="mb-3">
                <label class="form-label" for="price2">금액 2</label>
                <input
                    type="number" class="form-control" name="price2" id="price2"
                    value="<?php echo set_value('price2', $data['get']['price2'] ?? ''); ?>"
                >
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-outline-success">확인</button>
            </div>

            <?php echo form_close(); ?>
        </div>

        <div class="card-footer">
            <?php
            if (isset($data['price']) && $data['price'])
            {
                echo number_format($data['get']['ratio1'])
                    . ' : '
                    . number_format($data['get']['ratio2'])
                    . ' = '
                    . ($data['get']['price1'] > 0 ? number_format($data['get']['price1']) : $data['price'])
                    . ' : '
                    . ($data['get']['price2'] > 0 ? number_format($data['get']['price2']) : $data['price'])
                ;
            }
            else
            {
                ?>
            비율 1 : 비율 2 = 금액 1 : 금액 2
                <?php
            }
            ?>
        </div>
    </div>
</section>
