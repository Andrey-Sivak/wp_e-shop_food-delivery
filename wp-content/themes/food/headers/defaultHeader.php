<div class="container">
  <div class="header__wrap">
    <div class="header__text">
      <div class="header__text_main"><?= get_field('main_banner_text', 6); ?></div>
      <p class="header__text_simple"><?= get_field('text', 6); ?></p>
    </div>
    <div class="header__img">
      <img src="<?= get_template_directory_uri() . '/dist/img/home-page-header-img.png'; ?>"
           alt="img">
    </div>
  </div>
</div>

