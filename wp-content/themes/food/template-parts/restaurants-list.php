<?php
$restaurants = get_posts([
    'post_type' => 'restaurants',
    'numberpost' => -1,
]);
?>

<div class="restaurants">
    <div class="restaurants__list">
        <?php foreach ($restaurants as $restaurant) : ?>
            <div class="restaurants__item">
                <div class="restaurants__item_img">
                    <img src="<?= get_field('img', $restaurant->ID); ?>" alt="img">
                </div>
                <div class="restaurants__item_info">
                    <p class="restaurants__item_title"><?= get_the_title($restaurant->ID); ?></p>
                    <p class="restaurants__item_location"><?= get_field('location', $restaurant->ID); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
