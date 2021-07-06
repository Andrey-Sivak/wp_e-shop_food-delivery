<div class="dish-item">
    <div class="dish-item__img" 
         style="background-image: url('<?= get_field('img'); ?>');"></div>
    <div class="dish-item__main">
        <p class="dish-item__caption"><?= get_the_title()
                                            . ' ('
                                            . get_field('portion')
                                            . ') Price: '; ?><span><?= get_field('price'); ?></span></p>
        <p class="dish-item__text dish-item__desc"><?= get_field('desc'); ?></p>
        <p class="dish-item__text">WhatsApp order please</p>
        <div class="dish-item__order">
            <a href="<?= get_field('phone', 'option'); ?>" class="dish-item__order_link whatsapp"></a>
            <a href="<?= get_field('post', 'option'); ?>" class="dish-item__order_link post"></a>
        </div>
    </div>
</div>