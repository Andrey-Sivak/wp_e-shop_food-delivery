<div class="container" style="margin-top: 35px;">
    <p class="caption">Welcome to <?= get_the_title(); ?>! Our menu:</p>

    <div class="dishes">
        <?php get_template_part('/template-parts/dishes-list'); ?>
    </div>
</div>