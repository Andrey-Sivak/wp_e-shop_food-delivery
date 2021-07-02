<?php
/**
 * food functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package food
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'food_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function food_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on food, use a find and replace
		 * to change 'food' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'food', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'food' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'food_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'food_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function food_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'food_content_width', 640 );
}
add_action( 'after_setup_theme', 'food_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function food_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'food' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'food' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'food_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function food_scripts() {
	wp_enqueue_style( 'food-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_style_add_data( 'food-style', 'rtl', 'replace' );
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/dist/css/main.css', array(), _S_VERSION );
    wp_style_add_data( 'main-style', 'rtl', 'replace' );

    wp_enqueue_script( 'food-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'food-script', get_template_directory_uri() . '/dist/js/main.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'food_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function dishes_create_post_type() {
    $labels = array(
        'name' => __( 'dishes' ),
        'singular_name' => __( 'Dishes' ),
        'add_new' => __( 'New dish' ),
        'add_new_item' => __( 'Add new dish' ),
        'edit_item' => __( 'Edit dish' ),
        'new_item' => __( 'New dish' ),
        'view_item' => __( 'View dish' ),
        'search_items' => __( 'Search dish' ),
        'not_found'          => __('Not found'),
        'not_found_in_trash' => __( 'Not found in trash' ),
        'parent_item_colon'  => __('dashicons-book-alt'),
        'menu_name'          => __('Dishes'),
    );
    $args = array(
        'labels' => $labels,
        'has_archive' => true,
        'public' => true,

        'hierarchical' => true,
        'menu_position' => 5,
        'show_in_rest'       => true,
        'taxonomies' => array('dishes_cat'),
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'custom-fields',
            'thumbnail',
            'page-attributes',
            'custom-fields',
            'comments'

        ),
    );
    register_post_type( 'dishes', $args );
}
add_action( 'init', 'dishes_create_post_type' );

function dishes_register_taxonomy() {
    register_taxonomy( 'dishes_cat', 'dishes',
        array(
            'labels'                => [
                'name'              => 'Dishes categories',
                'singular_name'     => 'Dishes category',
                'search_items'      => 'Search dishes category',
                'all_items'         => 'All dishes categories',
                'view_item'         => 'View dishes categories',
                'parent_item'       => 'Parent Dishes',
                'parent_item_colon' => 'Parent Dishes:',
                'edit_item'         => 'Edit dishes category',
                'update_item'       => 'Update dishes category',
                'add_new_item'      => 'Add dishes category',
                'new_item_name'     => 'Dishes category name',
                'menu_name'         => 'Dishes categories',
            ],
            'hierarchical' => true,
            'sort' => true,
            'args' => array( 'orderby' => 'term_order' ),
            'show_in_rest'       => true,
            'show_admin_column' => true
        )
    );
}
add_action( 'init', 'dishes_register_taxonomy' );

function restaurant_create_post_type() {
    $labels = array(
        'name' => __( 'restaurants' ),
        'singular_name' => __( 'Restaurants' ),
        'add_new' => __( 'New restaurant' ),
        'add_new_item' => __( 'Add new restaurant' ),
        'edit_item' => __( 'Edit restaurant' ),
        'new_item' => __( 'New restaurant' ),
        'view_item' => __( 'View restaurant' ),
        'search_items' => __( 'Search restaurant' ),
        'not_found'          => __('Not found'),
        'not_found_in_trash' => __( 'Not found in trash' ),
        'parent_item_colon'  => __('dashicons-book-alt'),
        'menu_name'          => __('Restaurants'),
    );
    $args = array(
        'labels' => $labels,
        'has_archive' => true,
        'public' => true,

        'hierarchical' => true,
        'menu_position' => 5,
        'show_in_rest'       => true,
        'taxonomies' => array('restaurants_cat'),
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'custom-fields',
            'thumbnail',
            'page-attributes',
            'custom-fields',
            'comments'

        ),
    );
    register_post_type( 'restaurants', $args );
}
add_action( 'init', 'restaurant_create_post_type' );

function restaurant_register_taxonomy() {
    register_taxonomy( 'restaurants_cat', 'restaurants',
        array(
            'labels'                => [
                'name'              => 'Restaurants categories',
                'singular_name'     => 'Restaurants category',
                'search_items'      => 'Search restaurants category',
                'all_items'         => 'All restaurants categories',
                'view_item'         => 'View restaurants categories',
                'parent_item'       => 'Parent Restaurants',
                'parent_item_colon' => 'Parent Restaurants:',
                'edit_item'         => 'Edit restaurants category',
                'update_item'       => 'Update restaurants category',
                'add_new_item'      => 'Add restaurants category',
                'new_item_name'     => 'Restaurants category name',
                'menu_name'         => 'Restaurants categories',
            ],
            'hierarchical' => true,
            'sort' => true,
            'args' => array( 'orderby' => 'term_order' ),
            'show_in_rest'       => true,
            'show_admin_column' => true
        )
    );
}
add_action( 'init', 'restaurant_register_taxonomy' );