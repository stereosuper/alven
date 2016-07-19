<!DOCTYPE html>
<html class='no-js' <?php language_attributes(); ?>>

    <head>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta charset='utf-8'>
        <title><?php wp_title(''); ?></title>
        <meta name='viewport' content='width=device-width,initial-scale=1'>

        <link rel='alternate' type='application/rss+xml' title='Alven Capital RSS Feed' href='<?php echo get_bloginfo('rss2_url'); ?>'>

        <link rel='apple-touch-icon' sizes='180x180' href='/apple-touch-icon.png'>
        <link rel='icon' type='image/png' href='/favicon-32x32.png' sizes='32x32'>
        <link rel='icon' type='image/png' href='/favicon-16x16.png' sizes='16x16'>
        <link rel='manifest' href='/manifest.json'>
        <link rel='mask-icon' href='/safari-pinned-tab.svg' color='#034599'>
        <meta name='apple-mobile-web-app-title' content='AlvenCapital'>
        <meta name='application-name' content='AlvenCapital'>
        <meta name='theme-color' content='#ffffff'>

        <?php wp_head(); ?>
    </head>

    <?php
        $currentPage = get_queried_object();
        $theme = '';
        $headerFixed = true;

        if($currentPage){
            $currentPageId = $currentPage->ID;
            $currentPageParent = $currentPage->post_parent;

            $themeMagazine = intval(get_option( 'page_for_posts' ));

            if($currentPageId === PORTFOLIO_ID || $currentPageParent === PORTFOLIO_ID){
                $theme = 'theme-portfolio';
            }else if($currentPageId === $themeMagazine || $currentPage->post_type === 'post' || is_archive()){
                $theme = 'theme-magazine';
            }/*else if($currentPageId === WE_ID || $currentPageParent === WE_ID){
                $theme = 'theme-we';
            }*/

            if($currentPage->post_type === 'post' || !$theme){
                // une page sans theme (donc default template ou home) ou un single post
                // on ajoute la classe fixed au header car il n'y a pas de fond en haut de page
                // et donc le header nécessite un fond

                // en js la fonction n'est déclenchée que si la div #contentHeader est présente
                $headerFixed = false;
            }

            if($currentPageId === CONTACT_ID){
                $headerFixed = true;
            }
        }

        global $specialCats;
        $specialCats = array(get_field('catJob', 'options'), get_field('catDef', 'options'), get_field('catRead', 'options'), get_field('catEvent', 'options'));
    ?>

    <body <?php body_class($theme); ?>>

        <header role='banner' id='header' <?php if($headerFixed){ echo "class='fixed'"; } ?>>
            <div class='container'>
                <a href='<?php echo home_url( '/' ); ?>' title='<?php bloginfo( 'name' ); ?>' rel='home' id='logo-alven'><?php bloginfo( 'name' ); ?></a>
                <nav role='navigation' id='menu-main'>
                    <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => null, 'menu_id' => '', 'menu_class' => '')); ?>
                </nav>
                <span class='post-title'><?php the_title(); ?></span>
                <form role='search' method='get' action='<?php echo home_url('/'); ?>' class='form-search form-search-header'>
                    <input type='search' name='s' value='' id='search-header'>
                    <label for='search-header'>type some keywords</label>
                    <button type='submit' class='btn-search'>Explore Alven</button>
                </form>
                <button id='burger'><span>Menu</span></button>
                <nav role='navigation' id='menu-responsive'><div><?php dynamic_sidebar( 'menu-responsive' ); ?></div></nav>
            </div>
            <div id='readIndicator' class='read-indicator'></div>
        </header>

        <div id='fadePage'>
            <div id='ajaxContainer' <?php if(isset($currentPageId) && $currentPageId === PORTFOLIO_ID) echo "class='single-startup'"; ?>></div>
