<?php

$restaurants = $restaurants = get_posts([
    'category' => [35, -22],
    'numberposts' => -1,
]);

$current_cats = get_the_category();

$current_category = null;

foreach ($restaurants as $restaurant) {
    foreach ($current_cats as $current_cat) {

        if ($restaurant->post_name == $current_cat->slug) {
            $current_category = $restaurant;
            break 2;
        }
    }
}
?>

<div class="container header__restaurant">
    <div class="header__restaurant_info-wrap"
         style="background-image: url('<?= get_field('img', $current_category->ID); ?>');">
      <p class="header__restaurant_title"><?= get_the_title($current_category->ID); ?></p>
      <div class="header__restaurant_info">
        <a href="tel:<?= get_field('phone', $current_category->ID); ?>" class="header__restaurant_phone">tel: <?= get_field('phone', $current_category->ID); ?></a>
        <p class="header__restaurant_text header__restaurant_location">Location: <?= get_field('location', $current_category->ID); ?></p>
      </div>
      <?php if (get_field('free_delivery', $current_category->ID)) : ?>
      <p class="header__restaurant_text free">Free delivery</p>
      <?php else : ?>
      <p class="header__restaurant_text price">Order delivery <?= get_field('delivery_price', $current_category->ID); ?>&#8364;</p>
      <?php endif; ?>
      <div class="mobile-help"></div>
    </div>
    <div class="header__map">
      <?php if (get_field('map') != '') {
          echo get_field('map');
      } else {
          echo get_field('default_map', 'option');
      } ?>
    </div>
</div>


<!--<a href="<?/*= get_permalink(127); */?>"
   class="header__banner"
   style="background-color: <?/*= get_field('banner_color', 'option'); */?>;">
  <div class="header__banner_caption"><?/*= get_field('banner_caption', 'option'); */?></div>
  <div class="header__banner_subcaption">
    <p class="header__banner_note"><?/*= get_field('small_note_text', 'option'); */?></p>
    <img src="<?/*= get_field('banner_image', 'option'); */?>"
         alt="img"
         class="header__banner_img">
  </div>
</a>-->