<?php

$restaurants = $restaurants = get_posts([
    'category' => [35, -22],
    'numberposts' => -1,
]);

$current_cats = get_the_category();

$current_category = null;

foreach ($restaurants as $restaurant) {
    foreach ($current_cats as $current_cat) {
        if ($restaurant->post_title == $current_cat->name) {
            $current_category = $restaurant;
            break 2;
        }
    }
}

?>

<div class="header__restaurant">
    <div class="header__restaurant_img"
         style="background-image: url('<?= get_field('img', $current_category->ID); ?>');"></div>
    <div class="header__restaurant_info-wrap">
        <div class="">
            <p class="header__restaurant_title"><?= get_the_title($current_category->ID); ?></p>
            <a href="tel:<?= get_field('phone', $current_category->ID); ?>" class="header__restaurant_phone"><?= get_field('phone', $current_category->ID); ?></a>
        </div>
        <div class="">
            <p class="header__restaurant_text header__restaurant_location">Location: <?= get_field('location', $current_category->ID); ?></p>
            <?php if (get_field('free_delivery', $current_category->ID)) : ?>
              <p class="header__restaurant_text free">Free delivery</p>
            <?php else : ?>
              <p class="header__restaurant_text price">Order delivery <?= get_field('delivery_price', $current_category->ID); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<a href="<?= get_permalink(127); ?>"
   class="header__banner"
   style="background-color: <?= get_field('banner_color', 'option'); ?>;">
    <div class="header__banner_caption"><?= get_field('banner_caption', 'option'); ?></div>
    <div class="header__banner_subcaption">
      <p class="header__banner_note"><?= get_field('small_note_text', 'option'); ?></p>
      <img src="<?= get_field('banner_image', 'option'); ?>"
           alt="img"
           class="header__banner_img">
    </div>
</a>