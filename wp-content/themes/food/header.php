<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package food
 */

session_start();

if (!isset($_SESSION['favorites'])) {
    $_SESSION['favorites'] = [];
} else {
    $favorites = $_SESSION['favorites'];
}


$dishes_categories = get_categories([
    'parent' => 22,
    'hide_empty' => false,
    'exclude' => 23,
    'orderby' => 'date',
    'order' => 'ASC',
]);

$dishes_categories = (array)$dishes_categories;

$dishes_categories_arr = [];
foreach ($dishes_categories as $dishes_category) {
    array_push($dishes_categories_arr, $dishes_category->name);
}

$biglunch_get = (int)$_GET['biglunch'];

$is_biglunch = get_the_ID() == 127 || $biglunch_get ? true : false;

$is_banner = false;

$current_categories_list = get_the_category();

foreach ($current_categories_list as $current_category) {
    if ($current_category->slug == 'restaurants'
        || $current_category->slug == 'menu' ) {
      $is_banner = true;
      break;
    }
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

  <link rel="apple-touch-icon"
        sizes="180x180"
        href="<?= get_template_directory_uri() . '/favicon/apple-touch-icon.png' ?>">
  <link rel="icon"
        type="image/png"
        sizes="32x32"
        href="<?= get_template_directory_uri() . '/favicon/favicon-32x32.png' ?>">
  <link rel="icon"
        type="image/png"
        sizes="16x16"
        href="<?= get_template_directory_uri() . '/favicon/favicon-16x16.png' ?>">
  <link rel="manifest"
        href="<?= get_template_directory_uri() . '/favicon/site.webmanifest' ?>">
  <link rel="mask-icon"
        href="<?= get_template_directory_uri() . '/favicon/safari-pinned-tab.svg' ?>"
        color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">

  <script>
    let theme_directory = "<?php echo get_template_directory_uri() ?>";
    let dishesCount = <?= get_field('count_dishes', 'option'); ?>;
  </script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site home-page">

	<header id="masthead"
          class="site-header header <?= $is_biglunch ? 'biglunch' : ''; echo $is_banner ? 'with-banner' : ''; ?>"
          <?php if (!$is_banner) : ?>
          style="background-color: <?= $is_biglunch ? get_field('color', 127) : get_field('color', 6); ?>;"
          <?php endif;
          echo '>'; ?>
    <?php if ( is_front_page() || is_home() || get_the_title() == 'Favorites' ) {
        get_template_part('/headers/defaultHeader');
    } elseif ($is_biglunch) {
        get_template_part('/headers/headerWithoutBanner');
    }  else {
        get_template_part('/headers/headerWithBanner');
    } ?>

	</header>
  <nav class="container navigation">
    <a href="<?= get_permalink(get_page_by_title('Favorites')); ?>"
       class="favorites"></a>
    <ul class="categories">
      <li class="categories__item <?= !$_GET['category'] && is_front_page() || $_GET['category'] == 23
                                    ? 'active' : ''; ?>">
        <a data-id="23"
           href="<?=  is_front_page() || is_home() ? '#' : get_home_url() . '?category=23'; ?>"
           class="categories__item_link">Free delivery</a>
      </li>
      <?php foreach ($dishes_categories_arr as $dishes_category) :

      $dishes_cat_ID = null;

      foreach ($dishes_categories as $dishes_cat) {
        if ( $dishes_cat->name == $dishes_category ) {
          $dishes_cat_ID = $dishes_cat->term_id;
        }
      }
          ?>
      <li class="categories__item <?= $_GET['category'] == $dishes_cat_ID ? 'active' : ''; ?>">
        <a data-id="<?= $dishes_cat_ID; ?>"
           href="<?=  is_front_page() || is_home() ? '#' : get_home_url() . '?category=' . $dishes_cat_ID; ?>"
           class="categories__item_link"><?= $dishes_category; ?></a>
      </li>
      <?php endforeach; ?>
    </ul>

    <script>
        (function () {
            if (document.body.offsetWidth < 765) {
                return;
            }

            const container = document.body.offsetWidth > 1140 ? 1140 : document.body.offsetWidth - 30;
            const catWrap = document.querySelector('.categories');
            const cats = [...document.querySelectorAll('.categories__item')];
            const sortedElems = [];

            // 115 is default width of See more button
            let counter = 115;
            cats.forEach(c => {
                counter += c.clientWidth + 30;

                if (counter >= container) {
                    sortedElems.push(c);
                }
            });

            if (!sortedElems.length) {
                return;
            }

            const moreCats = document.createElement('div');
            moreCats.classList.add('more-categories');

            sortedElems.forEach(s => {
                cats.pop();
                s.parentElement.removeChild(s);
                moreCats.appendChild(s);
            });

            const li = document.createElement('li');
            li.classList.add('categories__item');

            const el = document.createElement('a');
            el.classList.add('categories__item_link');
            el.innerHTML = 'See more';
            li.appendChild(el);

            li.appendChild(moreCats);

            catWrap.appendChild(li);
        })();
    </script>
  </nav>
