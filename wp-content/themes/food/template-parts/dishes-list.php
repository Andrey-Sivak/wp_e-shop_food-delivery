<?php

// get all dishes without hits
$dishes_categories = get_categories([
    'parent' => 22,
    'hide_empty' => false,
    'exclude' => 23
]);
$dishes_categories = (array)$dishes_categories;

$main_arr = [];

foreach ($dishes_categories as $dishes_category) {
    $tmp = [];
    array_push($tmp, $dishes_category->term_id);
    $dishes = get_posts([
        'category' => $dishes_category->term_id,
        'numberpost' => -1,
    ]);
    $dishes = (array)$dishes;

    foreach ($dishes as $dish) {
        $dish = (array)$dish;
        $dish += ['img' => get_field('img', $dish['ID'])];
        $dish += ['price' => get_field('price', $dish['ID'])];
        array_push($tmp, $dish);
    }

    array_push($main_arr, $tmp);
}

// get hits dishes

$hits_dishes = get_posts([
    'category' => 23,
    'numberpost' => -1,
]);
$hits_dishes = (array)$hits_dishes;

$tmp_dish = [];

foreach ($hits_dishes as $hits_dish) {
  $hits_dish = (array)$hits_dish;
  $hits_dish += ['img' => get_field('img', $hits_dish['ID'])];
  $hits_dish += ['price' => get_field('price', $hits_dish['ID'])];
  array_push($tmp_dish, $hits_dish);
}

$hits_dishes = $tmp_dish;

?>
<script>
  let allDishes = <?= json_encode($main_arr, JSON_UNESCAPED_UNICODE); ?>;
  let hitsDishes = <?= json_encode($hits_dishes, JSON_UNESCAPED_UNICODE); ?>;
</script>

<div class="dishes-list">

  <?php foreach ($hits_dishes as $dish) : ?>
    <div class="dish__img-wrap">
      <div class="dish__img" style="background-image: url('<?= $dish['img']; ?>');"></div>
    </div>
    <div class="dish__info">
      <div class="dish__info_main">
        <p class="dish__info_title"><?= $dish['post_title']; ?></p>
        <p class="dish__info_coast"><?= $dish['price']; ?><span></span></p>
      </div>
    </div>
  <?php endforeach; ?>

</div>



