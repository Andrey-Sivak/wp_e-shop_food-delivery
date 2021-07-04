<?php
$restaurants = get_posts([
    'category' => [35, -22],
    'numberpost' => -1,
]);
?>

<div class="restaurants container">
    <p class="caption">Restaurants</p>
    <div class="restaurants__list">
        <?php foreach ($restaurants as $restaurant) : ?>
            <a href="<?= get_permalink($restaurant->ID); ?>" class="restaurants__item">
                <div class="restaurants__item_img">
                    <div class="restaurants__item_image"
                         style="background-image: url('<?= get_field('img', $restaurant->ID); ?>');"></div>
                </div>
                <div class="restaurants__item_info">
                    <p class="restaurants__item_title"><?= get_the_title($restaurant->ID); ?></p>
                    <p class="restaurants__item_location">Location: <?= get_field('location', $restaurant->ID); ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
