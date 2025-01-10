<section id="view-nexon-first-descendant-recommendation-module">
    <div class="card mb-3">
        <div class="card-body">
            <?php
            echo form_open(attributes: [
                'method'        => 'get',
                'autocomplete'  => 'off',
            ]);

            if (isset($data['descendants']) && is_array($data['descendants']) && count($data['descendants']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="descendant_id"><?php echo lang('NexonFirstDescendant.descendant'); ?></label>
                <select class="form-select" name="descendant_id" id="descendant_id">
                    <?php
                    foreach ($data['descendants'] as $keyDescendant => $valueDescendant)
                    {
                        ?>
                    <option
                        value="<?php echo $keyDescendant ?>"
                        <?php echo set_select('descendant_id', $keyDescendant, isset($data['get']['descendant_id']) && $data['get']['descendant_id'] === $keyDescendant); ?>
                    ><?php echo $valueDescendant; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }

            if (isset($data['weapons']) && is_array($data['weapons']) && count($data['weapons']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="weapon_id"><?php echo lang('NexonFirstDescendant.weapon'); ?></label>
                <select class="form-select" name="weapon_id" id="weapon_id">
                    <?php
                    foreach ($data['weapons'] as $keyWeapon => $valueWeapon)
                    {
                        ?>
                    <option
                        value="<?php echo $keyWeapon ?>"
                        <?php echo set_select('weapon_id', $keyWeapon, isset($data['get']['weapon_id']) && $data['get']['weapon_id'] === $keyWeapon); ?>
                    ><?php echo $valueWeapon; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }

            if (isset($data['voidBattles']) && is_array($data['voidBattles']) && count($data['voidBattles']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="void_battle_id"><?php echo lang('NexonFirstDescendant.void_battle'); ?></label>
                <select class="form-select" name="void_battle_id" id="void_battle_id">
                    <?php
                    foreach ($data['voidBattles'] as $keyVoidBattle => $valueVoidBattle)
                    {
                        ?>
                    <option
                        value="<?php echo $keyVoidBattle ?>"
                        <?php echo set_select('void_battle_id', $keyVoidBattle, isset($data['get']['void_battle_id']) && $data['get']['void_battle_id'] === $keyVoidBattle); ?>
                    ><?php echo $valueVoidBattle; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }

            if (isset($data['periods']) && is_array($data['periods']) && count($data['periods']) > 0)
            {
                ?>
            <div class="mb-3">
                <label class="form-label" for="period"><?php echo lang('NexonFirstDescendant.period'); ?></label>
                <select class="form-select" name="period" id="period">
                    <?php
                    foreach ($data['periods'] as $keyPeriod => $valuePeriod)
                    {
                        ?>
                    <option
                        value="<?php echo $keyPeriod ?>"
                        <?php echo set_select('period', $keyPeriod, isset($data['get']['period']) && $data['get']['period'] === $keyPeriod); ?>
                    ><?php echo $valuePeriod; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
                <?php
            }
            ?>

            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-outline-success"><?php echo lang('Core.button.search'); ?></button>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>

    <?php
    if (isset($data['response']) && is_array($data['response']))
    {
        $row = $data['response'];
        $descendant = nexon_first_descendant_meta_descendant_id($row['descendant']['descendant_id']);
        ?>
    <div class="card mb-3" id="descendant">
        <div class="card-header">
            <div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $descendant['descendant_name']; ?>" src="<?php echo $descendant['descendant_image_url']; ?>">
                    </div>
                    <div class="col">
                        <h3 class="card-title">
                            <?php
                            $url = site_to('nexon_first_descendant_meta_descendant_detail', $descendant['descendant_id']);
                            $url .= '?' . current_url(true)->getQuery();
                            ?>
                            <a href="<?php echo $url; ?>"><?php echo $descendant['descendant_name']; ?></a>
                        </h3>
                        <p class="card-subtitle"><?php echo $descendant['descendant_id']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($row['descendant']['recommendation'] as $rowRecommendation)
            {
                $module = nexon_first_descendant_meta_module_id($rowRecommendation['module_id']);

                $url = site_to('nexon_first_descendant_meta_module_detail', $rowRecommendation['module_id']);
                ?>
            <a class="list-group-item" href="<?php echo $url; ?>">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $module['module_name']; ?>" src="<?php echo $module['image_url']; ?>">
                    </div>
                    <div class="col text-truncate">
                        <div class="text-reset d-block"><?php echo $module['module_name']; ?></div>
                        <div class="d-block text-secondary text-truncate mt-n1" style="white-space: normal;"><?php echo $module['module_tier_id']; ?></div>
                    </div>
                </div>
            </a>
                <?php
            }
            ?>
        </div>
    </div>

        <?php
        $weapon = nexon_first_descendant_meta_weapon_id($row['weapon']['weapon_id']);
        ?>
    <div class="card mb-3" id="weapon">
        <div class="card-header">
            <div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $weapon['weapon_name']; ?>" src="<?php echo $weapon['image_url']; ?>">
                    </div>
                    <div class="col">
                        <h3 class="card-title">
                            <?php
                            $url = site_to('nexon_first_descendant_meta_weapon_detail', $weapon['weapon_id']);
                            $url .= '?' . current_url(true)->getQuery();
                            ?>
                            <a href="<?php echo $url; ?>"><?php echo $weapon['weapon_name']; ?></a>
                        </h3>
                        <p class="card-subtitle"><?php echo $weapon['weapon_tier_id'] . ' / ' . $weapon['weapon_type'] . ' / ' . $weapon['weapon_rounds_type']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($row['weapon']['recommendation'] as $rowRecommendation)
            {
                $module = nexon_first_descendant_meta_module_id($rowRecommendation['module_id']);

                $url = site_to('nexon_first_descendant_meta_module_detail', $rowRecommendation['module_id']);
                ?>
            <a class="list-group-item" href="<?php echo $url; ?>">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img class="avatar" alt="<?php echo $module['module_name']; ?>" src="<?php echo $module['image_url']; ?>">
                    </div>
                    <div class="col text-truncate">
                        <div class="text-reset d-block"><?php echo $module['module_name']; ?></div>
                        <div class="d-block text-secondary text-truncate mt-n1" style="white-space: normal;"><?php echo $module['module_tier_id']; ?></div>
                    </div>
                </div>
            </a>
                <?php
            }
            ?>
        </div>
    </div>
        <?php
    }
    ?>
</section>
