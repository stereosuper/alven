<!DOCTYPE html>
<html class='no-js' <?php language_attributes(); ?>>

	<head>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<meta charset='utf-8'>
		<title><?php wp_title(''); ?></title>
		<meta name='viewport' content='width=device-width,initial-scale=1'>

		<link rel='alternate' type='application/rss+xml' title='Alven Capital RSS Feed' href='<?php echo get_bloginfo('rss2_url') ?>'>

		<?php wp_head(); ?>
	</head>

	<?php
		$currentPage = get_queried_object();
		$theme = '';

		if($currentPage){
			$currentPageId = $currentPage->ID;
			$currentPageParent = $currentPage->post_parent;

			$themeMagazine = intval(get_option( 'page_for_posts' ));

			if($currentPageId === PORTFOLIO_ID || $currentPageParent === PORTFOLIO_ID){
				$theme = 'theme-portfolio';
			}else if($currentPageId === $themeMagazine || $currentPage->post_type === 'post'){
				$theme = 'theme-magazine';
			}else if($currentPageId === WE_ID || $currentPageParent === WE_ID){
				$theme = 'theme-we';
			}
		}
	?>

	<body <?php body_class($theme); ?>>

		<header role='banner' id='header' <?php if($currentPage->post_type == 'startup'){ echo "class='fixed'"; } ?>>
			<div class='container'>
				<a href='<?php echo home_url( '/' ); ?>' title='<?php bloginfo( 'name' ); ?>' rel='home' id='logo'><?php bloginfo( 'name' ); ?></a>
				<nav role='navigation' id='menu-main'>
					<?php wp_nav_menu(array('theme_location' => 'primary', 'container' => null, 'menu_id' => '', 'menu_class' => '')); ?>
				</nav>
				<span class='post-title'><?php the_title(); ?></span>
				<a id='searchBtn' class='btn-search' href='#'>Explore Alven</a>
				<button id='burger'><span>Menu</span></button>
				<nav role='navigation' id='menu-responsive'><?php dynamic_sidebar( 'menu-responsive' ); ?></nav>
			</div>
			<div id='readIndicator' class='read-indicator'></div>
		</header>
