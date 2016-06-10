<!DOCTYPE html>
<html class='no-js' <?php language_attributes(); ?>>

	<head>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<meta charset='utf-8'>
		<title>
			<?php bloginfo('name'); ?> |
			<?php is_front_page() ? bloginfo('description') : wp_title(''); ?>
		</title>
		<meta name='viewport' content='width=device-width,initial-scale=1'>

		<link rel='alternate' type='application/rss+xml' title='<?php echo get_bloginfo('sitename') ?> Feed' href='<?php echo get_bloginfo('rss2_url') ?>'>

		<?php wp_head(); ?>
	</head>

	<?php
		global $post;
		$currentPage = get_queried_object_id();

		$theme = '';
		$themePortfolio = url_to_postid(get_field('pagePortfolio', 'options'));
		$themeMagazine = intval(get_option( 'page_for_posts' ));
		$themeWe = url_to_postid(get_field('pageWe', 'options'));

		if($currentPage === $themePortfolio || $currentPage->post_parent === $themePortfolio){
			$theme = 'theme-portfolio';
		}else if($currentPage === $themeMagazine || is_singular('post')){
			$theme = 'theme-magazine';
			echo 'aye!';
		}else if($currentPage === $themeWe || $currentPage->post_parent === $themeWe){
			$theme = 'theme-we';
		}
	?>

	<body <?php body_class($theme); ?>>

		<header role='banner' id='header'>
			<div class='container'>
				<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home' id='logo'><?php bloginfo( 'name' ); ?></a>
				<nav role='navigation' id='menu-main'>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => null, 'menu_id' => '', 'menu_class' => '' ) ); ?>
				</nav>
				<span class='post-title'><?php the_title(); ?></span>
				<a id='searchBtn' class='btn-search' href='#'>Explore Alven</a>
				<button id='burger'><span>Menu</span></button>
				<nav role='navigation' id='menu-responsive'>
					<?php dynamic_sidebar( 'menu-responsive' ); ?>
				</nav>
			</div>
			<div id='readIndicator' class='read-indicator'></div>
		</header>
