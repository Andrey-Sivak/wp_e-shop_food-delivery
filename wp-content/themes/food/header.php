<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package food
 */

$dishes_categories = get_categories([
   'parent' => 22,
   'hide_empty' => false,
    'exclude' => 23
]);

$dishes_categories = (array)$dishes_categories;

$dishes_categories_arr = [];
foreach ($dishes_categories as $dishes_category) {
    array_push($dishes_categories_arr, $dishes_category->name);
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site home-page">


	<header id="masthead" class="site-header" style="background-color: <?= get_field('color') ?>;">
    <?php
    if ( is_front_page() || is_home() ) {
      get_template_part('/headers/defaultHeader');
    }
    ?>

	</header>
  <nav>
    <ul class="categories">
      <li class="categories__item">
        <a data-id="23"
           href="#"
           class="categories__item_link active">Hits</a>
      </li>
      <?php foreach ($dishes_categories_arr as $dishes_category) :

      $dishes_cat_ID = null;

      foreach ($dishes_categories as $dishes_cat) {
        if ( $dishes_cat->name == $dishes_category ) {
          $dishes_cat_ID = $dishes_cat->term_id;
        }
      }
          ?>
      <li class="categories__item">
        <a data-id="<?= $dishes_cat_ID; ?>"
           href="#"
           class="categories__item_link"><?= $dishes_category; ?></a>
      </li>
      <?php endforeach; ?>
    </ul>
  </nav>
