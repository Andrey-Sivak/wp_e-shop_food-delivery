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

get_header();
?>

	<main id="primary" class="site-main home">


    <br>
    <?php get_template_part('/template-parts/dishes-list'); ?>
    <br>
	</main><!-- #main -->

<?php
get_footer();
