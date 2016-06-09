<?php
define( 'ALVEN_VERSION', 1.0 );

/*-----------------------------------------------------------------------------------*/
/* General
/*-----------------------------------------------------------------------------------*/
// Plugins updates
add_filter( 'auto_update_plugin', '__return_true' );

// Theme support
add_theme_support( 'html5' );
add_theme_support( 'post-thumbnails' );

// Admin bar
show_admin_bar(false);


/*-----------------------------------------------------------------------------------*/
/* Clean WordPress head and remove some stuff for security
/*-----------------------------------------------------------------------------------*/
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');

// remove api rest links
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');

// remove comment author class
function remove_comment_author_class( $classes ){
	foreach( $classes as $key => $class ){
		if(strstr($class, "comment-author-"))
			unset( $classes[$key] );
	}
	return $classes;
}
add_filter( 'comment_class' , 'remove_comment_author_class' );

// remove login errors
add_filter('login_errors', create_function('$a', "return null;"));


/*-----------------------------------------------------------------------------------*/
/* Admin
/*-----------------------------------------------------------------------------------*/

// Enlever le lien par défaut autour des images
function alven_imagelink_setup(){
	$image_set = get_option( 'image_default_link_type' );
    if($image_set !== 'none')
        update_option('image_default_link_type', 'none');
}
add_action('admin_init', 'alven_imagelink_setup');

// Custom posts in the dashboard
function alven_right_now_custom_post() {
    $post_types = get_post_types(array( '_builtin' => false ) , 'objects' , 'and');
    foreach($post_types as $post_type){
        $cpt_name = $post_type->name;
        if($cpt_name != 'acf'){
            $num_posts = wp_count_posts($post_type->name);
            $num = number_format_i18n($num_posts->publish);
            $text = _n($post_type->labels->name, $post_type->labels->name , intval($num_posts->publish));
            echo '<li class="'. $cpt_name .'-count"><tr><a class="'.$cpt_name.'" href="edit.php?post_type='.$cpt_name.'"><td></td>' . $num . ' <td>' . $text . '</td></a></tr></li>';
        }
    }
}
add_action('dashboard_glance_items', 'alven_right_now_custom_post');

// Customize a bit the wysiwyg editor
function alven_mce_before_init( $styles ){
    // Remove h1 and code
    $styles['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';
    // Let only the colors you want
    $styles['textcolor_map'] = '[' . "'000000', 'Black', '565656', 'Text'" . ']';
    return $styles;
}
add_filter('tiny_mce_before_init', 'alven_mce_before_init');

/*-----------------------------------------------------------------------------------*/
/* Menus
/*-----------------------------------------------------------------------------------*/

register_nav_menus(
	array(
		'primary' => 'Primary Menu'
	)
);

// Cleanup WP Menu html
function css_attributes_filter($var){
     return is_array($var) ? array_intersect($var, array('current-menu-item', 'current_page_parent')) : '';
}
add_filter('nav_menu_css_class', 'css_attributes_filter');


/*-----------------------------------------------------------------------------------*/
/* Sidebar & Widgets
/*-----------------------------------------------------------------------------------*/
function alven_register_sidebars(){
	register_sidebar(array(
		'id' => 'menu-responsive',
		'name' => 'Responsive Menu & Footer Menu',
		'description' => 'Put here the menus for the responsive main menu and the footer',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
		'empty_title'=> ''
	));
}
add_action( 'widgets_init', 'alven_register_sidebars' );

function alven_add_field_menu_widget($widget, $return, $instance){
    if('nav_menu' == $widget->id_base){
        $subTitle = isset( $instance['sub_title'] ) ? $instance['sub_title'] : '';
    ?>
        <p>
            <label for="<?php echo $widget->get_field_id('sub_title'); ?>">Subtitle:</label>
            <input type="text" class="widefat" id="<?php echo $widget->get_field_id('sub_title'); ?>" name="<?php echo $widget->get_field_name('sub_title'); ?>" value="<?php echo $subTitle; ?>">
        </p>
    <?php
    }
}
add_filter( 'in_widget_form', 'alven_add_field_menu_widget', 10, 3 );

function alven_save_field_menu_widget($instance, $new_instance){
    /*if(isset( $new_instance['nav_menu'] ) && !empty( $new_instance['sub_title'] )){
        $new_instance['sub_title'] = $new_instance['sub_title'];
    }*/
    return $new_instance;
}
add_filter( 'widget_update_callback', 'alven_save_field_menu_widget', 10, 2 );


/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function alven_scripts(){
		// header
		wp_enqueue_style( 'alven-style', get_template_directory_uri() . '/css/main.css', array(), ALVEN_VERSION );
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.min.js', array(), null);

		// footer
        wp_enqueue_script( 'isMobile', get_template_directory_uri() . '/js/isMobile.min.js', array(), null, true );
	    wp_deregister_script('jquery');
		wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-1.11.2.min.js', array(), null, true );

        wp_enqueue_script( 'tweenmax', get_template_directory_uri() . '/js/TweenMax.min.js', array(), null, true );
        wp_enqueue_script( 'splittext', get_template_directory_uri() . '/js/splitText.min.js', array(), null, true );
        wp_enqueue_script( 'draggable', get_template_directory_uri() . '/js/draggable.min.js', array(), null, true );

        wp_enqueue_script( 'scrollmagic', get_template_directory_uri() . '/js/ScrollMagic.min.js', array(), null, true );
        wp_enqueue_script( 'gsap', get_template_directory_uri() . '/js/animation.gsap.js', array(), null, true );

        wp_enqueue_script( 'alven-script', get_template_directory_uri() . '/js/script.min.js', array(), null, true );

}
add_action( 'wp_enqueue_scripts', 'alven_scripts' );
