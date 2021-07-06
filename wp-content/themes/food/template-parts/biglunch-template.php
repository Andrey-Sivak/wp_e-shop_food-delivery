<?php
/**
 * Template Name: Biglunch
 */

get_header(); ?>

<div class="container">
    <div class="dishes">
        <p class="caption">Welcome to Biglunch.online! Our menu:</p>
        <?php get_template_part('/template-parts/dishes-list'); ?>
    </div>
</div>

<?php get_footer();
