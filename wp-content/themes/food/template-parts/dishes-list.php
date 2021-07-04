<?php

/*$all_dishes = get_posts([
    'category' => 22,
    'numberpost' => -1,
]);
$all_dishes = (array)$all_dishes;*/

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
      array_push($tmp, $dish);
    }

    array_push($main_arr, $tmp);
}

?>

<div class="dishes-list">

  <?php foreach ($main_arr as $dish) :
      if ($dish[0] == 23) :
      ?>
  <p><?= 1 ?></p>
  <?php endif; endforeach; ?>

</div>



