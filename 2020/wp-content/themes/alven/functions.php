<?php

define( 'ALVEN_VERSION', 2.0 );

// require_once(WPMU_PLUGIN_DIR . '/class-tgm-plugin-activation.php');

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
add_theme_support( 'html5', array(
    'comment-list',
    'comment-form',
    'search-form',
    'gallery',
    'caption',
    'widgets'
) );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );

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
add_filter( 'emoji_svg_url', '__return_false' );

// remove api rest links
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

// remove comment author class
function alven_remove_comment_author_class( $classes ){
	foreach( $classes as $key => $class ){
		if(strstr($class, 'comment-author-')) unset( $classes[$key] );
	}
	return $classes;
}
add_filter( 'comment_class' , 'alven_remove_comment_author_class' );

// remove login errors
function alven_login_errors(){
    return 'Something is wrong!';
}
add_filter( 'login_errors', 'alven_login_errors' );


/*-----------------------------------------------------------------------------------*/
/* Admin
/*-----------------------------------------------------------------------------------*/
// Remove some useless admin stuff
function alven_remove_submenus() {
    remove_submenu_page( 'themes.php', 'themes.php' );
    remove_submenu_page( 'widgets.php', 'widgets.php' );
    remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'alven_remove_submenus', 999 );
function alven_remove_top_menus( $wp_admin_bar ){
    $wp_admin_bar->remove_node( 'wp-logo' );
    $wp_admin_bar->remove_node( 'comments' );
}
add_action( 'admin_bar_menu', 'alven_remove_top_menus', 999 );

// Enlever le lien par défaut autour des images
function alven_imagelink_setup(){
	if(get_option( 'image_default_link_type' ) !== 'none') update_option('image_default_link_type', 'none');
}
add_action( 'admin_init', 'alven_imagelink_setup' );

// Add wrapper around iframe
function alven_iframe_add_wrapper( $return, $data, $url ){
    return "<div class='wrapper-video'>{$return}</div>";
}
add_filter( 'oembed_dataparse', 'alven_iframe_add_wrapper', 10, 3 );

// Enlever les <p> autour des images
function alven_remove_p_around_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter( 'the_content', 'alven_remove_p_around_images' );

// Allow svg in media library
function alven_mime_types($mimes){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'alven_mime_types' );

// Custom posts in the dashboard
function alven_right_now_custom_post() {
    $post_types = get_post_types(array( '_builtin' => false ) , 'objects' , 'and');
    foreach($post_types as $post_type){
        $cpt_name = $post_type->name;
        if($cpt_name !== 'acf-field-group' && $cpt_name !== 'acf-field'){
            $num_posts = wp_count_posts($post_type->name);
            $num = number_format_i18n($num_posts->publish);
            $text = _n($post_type->labels->name, $post_type->labels->name , intval($num_posts->publish));
            echo '<li class="'. $cpt_name .'-count"><tr><a class="'.$cpt_name.'" href="edit.php?post_type='.$cpt_name.'"><td></td>' . $num . ' <td>' . $text . '</td></a></tr></li>';
        }
    }
}
add_action( 'dashboard_glance_items', 'alven_right_now_custom_post' );

// Add new styles to wysiwyg
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
    $style_formats = array(
        array(
            'title' => 'Button',
            'selector' => 'a',
            'classes' => 'btn'
        )
    );
    $styles['style_formats'] = json_encode( $style_formats );
    // Remove h1 and code
    $styles['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';
    return $styles;
}
add_filter( 'tiny_mce_before_init', 'alven_mce_before_init' );

// Option page
function alven_menu_order( $menu_ord ){  
    if( !$menu_ord ) return true;  
    
    $menu = 'acf-options';
    $menu_ord = array_diff($menu_ord, array( $menu ));
    array_splice( $menu_ord, 1, 0, array( $menu ) );
    return $menu_ord;
}  
add_filter( 'custom_menu_order', 'alven_menu_order' );
add_filter( 'menu_order', 'alven_menu_order' );


/*-----------------------------------------------------------------------------------*/
/* Menus
/*-----------------------------------------------------------------------------------*/
register_nav_menus( array('primary' => 'Primary Menu', 'secondary' => 'Secondary Menu') );

// Cleanup WP Menu html
function alven_css_attributes_filter($var){
    return is_array($var) ? array_intersect($var, array('current-menu-item', 'current_page_parent')) : '';
}
add_filter( 'nav_menu_css_class', 'alven_css_attributes_filter' );


/*-----------------------------------------------------------------------------------*/
/* Posts
/*-----------------------------------------------------------------------------------*/
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
/* Post types
/*-----------------------------------------------------------------------------------*/
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
    /*register_post_type('job', array(
        'label' => 'Jobs',
        'labels' => array(
            'singular_name' => 'Job',
            'menu_name' => 'Jobs'
        ),
        'public' => true,
        'menu_icon' => 'dashicons-businessman',
        'supports' => array('title', 'thumbnail', 'revisions')
    ));*/
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
    /*register_taxonomy('footprint', array('startup'), array(
        'hierarchical' => true,
        'label' => 'Footprints',
        'singular_label' => 'Footprint',
        'show_admin_column' => true
    ));*/
    // Jobs taxos
    /*register_taxonomy('job_type', array('job'), array(
        'label'             => 'Type',
        'singular_label'    => 'Type',
        'show_admin_column' => true
    ));
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
    ));*/
}
add_action( 'init', 'alven_taxonomy' );


/*-----------------------------------------------------------------------------------*/
/* Search -> Add some custom vars
/*-----------------------------------------------------------------------------------*/
function add_query_vars_filter( $vars ) {
    array_push($vars, "shortcode", "location", "company", "function", "sector", "search");
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


/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/
function alven_scripts(){
    // header
	wp_enqueue_style( 'alven-style', get_template_directory_uri() . '/css/main.css', array(), ALVEN_VERSION );

	// footer
	wp_deregister_script('jquery');
	wp_enqueue_script( 'alven-scripts', get_template_directory_uri() . '/js/main.js', array(), ALVEN_VERSION, true );

    wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_enqueue_scripts', 'alven_scripts' );


/*-----------------------------------------------------------------------------------*/
/* TGMPA
/*-----------------------------------------------------------------------------------*/
// function alven_register_required_plugins(){
// 	$plugins = array(
//         array(
//             'name'        => 'Advanced Custom Fields PRO',
//             'slug'        => 'advanced-custom-fields-pro',
//             'source'     => get_template_directory_uri() . '/plugins/advanced-custom-fields-pro.zip',
//             'required'    => true,
//             'force_activation' => false
//         ),
//         array(
//             'name'        => 'Clean Image Filenames',
//             'slug'        => 'clean-image-filenames',
//             'required'    => false,
//             'force_activation' => false
//         ),
//         array(
//             'name'        => 'EWWW Image Optimizer',
//             'slug'        => 'ewww-image-optimizer',
//             'required'    => false,
//             'force_activation' => false
//         ),

//         array(
//             'name'        => 'SecuPress Free — Sécurité WordPress 1.3.3',
//             'slug'        => 'secupress',
//             'required'    => false,
//             'force_activation' => false
//         ),
//     );
    
// 	$config = array(
// 		'id'           => 'alven',
// 		'default_path' => '', 
// 		'menu'         => 'tgmpa-install-plugins',
// 		'parent_slug'  => 'themes.php',
// 		'capability'   => 'edit_theme_options', 
// 		'has_notices'  => true,
// 		'dismissable'  => true,
// 		'dismiss_msg'  => '',
// 		'is_automatic' => false,
// 		'message'      => ''
//     );
    
// 	tgmpa( $plugins, $config );
// }
// add_action( 'tgmpa_register', 'alven_register_required_plugins' );



?>
