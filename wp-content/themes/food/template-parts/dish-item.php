<?php


$restaurants = $restaurants = get_posts([
    'category' => [35, -22],
    'numberposts' => -1,
]);

$current_cats = get_the_category();

$bigl = false;
foreach ($current_cats as $current_cat) {
    if ($current_cat->slug == 'biglunch') {
        $bigl = true;
    }
}

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

<div class="dish-item">
    <div class="dish-item__img" 
         style="background-image: url('<?= get_field('img'); ?>');"></div>
    <div class="dish-item__main">
        <p class="dish-item__caption"><?= get_the_title()
                                            . ' ('
                                            . get_field('portion')
                                            . ') Price: '; ?><span><?= get_field('price'); ?>&#8364;</span></p>
        <p class="dish-item__text dish-item__desc"><?= get_field('desc'); ?></p>
        <p class="dish-item__text">WhatsApp order please</p>
        <div class="dish-item__order">
          <?php if (get_field('whatsapp_number', $current_category->ID)) : ?>
            <a href="https://wa.me/<?= get_field('whatsapp_number', $current_category->ID); ?>?text=Hi%20I%20want%20to%20order%20<?= str_replace(' ', '%20', get_the_title()); echo ', price: ' . get_field('price') . 'eur '; ?>.%20Link:%20<?= get_permalink(); ?>" class="dish-item__order_link whatsapp"></a>
          <?php elseif ($bigl) : ?>
            <a href="https://wa.me/<?= get_field('whatsapp_number', 127); ?>?text=Hi%20I%20want%20to%20order%20<?= str_replace(' ', '%20', get_the_title()); ?>.%20Link:%20<?= get_permalink(); echo ', price: ' . get_field('price') . 'eur '; ?>" class="dish-item__order_link whatsapp"></a>
          <?php endif;
          if (get_field('email', $current_category->ID)) : ?>
            <a href="mailto:<?= get_field('email', $current_category->ID); ?>?subject=Order <?= get_the_title(); echo ', price: ' . get_field('price') . 'eur '; ?> by <?= get_permalink(); ?>" class="dish-item__order_link post"></a>
          <?php elseif ($bigl) : ?>
            <a href="mailto:<?= get_field('email', 127); ?>?subject=Order <?= get_the_title(); echo ', price: ' . get_field('price') . 'eur '; ?> by <?= get_permalink();?>" class="dish-item__order_link post"></a>
          <?php endif; ?>
        </div>
    </div>
</div>