<div class="container">
    <div class="header__wrap">
        <div class="header__text">
            <div class="header__text_main"><?= get_field('header_caption', 127); ?></div>
            <p class="header__text_simple"><?= get_field('header_subcaption', 127); ?></p>
        </div>
        <div class="header__img">
            <img src="<?= get_template_directory_uri() . '/dist/img/biglunch-header-img.png'; ?>"
                 alt="img">
        </div>
    </div>
</div>
