<?php
define( 'ALVEN_VERSION', 1.0 );

/*-----------------------------------------------------------------------------------*/
/* General
/*-----------------------------------------------------------------------------------*/
// Plugins updates
add_filter( 'auto_update_plugin', '__return_true' );

// Theme support
add_theme_support( 'html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'widgets') );
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
// Remove some useless admin stuff
function alven_remove_menus(){
    remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'alven_remove_menus' );

function alven_remove_submenus() {
  $page = remove_submenu_page( 'themes.php', 'themes.php' );
}
add_action( 'admin_menu', 'alven_remove_submenus', 999 );

function alven_remove_top_menus( $wp_admin_bar ){
    $wp_admin_bar->remove_node( 'wp-logo' );
    $wp_admin_bar->remove_node( 'comments' );
}
add_action( 'admin_bar_menu', 'alven_remove_top_menus', 999 );

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

// New button wysiwyg
function alven_button( $buttons ){
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'alven_button' );

function alven_init_editor_styles(){
    add_editor_style();
}
add_action( 'after_setup_theme', 'alven_init_editor_styles' );

// Customize a bit the wysiwyg editor
function alven_mce_before_init( $styles ){
    // Add btn
    $style_formats = array (
        array(
            'title' => 'Button',
            'selector' => 'a',
            'classes' => 'btn'
        )
    );
    $styles['style_formats'] = json_encode( $style_formats );
    // Remove h1 and code
    $styles['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';
    // Let only the colors you want
    $styles['textcolor_map'] = '[' . "'000000', 'Black', '565656', 'Text'" . ']';
    return $styles;
}
add_filter('tiny_mce_before_init', 'alven_mce_before_init');

// Page d'options
function alven_menu_order( $menu_ord ){
    if(!$menu_ord) return true;
    $menu_ord = array_diff($menu_ord, array( 'acf-options' ));
    array_splice( $menu_ord, 1, 0, array( 'acf-options' ) );
    return $menu_ord;
}
add_filter('custom_menu_order', 'alven_menu_order');
add_filter('menu_order', 'alven_menu_order');
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

// Deregister default widgets
function alven_unregister_default_widgets(){
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Text');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
    unregister_widget('Twenty_Eleven_Ephemera_Widget');
}
add_action('widgets_init', 'alven_unregister_default_widgets', 11);


// Custom Menu Widget
class Menu_Widget extends WP_Widget{
    function __construct(){
        parent::__construct( 'Menu_Widget', 'Alven Menu Widget', array( 'description' => 'Menu widget with title and subtitle' ) );
    }
    public function widget( $args, $instance ) {
        $nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;
        if ( !$nav_menu ) return;

       $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
       $instance['sub_title'] = apply_filters( 'widget_title', empty( $instance['sub_title'] ) ? '' : $instance['sub_title'], $instance, $this->id_base );

       echo "<div class='". $instance['css_class'] ." menu-small'>";

        if ( !empty($instance['title']) ){
            echo "<span class='menu-title'>" . $instance['title'] . "</span>";
        }
        if ( !empty($instance['sub_title']) ){
            echo "<span class='menu-subtitle'>" . $instance['sub_title'] . "</span>";
        }

        $nav_menu_args = array(
            'fallback_cb' => '',
            'menu'        => $nav_menu
        );

        //wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ), array('menu_class' => 'yolo') );
        wp_nav_menu( array('menu' => $instance['nav_menu'], 'container' => false, 'menu_class' => '') );

        echo "</div>";
    }
    public function form( $instance ){
        $title = isset( $instance['title'] ) ? $instance['title'] : '';
        $sub_title = isset( $instance['sub_title'] ) ? $instance['sub_title'] : '';
        $nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
        $css_class = isset( $instance['css_class'] ) ? $instance['css_class'] : '';

        $menus = wp_get_nav_menus();

        ?>
        <p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
            <?php
            if ( isset( $GLOBALS['wp_customize'] ) && $GLOBALS['wp_customize'] instanceof WP_Customize_Manager ) {
                $url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
            } else {
                $url = admin_url( 'nav-menus.php' );
            }
            ?>
            <?php echo sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.' ), esc_attr( $url ) ); ?>
        </p>
        <div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ) ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'sub_title' ); ?>"><?php _e( 'Subtitle:' ) ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'sub_title' ); ?>" name="<?php echo $this->get_field_name( 'sub_title' ); ?>" value="<?php echo esc_attr( $sub_title ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu:' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
                    <option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
                    <?php foreach ( $menus as $menu ) : ?>
                        <option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
                            <?php echo esc_html( $menu->name ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'css_class' ); ?>"><?php _e( 'CSS class:' ) ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'css_class' ); ?>" name="<?php echo $this->get_field_name( 'css_class' ); ?>" value="<?php echo esc_attr( $css_class ); ?>"/>
            </p>
        </div>
        <?php
    }
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        if ( ! empty( $new_instance['title'] ) ) {
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
        }
        if ( ! empty( $new_instance['sub_title'] ) ) {
            $instance['sub_title'] = sanitize_text_field( $new_instance['sub_title'] );
        }
        if ( ! empty( $new_instance['nav_menu'] ) ) {
            $instance['nav_menu'] = (int) $new_instance['nav_menu'];
        }
        if ( ! empty( $new_instance['css_class'] ) ) {
            $instance['css_class'] = sanitize_text_field( $new_instance['css_class'] );
        }
        return $instance;
    }
}

// Register new custom widgets
function alven_load_widget(){
    register_widget( 'Menu_Widget' );
}
add_action( 'widgets_init', 'alven_load_widget' );


/*-----------------------------------------------------------------------------------*/
/* Posts
/*-----------------------------------------------------------------------------------*/
function alven_add_class_to_category($thelist){
    $class = 'btn-cat';
    return str_replace('<a href="', '<a class="'. $class. '" href="', $thelist);
}
add_filter( 'the_category', 'alven_add_class_to_category' );


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
		wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-3.0.0.min.js', array(), null, true );

        wp_enqueue_script( 'tweenmax', get_template_directory_uri() . '/js/TweenMax.min.js', array(), null, true );
        wp_enqueue_script( 'splittext', get_template_directory_uri() . '/js/splitText.min.js', array(), null, true );
        wp_enqueue_script( 'draggable', get_template_directory_uri() . '/js/draggable.min.js', array(), null, true );

        wp_enqueue_script( 'scrollmagic', get_template_directory_uri() . '/js/ScrollMagic.min.js', array(), null, true );
        wp_enqueue_script( 'gsap', get_template_directory_uri() . '/js/animation.gsap.js', array(), null, true );

        wp_enqueue_script( 'alven-script', get_template_directory_uri() . '/js/script.min.js', array(), null, true );

}
add_action( 'wp_enqueue_scripts', 'alven_scripts' );
