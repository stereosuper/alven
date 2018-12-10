<?php

define( 'ALVEN_VERSION', 1.1 );

// WORKABLE
define( 'WRKBL_SUBDOMAIN', 'alven' );
define( 'WRKBL_TOKEN', '74069b76972b9edc000610fd9cd1f2f9945483d3425e7483467d0faa6f43680b' );
define( 'WRKBL_APPLICATION', 'alven' );
// END WORKABLE

if(function_exists('get_field')){
    define( 'PORTFOLIO_ID', url_to_postid(get_field('pagePortfolio', 'options')) );
    define( 'CONTACT_ID', url_to_postid(get_field('pageContact', 'options')) );
    //define( 'WE_ID', url_to_postid(get_field('pageWe', 'options')) );
}


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
// add_filter( 'login_errors', create_function('$a', "return null;") );


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
    if($image_set !== 'none') update_option('image_default_link_type', 'none');
}
add_action( 'admin_init', 'alven_imagelink_setup' );

// Enlever les <p> autour des images
function alven_remove_p_around_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter( 'the_content', 'alven_remove_p_around_images' );

// Allow svg in media library
function alven_allow_svg($filetype_ext_data, $file, $filename, $mimes){
    if( substr($filename, -4) === '.svg' ){
        $filetype_ext_data['ext'] = 'svg';
        $filetype_ext_data['type'] = 'image/svg+xml';
    }
    return $filetype_ext_data;
}
add_filter( 'wp_check_filetype_and_ext', 'alven_allow_svg', 100, 4 );
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
    //$styles['textcolor_map'] = '[' . "'000000', 'Black', '565656', 'Text'" . ']';
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
register_nav_menus( array('primary' => 'Primary Menu', 'secondary' => 'Secondary Menu') );

// Cleanup WP Menu html
function alven_css_attributes_filter($classes){
    return is_array($classes) ? array_intersect($classes, array('current-menu-item', 'current_page_parent', 'who-we-are')) : '';
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
    register_sidebar(array(
        'id' => 'newsletter',
        'name' => 'Newsletter',
        'description' => 'Put here the mailjet widget to appear on home page',
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

// add image specific sizes
function alven_thumbnail_sizes(){
    add_image_size( 'team-thumb', 210, 277, true );
}
add_action( 'after_setup_theme', 'alven_thumbnail_sizes' );

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
    register_post_type('job', array(
        'label' => 'Jobs',
        'labels' => array(
            'singular_name' => 'Job',
            'menu_name' => 'Jobs'
        ),
        'public' => true,
        'menu_icon' => 'dashicons-businessman',
        'supports' => array('title', 'editor', 'thumbnail', 'revisions')
    ));
    register_post_type('team', array(
        'label' => 'Team members',
        'labels' => array(
            'singular_name' => 'Team member',
            'menu_name' => 'Team'
        ),
        'public' => true,
        'publicly_queryable' => false,
        'query_var' => false,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title', 'editor', 'thumbnail', 'revisions')
    ));
    register_post_type('quote', array(
        'label' => 'Quotes',
        'labels' => array(
            'singular_name' => 'Quote',
            'menu_name' => 'Quotes'
        ),
        'public' => true,
        'publicly_queryable' => false,
        'query_var' => false,
        'menu_icon' => 'dashicons-format-quote',
        'supports' => array('title', 'thumbnail', 'revisions')
    ));
}
add_action( 'init', 'alven_post_type' );

// Create taxonomies
function alven_taxonomy(){
    // Startup taxos
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
    // Jobs taxos
    register_taxonomy('job_location', array('job'), array(
        'label'             => 'Location',
        'singular_label'    => 'Location',
        'show_admin_column' => true
    ));
    register_taxonomy('job_function', array('job'), array(
        'label'             => 'Function',
        'singular_label'    => 'Function',
        'show_admin_column' => true
    ));
    register_taxonomy('job_sector', array('job'), array(
        'label'             => 'Sector',
        'singular_label'    => 'Sector',
        'show_admin_column' => true
    ));
}
add_action( 'init', 'alven_taxonomy' );

// Define a page as the parent of post type
function alven_save_custom_post_parent($data, $postarr){
    if( $postarr['post_type'] === 'startup' ){
        $data['post_parent'] = PORTFOLIO_ID;
    }/*else if( $postarr['post_type'] === 'team' ){
        $data['post_parent'] = WE_ID;
    }*/

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

    if(is_search()){
        $classes = [];
    }

    return $classes;
}
add_filter( 'nav_menu_css_class', 'alven_correct_menu_parent_class', 10, 2 );


/*-----------------------------------------------------------------------------------*/
/* Search -> Add some custom vars
/*-----------------------------------------------------------------------------------*/
function add_query_vars_filter( $vars ) {
    array_push($vars, "location", "company", "function", "sector", "search");
    return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );


/*-----------------------------------------------------------------------------------*/
/* Search -> Include search results in taxonomies
/*-----------------------------------------------------------------------------------*/
function alven_search_where($where){
    global $wpdb;

    if(is_search() && !is_admin()){
        $where .= " OR (t.name LIKE '%".get_search_query()."%' AND {$wpdb->posts}.post_status = 'publish') AND {$wpdb->posts}.post_type IN ('post', 'startup')";
    }
    return $where;
}
add_filter( 'posts_where', 'alven_search_where' );

function alven_search_join($join){
    global $wpdb;
    if(is_search() && !is_admin()){
        $join .= "LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id INNER JOIN {$wpdb->term_taxonomy} tt ON tt.term_taxonomy_id=tr.term_taxonomy_id INNER JOIN {$wpdb->terms} t ON t.term_id = tt.term_id";
    }
    return $join;
}
add_filter( 'posts_join', 'alven_search_join' );

function alven_search_groupby($groupby){
    global $wpdb;

    $groupby_id = "{$wpdb->posts}.ID";
    if(!is_search() || strpos($groupby, $groupby_id) !== false) return $groupby;

    if(!strlen(trim($groupby))) return $groupby_id;

    return $groupby.", ".$groupby_id;
}
add_filter( 'posts_groupby', 'alven_search_groupby' );


// filter search results to only have posts and startups
/*function alven_search_filter($query){
    if(!is_admin() && $query->is_main_query()){
        if($query->is_search){
            $query->set('post_type', array('post', 'startup'));
        }
    }
    return $query;
}
add_filter( 'pre_get_posts', 'alven_search_filter' );*/


/*-----------------------------------------------------------------------------------*/
/* Markup gallery
/*-----------------------------------------------------------------------------------*/
function alven_post_gallery($output, $attr){
    global $post;

    if( isset($attr['orderby']) ){
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if( !$attr['orderby'] ) unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => '',
        'icontag'    => '',
        'captiontag' => '',
        'columns'    => 0,
        'size'       => 'large',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);

    $include = preg_replace( '/[^0-9,]+/', '', $include );
    $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

    $attachments = array();
    foreach( $_attachments as $key => $val ){
        $attachments[$val->ID] = $_attachments[$key];
    }

    if( empty($attachments) ) return '';

    $output = '<div class="gallery-container"><div class="gallery">';
    foreach( $attachments as $id => $attachment ){
        $caption = get_post( $id )->post_excerpt;
        $captionOutput = empty($caption) ? '' : '<span class="caption">'.$caption.'</span>';
        $output .= '<div><a target="_blank" href="' . wp_get_attachment_image_src($id, $size)[0] . '">' . wp_get_attachment_image($id, $size, false, array('class' => 'no-scroll')) . $captionOutput . '</a></div>';
    }
    $output .= '</div></div>';

    return $output;
}
add_filter( 'post_gallery', 'alven_post_gallery', 10, 2 );


/*-----------------------------------------------------------------------------------*/
/* TEMPLATE REDIRECTION
/*-----------------------------------------------------------------------------------*/
function careers_page_template( $template ) {

	if ( is_singular( 'job' ) ) {
		$new_template = locate_template( array( 'careers.php' ) );
		if ( !empty( $new_template ) ) {
			return $new_template;
		}
	}

	return $template;
}
add_filter( 'template_include', 'careers_page_template', 99 );

/*-----------------------------------------------------------------------------------*/
/* AJAX
/*-----------------------------------------------------------------------------------*/

/**
 * Retourne la première page utilisant le template donné
 *
 * @param type $template_name
 * @return type
 */
function sushi_get_page_by_template($template_name) {
  $posts_args = array(
    'numberposts'     => 1,
    'meta_key'        => '_wp_page_template',
    'meta_value'      => $template_name,
    'post_type'       => 'page',
  );
  $posts = get_posts($posts_args);
  if (is_array($posts) && isset($posts[0])) {
    return $posts[0];
  }
}


/**
 * Retourne le permalien de la première page utilisant le template donné
 *
 * @param type $template_name
 * @return type
 */
function sushi_get_page_url_by_template($template_name) {
  $page = sushi_get_page_by_template($template_name);
  return get_permalink($page->ID);
}

function alven_get_startup_permalink($post) {
    $url = get_permalink($post);

    $portfolio_url = sushi_get_page_url_by_template('portfolio.php');
    if ($portfolio_url) {
        $protocol = (stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true) ? 'https://' : 'http://';
        $relative_url = str_replace($protocol.$_SERVER['SERVER_NAME'], '', $url);
        $url = $portfolio_url.'#'.$relative_url;
    }

    return $url;
}

// Src : http://stackoverflow.com/questions/6768793/get-the-full-url-in-php
function url_origin( $s, $use_forwarded_host = false )
{
    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

function full_url( $s, $use_forwarded_host = false )
{
    return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}


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
    wp_enqueue_script( 'jquery-address', get_template_directory_uri() . '/js/jquery.address-1.6.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'jquery-scrollto', get_template_directory_uri() . '/js/jquery.scrollTo.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'jquery-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery.easing.min.js', array('jquery'), null, true );

    wp_enqueue_script( 'tweenmax', get_template_directory_uri() . '/js/TweenMax.min.js', array(), null, true );
    wp_enqueue_script( 'splittext', get_template_directory_uri() . '/js/splitText.min.js', array('tweenmax'), null, true );
    wp_enqueue_script( 'draggable', get_template_directory_uri() . '/js/draggable.min.js', array('tweenmax'), null, true );
    wp_enqueue_script( 'throwprop', get_template_directory_uri() . '/js/ThrowPropsPlugin.min.js', array('tweenmax'), null, true );
    wp_enqueue_script( 'scrollto', get_template_directory_uri() . '/js/ScrollToPlugin.min.js', array('tweenmax'), null, true );

    wp_enqueue_script( 'scrollmagic', get_template_directory_uri() . '/js/ScrollMagic.min.js', array(), null, true );
    wp_enqueue_script( 'gsap', get_template_directory_uri() . '/js/animation.gsap.min.js', array(), null, true );

    wp_enqueue_script( 'alven-script', get_template_directory_uri() . '/js/script.min.js', array(), ALVEN_VERSION, true );
    wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/js/ajax.min.js', array('alven-script'), null, true );
    wp_localize_script('ajax-script', 'alven_ajax', alven_ajax());

    wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_enqueue_scripts', 'alven_scripts' );

/*
 * Passe aux scripts l'adresse de la page admin-ajax.php
 */
function alven_ajax()
{
    return array(
        'ajax_url' => admin_url('admin-ajax.php')
    );
}

/*
 * Traite la requête ajax
 */
function alven_portfolio_ajax()
{
    $url = $_POST['href'] ;
    $slug = end((explode('/', untrailingslashit($url)))); //str_replace('/', '', str_replace('/startup/', '/', $url));

    $args = array(
        'name' => $slug,
        'post_type' => 'startup',
    );

    query_posts($args);

    the_post();

    get_template_part('ajax/single', 'startup');

    wp_die();
}
add_action('wp_ajax_nopriv_alven_portfolio_ajax', 'alven_portfolio_ajax');
add_action('wp_ajax_alven_portfolio_ajax', 'alven_portfolio_ajax');


/*-----------------------------------------------------------------------------------*/
/* CAREERS FUNCTIONS ASSOCIATED
/*-----------------------------------------------------------------------------------*/
// Main query of the careers template : available for single and list
function get_posts_filtered( $is_details = FALSE, $metquery, $taxquery ){

    $posts_args = array(
        'post_type'      => 'job',
        'posts_per_page' =>  4,
        'meta_query'     => $metquery,
        'tax_query'      => $taxquery,
        's'              => sanitize_text_field( get_query_var('search') )
    );

    if( !$is_details ):
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $posts_args['paged'] = $paged;
    endif;

    $jobs = new WP_Query( $posts_args );

   return $jobs;
}

function get_form_datas( $d ){
    $action = get_current_template_url( $d, 'careers.php' );
    
    // Get locations
    $locations = get_terms( array(
        'taxonomy'   => 'job_location',
        'hide_empty' => false
    ) );
    // Get functions
    $functions = get_terms( array(
        'taxonomy'   => 'job_function',
        'hide_empty' => false
    ) );           
    // Get sectors
    $sectors = get_terms( array(
        'taxonomy'   => 'job_sector',
        'hide_empty' => false
    ) );        
    // Get startups
    $startups = get_meta_values('job_company', 'job');
    if( !empty( $startups ) ){
        $startups_filtered = array_count_values( $startups );
        $startups_extended = array_map( 'extend_metas_response', $startups_filtered, array_keys( $startups_filtered ) );
    }

    return array(
        'action'    => $action,
        'locations' => $locations,
        'functions' => $functions,
        'sectors'   => $sectors,
        'startups'  => $startups_extended 
    );
}

// Functions below that "extends" allow to "extend" the function get_meta_values()
// This is specific usage for careers template
function extend_metas_response( $s, $k ){
    $extended = array(
        'id'    => $k,
        'slug'  => get_post_field( 'post_name', $k ),
        'name'  => get_the_title( $k ),
        'count' => $s
    );
    return $extended;
}
function extend_post( $id ){
    $company_datas = null;
    
    if( $id ):
        $company_datas = array(
            'permalink'=> get_the_permalink( $id ),
            'name'     => get_the_title( $id ),
            'logo_url' => get_the_post_thumbnail_url( $id ),
            'sectors'  => wp_get_post_terms( $id, 'field' )
        );
    endif;

    return $company_datas;
}

// Get page carreer url and return it
// Params :
// $s : is page details ? (boolean)
// $t : template name (string)
function get_current_template_url( $s, $t ){
    if( $s ):
        $page = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => $t
        ));
        return get_permalink( $page[0]->ID );
    else:
        return get_permalink();
    endif;
}

// Allow to get all and only specific metas values from a CPT without querying the post
// Origin of the function below : https://wordpress.stackexchange.com/questions/9394/getting-all-values-for-a-custom-field-key-cross-post
function get_meta_values( $key = '', $type = 'post', $status = 'publish' ) {
    global $wpdb;

    if( empty( $key ) )
        return;

    $r = $wpdb->get_col( $wpdb->prepare( "
        SELECT pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND p.post_type = '%s'
    ", $key, $status, $type ) );

    return $r;
}

// Add datas to the main response of WP_QUERY
// @params :
// $jobs    : job to extend (object)
// $datas   : add startups datas (boolean)
function extend_query( $jobs, $datas ){
    foreach ($jobs as $key => $job) {

        if( $datas['location'] ):
            // Set location
            $job->location = get_the_terms($job->ID, 'job_location');
        endif;
        
        if( $datas['startup'] ):
            // Set startup datas to job datas
            $sid     = get_field('job_company', $job->ID);
            $job->from = array(
                'name' => get_the_title( $sid ),
                'logo' => get_the_post_thumbnail_url( $sid ),
                //...
            );
        endif;
    }

    return $jobs;
}

// Get a list of jobs available in workable
function get_jobs_from_wrkbl(){
    $workable_datas = null;
    $workable_args = array(
        'headers' => array(
            'Content-Type: application/json',
            'Authorization' => 'Bearer ' . WRKBL_TOKEN
        ),
    );

    // ?state=published
    $workable_response = wp_remote_get( 'https://'. WRKBL_SUBDOMAIN .'.workable.com/spi/v3/jobs', $workable_args );
    $workable_response_code = wp_remote_retrieve_response_code( $workable_response );

    if( $workable_response_code == 200 ):
        $workable_datas_filtered = json_decode( $workable_response['body'], true );
        $workable_datas = $workable_datas_filtered['jobs'];
    endif;

    return $workable_datas;
}

function get_url_with_careers_params( $u, $p ){
    return add_query_arg( array(
        'location' => $p['location'],
        'company'  => $p['company'],
        'function' => $p['function'],
        'sector'   => $p['sector'],
    ), $u );
}