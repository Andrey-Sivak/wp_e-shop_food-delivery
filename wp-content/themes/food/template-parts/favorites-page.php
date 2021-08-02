<?php
/**
 * Template Name: Favorites
 */
get_header();

$favorites = $_SESSION['favorites']; ?>

<div class="container favorites-page">
    <p class="caption"><?= the_title(); ?></p>

    <?php if (!$favorites[0]) : ?>
    <p class="favorites-page__note">There are not favorite dishes</p>
    <?php else : ?>
    <div class="dishes">
        <?php get_template_part('/template-parts/dishes-list'); ?>
    </div>
    <?php endif; ?>
</div>

<?php get_footer();
