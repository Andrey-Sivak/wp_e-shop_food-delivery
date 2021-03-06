<?php
$favorites = $_SESSION['favorites'];

if (+$_GET['biglunch'] || get_the_ID() == 127) {

    $dishes_list = get_posts([
        'category' => 42,
        'numberposts' => -1,
        'order' => 'ASC',
        'orderby' => 'date'
    ]);
} elseif ($_GET['category']) {

    $dishes_list = get_posts([
        'category' => (int)$_GET['category'],
        'numberposts' => -1,
        'order' => 'ASC',
        'orderby' => 'date'
    ]);
} elseif ($_GET['rest']) {

    $dishes_list = get_posts([
        'category_name' => $_GET['rest'],
        'numberposts' => -1,
        'order' => 'ASC',
        'orderby' => 'date'
    ]);
} elseif (is_front_page()) {
    $dishes_list = get_posts([
        'category' => 23,
        'numberposts' => -1,
        'order' => 'ASC',
        'orderby' => 'date'
    ]);
} elseif (get_the_title() == 'Favorites') {
  $dishes_list = [];
  foreach ($favorites as $favorite) {
    if (!$favorite) {
      continue;
    }
    $post = get_post((int)$favorite);
    array_push($dishes_list, $post);
  }
} else {

  $rests_categories_list = get_categories([
      'parent' => 35,
      'hide_empty' => false,
  ]);

  $current_categories_list = get_the_category();

  foreach ($rests_categories_list as $rests_category) {
      foreach ($current_categories_list as $current_category) {
          if ($rests_category->name == $current_category->name) {
              $dishes_list = get_posts([
                  'category_name' => $current_category->name,
                  'numberposts' => -1,
                  'order' => 'ASC',
                  'orderby' => 'date'
              ]);
          }
      }
  }
}

?>

  <div class="dishes-list">
    <?php
    if (count($dishes_list) == 0) : ?>
    <p class="dishes-list__empty">Unfortunately there are not dishes in this category</p>
    <?php else :
      foreach ($dishes_list as $dish) :
          $item_cats = get_the_category($dish->ID);
          $bigl = false;
          foreach($item_cats as $item_cat) {
              if($item_cat->slug == 'biglunch') {
                  $bigl = true;
                  break;
              }
          }
//          if ($dish->ID == get_the_ID()) continue; ?>
      <a href="<?= (int)$_GET['biglunch'] || get_the_ID() == 127 || $bigl
          ? get_permalink($dish->ID) . '?biglunch=1' : get_permalink($dish->ID); ?>"
         class="dish">
        <div class="dish__img-wrap">
          <span data-dish="<?= $dish->ID; ?>"
                class="dish__favorite<?= in_array((string)$dish->ID, $favorites) ? ' active' : ''; ?>"></span>
          <div class="dish__img"
               style="background-image: url('<?= get_field('img', $dish->ID); ?>');"></div>
        </div>
        <div class="dish__info">
          <div class="dish__info_main">
            <p class="dish__info_title"><?= get_the_title($dish->ID); ?></p>
            <p class="dish__info_coast"><?= get_field('price', $dish->ID); ?>&#8364;</p>
          </div>
          <div class="dish__info_delivery">
              <?php if (get_field('free_delivery', $dish->ID)) : ?>
                <p class="free">Free delivery</p>
              <?php else : ?>
                <p class="price">Delivery <?= get_field('delivery_price', $dish->ID); ?>&#8364;</p>
              <?php endif; ?>
          </div>
        </div>
      </a>
      <?php endforeach;
      if (count($dishes_list) % 3 == 2) : ?>
      <div class="dish hidden"></div>
    <?php endif; endif; ?>
  </div>



