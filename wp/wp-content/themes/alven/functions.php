<?php

define( 'ALVEN_VERSION', 1.0 );

define( 'PORTFOLIO_ID', url_to_postid(get_field('pagePortfolio', 'options')) );
define( 'WE_ID', url_to_postid(get_field('pageWe', 'options')) );


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
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );

// remove api rest links
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

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
add_filter( 'login_errors', create_function('$a', "return null;") );


/*-----------------------------------------------------------------------------------*/
/* Admin
/*-----------------------------------------------------------------------------------*/
// Remove some useless admin stuff
function alven_remove_menus(){
    remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'alven_remove_menus' );
function alven_remove_submenus(){
    remove_submenu_page( 'themes.php', 'themes.php' );
}
add_action( 'admin_menu', 'alven_remove_submenus' );
function alven_remove_top_menus($wp_admin_bar){
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
add_action( 'admin_init', 'alven_imagelink_setup' );

// Enlever les <p> autour des images
function alven_remove_p_around_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter( 'the_content', 'alven_remove_p_around_images' );

// Allow svg in media library
function akn_mime_types($mimes){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'akn_mime_types' );
function akn_svg_size(){
  echo '<style>
    svg, img[src*=".svg"]{
        max-width: 150px !important;
        max-height: 150px !important;
    }
  </style>';
}
add_action( 'admin_head', 'akn_svg_size' );

// Custom posts in the dashboard
function alven_right_now_custom_post() {
    $post_types = get_post_types(array( '_builtin' => false ), 'objects', 'and');
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
add_action( 'dashboard_glance_items', 'alven_right_now_custom_post' );

// New button wysiwyg
function alven_button($buttons){
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'alven_button' );

function alven_init_editor_styles(){
    add_editor_style();
}
add_action( 'after_setup_theme', 'alven_init_editor_styles' );

// Customize a bit the wysiwyg editor
function alven_mce_before_init($styles){
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
add_filter( 'tiny_mce_before_init', 'alven_mce_before_init' );

// Page d'options
function alven_menu_order($menu_ord){
    if(!$menu_ord) return true;
    $menu_ord = array_diff($menu_ord, array( 'acf-options' ));
    array_splice( $menu_ord, 1, 0, array( 'acf-options' ) );
    return $menu_ord;
}
add_filter( 'custom_menu_order', 'alven_menu_order' );
add_filter( 'menu_order', 'alven_menu_order' );


/*-----------------------------------------------------------------------------------*/
/* Menus
/*-----------------------------------------------------------------------------------*/
register_nav_menus( array('primary' => 'Primary Menu') );

// Cleanup WP Menu html
function alven_css_attributes_filter($classes){
    return is_array($classes) ? array_intersect($classes, array('current-menu-item', 'current_page_parent')) : '';
}
add_filter( 'nav_menu_css_class', 'alven_css_attributes_filter' );


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
}
add_action( 'widgets_init', 'alven_unregister_default_widgets' );


// Custom Menu Widget
class Menu_Widget extends WP_Widget{
    function __construct(){
        parent::__construct( 'Menu_Widget', 'Alven Menu Widget', array( 'description' => 'Menu widget with title and subtitle' ) );
    }
    public function widget($args, $instance){
        $nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;
        if ( !$nav_menu ) return;

       $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
       $instance['sub_title'] = apply_filters( 'widget_title', empty( $instance['sub_title'] ) ? '' : $instance['sub_title'], $instance, $this->id_base );

       echo "<div class='". $instance['css_class'] ." menu-small'>";

        if(!empty($instance['title'])){
            echo "<span class='menu-title'>" . $instance['title'] . "</span>";
        }
        if(!empty($instance['sub_title'])){
            echo "<span class='menu-subtitle'>" . $instance['sub_title'] . "</span>";
        }

        $nav_menu_args = array( 'fallback_cb' => '', 'menu' => $nav_menu );

        //wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ), array('menu_class' => 'yolo') );
        wp_nav_menu( array('menu' => $instance['nav_menu'], 'container' => false, 'menu_class' => '') );

        echo "</div>";
    }
    public function form($instance){
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
    public function update($new_instance, $old_instance){
        $instance = array();
        if(!empty($new_instance['title'])){
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
        }
        if(!empty($new_instance['sub_title'])){
            $instance['sub_title'] = sanitize_text_field( $new_instance['sub_title'] );
        }
        if(!empty($new_instance['nav_menu'])){
            $instance['nav_menu'] = (int) $new_instance['nav_menu'];
        }
        if(!empty($new_instance['css_class'])){
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
// add class to cat buttons when using the "the_category" function
function alven_add_class_to_category($list){
    return str_replace('<a href="', '<a class="btn-cat" href="', $list);
}
add_filter( 'the_category', 'alven_add_class_to_category' );

// custom excerpt
function alven_custom_excerpt_length($length){
    return 35;
}
add_filter( 'excerpt_length', 'alven_custom_excerpt_length', 999 );

function alven_excerpt_more($more){
    return '...';
}
add_filter( 'excerpt_more', 'alven_excerpt_more' );

// cut get_the_content
function alven_cut_content($text){
    $text = wpautop($text);
    $length = 100;
    if(strlen($text) < $length+10){
        return $text;
    }
    $visible = substr($text, 0, strpos($text, ' ', $length)) . ' …';
    return balanceTags($visible, true);
}

// related posts
function alven_related_posts($currentId){
    $relatedPosts = array();
    $countPosts = 0;
    $notInIds = array($currentId);

    $tags = wp_get_post_tags($currentId);
    if($tags){
        $tagIds = array();
        foreach($tags as $tag){
            $tagIds[] = $tag->term_id;
        }

        $relatedPosts = get_posts( array(
            'post_type' => 'post',
            'tag__in' => $tagIds,
            'post__not_in' => $notInIds,
            'posts_per_page'=> 2
        ) );
        $countPosts = count($relatedPosts);
    }

    if($countPosts < 2){
        foreach($relatedPosts as $related){
            $notInIds[] = $related->ID;
        }

        $cats = get_the_category($currentId)[0];
        if($cats){
            $catsPosts = get_posts( array(
                'post_type' => 'post',
                'tax_query' => array( array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $cats->slug
                ) ),
                'post__not_in' => $notInIds,
                'posts_per_page' => 2 - $countPosts
            ) );

            if(count($catsPosts) > 0){
                foreach($catsPosts as $catsPost){
                    $notInIds[] = $catsPost->ID;
                }
                $relatedPosts[] = $catsPosts[0];
                $countPosts = count($relatedPosts);
            }
        }

        if($countPosts < 2){
            $otherPosts = get_posts( array(
                'post_type' => 'post',
                'post__not_in' => $notInIds,
                'posts_per_page'=> 3 - $countPosts
            ) );

            if(count($otherPosts) > 0){
                foreach($otherPosts as $prev){
                    $notInIds[] = $prev->ID;
                }
                $relatedPosts[] = $otherPosts[0];
            }
        }
    }

    return $relatedPosts;
}

// return inline svg or img
function alven_get_svg($id){
    $icon = wp_get_attachment_thumb_url($id);
    if(strpos( $icon, '.svg' )){
        $icon = str_replace( site_url(), '', $icon);
        $img = file_get_contents(ABSPATH . $icon);
    }else{
        $img = get_the_post_thumbnail('medium', array('class' => 'no-scroll'));
    }
    return $img;
}


/*-----------------------------------------------------------------------------------*/
/* Custom Post Types
/*-----------------------------------------------------------------------------------*/
// Create post type
function alven_post_type(){
    register_post_type('startup', array(
        'label' => 'Startups',
        'labels' => array(
            'singular_name' => 'Startup',
            'menu_name' => 'Portfolio'
        ),
        'public' => true,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
        'taxonomies' => array('post_tag')
    ));
    register_post_type('team', array(
        'label' => 'Team members',
        'labels' => array(
            'singular_name' => 'Team member',
            'menu_name' => 'Team'
        ),
        'public' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title', 'editor', 'thumbnail', 'revisions')
    ));
}
add_action( 'init', 'alven_post_type' );

// Create taxonomies
function alven_taxonomy(){
    register_taxonomy('field', array('startup'), array(
        'hierarchical' => true,
        'label' => 'Fields',
        'singular_label' => 'Field',
        'show_admin_column' => true
    ));
    register_taxonomy('footprint', array('startup'), array(
        'hierarchical' => true,
        'label' => 'Footprints',
        'singular_label' => 'Footprint',
        'show_admin_column' => true
    ));
}
add_action( 'init', 'alven_taxonomy' );

// Define a page as the parent of post type
function alven_save_custom_post_parent($data, $postarr){
    if( $postarr['post_type'] === 'startup' ){
        $data['post_parent'] = PORTFOLIO_ID;
    }else if( $postarr['post_type'] === 'team' ){
        $data['post_parent'] = WE_ID;
    }

    return $data;
}
add_action( 'wp_insert_post_data', 'alven_save_custom_post_parent', '99', 2 );

// Define a page as the parent of post type in the menu
function alven_correct_menu_parent_class($classes, $item){
    global $post;
    if(!$post) return $classes;

    $postType = get_post_type();
    if($postType == 'startup' || $postType == 'team'){
        $item->object_id == $post->post_parent ? $classes[] = 'current_page_parent' : $classes = [];
    }

    return $classes;
}
add_filter( 'nav_menu_css_class', 'alven_correct_menu_parent_class', 10, 2 );


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

        wp_enqueue_script( 'jquery-address', get_template_directory_uri() . '/js/jquery.address-1.6.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'jquery-scrollto', get_template_directory_uri() . '/js/jquery.scrollTo.min.js', array('jquery'), null, true );

        wp_enqueue_script( 'scrollmagic', get_template_directory_uri() . '/js/ScrollMagic.min.js', array(), null, true );
        wp_enqueue_script( 'gsap', get_template_directory_uri() . '/js/animation.gsap.js', array(), null, true );

        wp_enqueue_script( 'alven-script', get_template_directory_uri() . '/js/script.min.js', array(), null, true );
        wp_enqueue_script( 'goliath-script', get_template_directory_uri() . '/js/goliath.js', array(), null, true );

        wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_enqueue_scripts', 'alven_scripts' );

?>
