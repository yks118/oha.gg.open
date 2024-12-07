<section id="view-nexon-mabinogi-heroes-character-title-equipment">
    <div class="card mb-3">
        <?php
        if (isset($data['response']['equipment']) && is_array($data['response']['equipment']) && count($data['response']['equipment']) > 0)
        {
            ?>
        <div class="card-body">
            <div class="datagrid">
                <?php
                foreach ($data['response']['equipment'] as $row)
                {
                    ?>
                <div class="datagrid-item">
                    <div class="datagrid-title">
                        <?php echo $row['title_equipment_type_name']; ?>
                        /
                        <?php
                        echo match($row['title_type'])
                        {
                            'title'     => '타이틀',
                            'pattern'   => '문양',
                            default => $row['title_type'],
                        }
                        ?>
                    </div>
                    <div class="datagrid-content"><?php echo $row['title_name']; ?></div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
            <?php
        }
        ?>

        <?php
        if (isset($data['response']['list']) && is_array($data['response']['list']) && count($data['response']['list']) > 0)
        {
            ?>
        <div class="list-group list-group-flush list-group-hoverable">
            <?php
            foreach ($data['response']['list'] as $row)
            {
                ?>
            <div class="list-group-item">
                <div class="text-truncate">
                    <div class="text-reset d-block"><?php echo $row['title_name']; ?></div>
                    <div class="d-block text-secondary text-truncate mt-n1">
                        <?php
                        echo match($row['title_type'])
                        {
                            'title'     => '타이틀',
                            'pattern'   => '문양',
                            default => $row['title_type'],
                        };
                        ?>
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
    </div>

    <div class="btn-list justify-content-end">
        <a
            class="btn btn-outline-primary"
            href="<?php echo site_to('nexon_mabinogi_heroes_character_main') . '?' . current_url(true)->getQuery(); ?>"
        >캐릭터 정보 조회</a>
        <a
            class="btn btn-outline-primary"
            href="<?php echo site_to('nexon_mabinogi_heroes_character_item_equipment') . '?' . current_url(true)->getQuery(); ?>"
        >장착 아이템 조회</a>
    </div>
</section>
