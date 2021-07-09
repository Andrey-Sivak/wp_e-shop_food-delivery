<?php
/**
 * Template Name: Home page
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package food
 */



// get all dishes without hits
$dishes_categories = get_categories([
    'parent' => 22,
    'hide_empty' => false
]);
$dishes_categories = (array)$dishes_categories;

$main_arr = [];

foreach ($dishes_categories as $dishes_category) {
    $tmp = [];
    array_push($tmp, $dishes_category->term_id);
    $dishes = get_posts([
        'category' => $dishes_category->term_id,
        'numberpost' => -1,
    ]);
    $dishes = (array)$dishes;

    foreach ($dishes as $dish) {
        $dish = (array)$dish;
        $dish += ['img' => get_field('img', $dish['ID'])];
        $dish += ['price' => get_field('price', $dish['ID'])];
        $dish += ['free_delivery' => get_field('free_delivery', $dish['ID'])];
        $dish += ['delivery_price' => get_field('delivery_price', $dish['ID'])];
        $dish += ['link' => get_permalink($dish['ID'])];
        array_push($tmp, $dish);
    }

    array_push($main_arr, $tmp);
}

$current_category = 'Free delivery';

if ($_GET['category']) {
    $get_current_category = get_category(+$_GET['category'], ARRAY_A);
    $current_category = $get_current_category['name'];
}

get_header(); ?>
  <script>
      let allDishes = <?= json_encode($main_arr, JSON_UNESCAPED_UNICODE); ?>;
  </script>

	<main id="primary" class="site-main home">

    <?php get_template_part('/template-parts/restaurants-list'); ?>

    <div class="dishes container">
      <p class="dish__category caption"><?= $current_category; ?></p>
      <?php get_template_part('/template-parts/dishes-list'); ?>
    </div>
	</main>

<?php
get_footer();
