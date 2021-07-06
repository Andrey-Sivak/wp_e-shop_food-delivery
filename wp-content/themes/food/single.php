<?php
$is_restaurant = $_GET['rest'];
$biglunch_get = (int)$_GET['biglunch'];
get_header();

if ($biglunch_get) {
  get_template_part('/template-parts/biglunch-dish-template');
} elseif ($is_restaurant) {
  get_template_part('/template-parts/restaurant-template');
} else {
  get_template_part('/template-parts/dish-template');
}

?>



<?php get_footer() ?>
