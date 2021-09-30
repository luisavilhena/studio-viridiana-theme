<?php

	function studio_viridiana(){
		wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/style.css', array(), '1.0.0', 'all');
		wp_enqueue_script('customjs',  get_template_directory_uri() . '/js/index.js', array(), NULL, false );
    wp_enqueue_script('slickjs',  get_template_directory_uri() . '/slick/slick.min.js', array(), '1.8.0', true);
    wp_enqueue_style('slickcss', get_template_directory_uri() . '/slick/slick.css', array(), '1.8.0', 'all');
    wp_enqueue_style('slicktheme', get_template_directory_uri() . '/slick/slick-theme.css', array(), '1.8.0', 'all');
	}


add_action('wp_enqueue_scripts', 'studio_viridiana');



use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
    Container::make( 'theme_options', __( 'Theme Options', 'crb' ) )
        ->add_fields( array(
            Field::make( 'text', 'email', 'E-mail' ),
            Field::make( 'text', 'facebook', 'Facebook' ),
            Field::make( 'text', 'instagram', 'Instagram' ),
            Field::make( 'text', 'vimeo', 'Vimeo' ),
            Field::make( 'text', 'spotifty', 'Spotify' ),
            Field::make( 'text', 'youtube', 'Youtube' ),
        ) );
}

add_action( 'carbon_fields_register_fields', 'crb_attach_about' );
function crb_attach_about() {
    Container::make( 'theme_options', __( 'About', 'crb' ) )
        ->add_fields( array(
            Field::make( 'image', 'photo', 'First image' ),
            Field::make( 'text', 'fixed_title', 'Fixed title' ),
            Field::make( 'text', 'fixed_subtile_1', 'Block one - Fixed subtitle' ),
            Field::make( 'rich_text', 'fixed_description_1', 'Block one - Fixed description' ),
            Field::make( 'text', 'fixed_subtile_2', 'Block two - Fixed subtitle' ),
            Field::make( 'rich_text', 'fixed_description_2', 'Block two - Fixed description' ),
            Field::make( 'text', 'fixed_subtile_3', 'Block three - Fixed subtitle' ),
            Field::make( 'rich_text', 'fixed_description_3', 'Block three - Fixed description' ),
            Field::make( 'text', 'fixed_footer_title_1', 'Block one - Fixed footer title' ),
            Field::make( 'rich_text', 'fixed_footer_description_1', 'Block one - Fixed footer description' ),
            Field::make( 'text', 'fixed_footer_link_1', 'Block one - Fixed footer link' ),
            Field::make( 'text', 'fixed_footer_title_2', 'Block two - Fixed footer title' ),
            Field::make( 'rich_text', 'fixed_footer_description_2', 'Block two - Fixed footer description' ),
            Field::make( 'text', 'fixed_footer_link_2', 'Block two - Fixed footer link' ),
        ) )
        ->add_fields( array(
            Field::make( 'image', 'photo_2', 'Second image' ),
            Field::make( 'rich_text', 'scroll_description_1', 'Block one - Scroll description' ),
            Field::make( 'rich_text', 'scroll_description_2', 'Block two - Scroll description' ),
        ) );
}



add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
	//define o caminho para o carbon-fields
	define(
		'Carbon_Fields\URL',
		get_template_directory_uri() . '/vendor/htmlburger/carbon-fields'
	);
  require_once('vendor/autoload.php');
  \Carbon_Fields\Carbon_Fields::boot();
}
add_action('after_setup_theme', 'register_carbon_fields');
function register_carbon_fields() {
	require_once('blocks/load.php');
}

///////////
///MENU////
///////////


/**
 * Main menu navigation
 */
register_nav_menus(array(
  'main-menu' => 'Menu principal',
));

add_action( 'wp_head', 'add_viewport_meta_tag' , '1' );

function add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
}

///////////
////post///
///////////
function my_theme_setup(){
    add_theme_support('post-thumbnails');
    add_image_size('cc__thumbnail_a4_horizontal_crop', 999, 700, array('center', 'center'));
}

add_action('after_setup_theme', 'my_theme_setup');

//////////
//excerpt//
///////////
add_post_type_support( 'page', 'excerpt' );


////////
//vcard///
///////////
function _thz_enable_vcard_upload( $mime_types ){
    $mime_types['vcf'] = 'text/vcard';
    $mime_types['vcard'] = 'text/vcard';
    return $mime_types;
}
add_filter('upload_mimes', '_thz_enable_vcard_upload' );

function mytheme_add_custom_image_sizes() {
     // Add "vertical" image
    add_image_size( 'vertical-a', 95, 117, true );
    add_image_size( 'vertical-b', 524, 462, true);
    // Add "horizontal" image
    add_image_size( 'horizontal-a', 2000, 1500, true );
    add_image_size( 'horizontal-b', 220, 152, true );
    // Add "home" image
    add_image_size( 'home', 260, 160, true );
}
add_action('after_setup_theme', 'mytheme_add_custom_image_sizes' );