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


	<body <?php body_class(); ?>>

		<header role='banner' id='header'>
			<div class='container'>
				<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home' id='logo'><?php bloginfo( 'name' ); ?></a>
				<nav role='navigation' id='menu-main'>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => null, 'menu_id' => '', 'menu_class' => '' ) ); ?>
				</nav>
				<a id='searchBtn' class='btn-search' href='#'>Explore Alven</a>
				<button id='burger'><span>Menu</span></button>
				<nav role='navigation' id='menu-responsive'>
					<?php dynamic_sidebar( 'menu-responsive' ); ?>
				</nav>
			</div>
			<div id='readIndicator' class='read-indicator'></div>
		</header>
