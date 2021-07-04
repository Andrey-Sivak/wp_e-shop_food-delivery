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
<div id="page" class="site">


	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$food_description = get_bloginfo( 'description', 'display' );
			if ( $food_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $food_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

	</header>
  <nav>
    <ul class="categories">
      <li class="categories__item">
        <a data-id="3"
           href="#"
           class="categories__item_link">Hits</a>
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
