<?php ?>

<div class="container">
  <div class="header__wrap">
    <div class="header__text">
      <p class="header__text_main"><?= get_field('main_banner_text'); ?></p>
      <p class="header__text_simple"><?= get_field('text'); ?></p>
    </div>
    <div class="header__img">
      <img src="<?= get_template_directory_uri() . '/dist/img/home-page-header-img.png'; ?>" alt="img">
    </div>
  </div>
</div>

