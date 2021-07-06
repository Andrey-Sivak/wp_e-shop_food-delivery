<?php
$rests_categories_list = get_categories([
    'parent' => 35,
    'hide_empty' => false,
]);

$current_categories_list = get_the_category();

foreach ($rests_categories_list as $rests_category) {
    foreach ($current_categories_list as $current_category) {
        if ($rests_category->name == $current_category->name) {
            $current_cat = $current_category->name;
            $dishes_list = get_posts([
                'category_name' => $current_category->name,
                'numberpost' => -1,
            ]);
        }
    }
}
?>

<div class="container"
     style="margin-top: 55px;">
    <p class="caption">Welcome to <?= $current_cat; ?>! <br>Our menu:</p>
    <?php get_template_part('/template-parts/dish-item'); ?>

    <div class="dishes">
        <?php get_template_part('/template-parts/dishes-list'); ?>
    </div>
</div>
