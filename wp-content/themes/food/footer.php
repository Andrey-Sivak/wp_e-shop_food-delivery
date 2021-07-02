<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package food
 */

?>

	<footer id="colophon" class="site-footer">
		<p>About us</p>
    <p><?= get_field('about_us', 'option') ?></p>
    <p>About delivery</p>
    <p><?= get_field('about_delivery', 'option') ?></p>
    <p></p>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
