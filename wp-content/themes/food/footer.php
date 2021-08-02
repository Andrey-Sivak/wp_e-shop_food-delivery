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

	<footer id="colophon"
          class="footer"
          style="background-color: <?= get_field('footer_background', 'option'); ?>;">
    <div class="container">
      <div class="footer__text-block">
        <p class="footer__caption">About us</p>
        <p class="footer__text"><?= get_field('about_us', 'option') ?></p>
      </div>
      <div class="footer__text-block">
        <p class="footer__caption">About delivery</p>
        <p class="footer__text"><?= get_field('about_delivery', 'option') ?></p>
      </div>
    </div>
    <p class="container footer__copyright">
      <span class="footer__copyright_bold">
        <a href="<?= get_field('footer_link_url', 'option')['url']; ?>"><?= get_field('footer_link_url', 'option')['title']; ?></a> 2021</span> contact us <a href="https://wa.me/<?= get_field('phone', 'option') ?>" class="footer__copyright_link">WhatsApp</a>
    </p>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
