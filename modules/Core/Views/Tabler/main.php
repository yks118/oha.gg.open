<section id="page-core-main">
    <?php
    if (isset($data['checkModuleUpdate']) && $data['checkModuleUpdate'])
    {
        ?>
    <div class="card mb-3">
        <div class="card-header card-header-light">
            <h3 class="card-title">모듈 DB 업데이트</h3>
        </div>
        <div class="card-body text-end">
            <?php
            echo form_open(
                site_to('core_migration'),
                [
                    'autocomplete'  => 'off',
                    'onSubmit'      => 'return confirm(\'모듈 DB 업데이트를 진행하시겠습니까?\');',
                ]
            );
            ?>
            <button type="submit" class="btn btn-outline-primary">업데이트</button>
            <?php echo form_close(); ?>
        </div>
    </div>
        <?php
    }
    ?>

    <div class="card mb-3">
        <div class="card-header">
            <div>
                <h3 class="card-title">공지사항</h3>
                <p class="card-subtitle">마지막 수정 일시: 2024. 11. 29</p>
            </div>
        </div>

        <div class="card-body">
            <p>문의사항 및 오류가 있다면 디스코드로 연락주세요.</p>
            <p>API 가 공개된 게임에 한해서 지속적으로 추가 예정입니다.</p>
            <p>추가됬으면 싶은 기능은 디스코드로 연락주세요.</p>
        </div>
    </div>
</section>
