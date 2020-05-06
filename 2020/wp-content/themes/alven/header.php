<!DOCTYPE html>

<html <?php language_attributes(); ?> class='no-js'>
	<head>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width,initial-scale=1'>
		<meta name='format-detection' content='telephone=no'>

		<link rel='alternate' type='application/rss+xml' title='<?php echo get_bloginfo('sitename') ?> Feed' href='<?php echo get_bloginfo('rss2_url') ?>'>

		<link rel='apple-touch-icon' sizes='180x180' href='/apple-touch-icon.png?v=2'>
        <link rel='icon' type='image/png' href='/favicon-32x32.png?v=2' sizes='32x32'>
        <link rel='icon' type='image/png' href='/favicon-16x16.png?v=2' sizes='16x16'>
        <link rel='manifest' href='/manifest.json'>
        <link rel='mask-icon' href='/safari-pinned-tab.svg?v=2' color='#003240'>
        <meta name='apple-mobile-web-app-title' content='Alven'>
        <meta name='application-name' content='Alven'>
        <meta name='theme-color' content='#fff'>

        <link href="https://fonts.googleapis.com/css?family=Arvo:400,400i,700,700i" rel="stylesheet">

		<?php wp_head(); ?>

		<script>document.getElementsByTagName('html')[0].className = 'js';</script>

		<script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-104338226-1', 'auto');
            ga('send', 'pageview');
        </script>
	</head>

	<body <?php body_class(); ?>>

		<div class="wrapper">

			<header role='banner' id='header' class='header'>
				<div class='container header-content'>
					<a href='<?php echo home_url( '/' ); ?>' title='<?php bloginfo( 'name' ); ?>' rel='home' class='logo'>
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 95 69">
							<path d="M9.8 64.053a4.473 4.473 0 1 0-.03-8.946 4.473 4.473 0 0 0 .03 8.946m-.63-13.928c2.69 0 4.39.807 5.38 2.49v-1.858h5.02V68.4h-5.02v-1.894c-.85 1.684-2.66 2.49-5.52 2.49-5.35 0-9.03-3.858-9.03-9.437 0-5.543 3.79-9.438 9.17-9.438m16.46-5.227h5.34v23.5h-5.34V44.9zm9.06 5.86h5.52l3.43 11.015 3.43-11.016h5.53L46.19 68.4h-5.13zM68.31 57.7a3.9 3.9 0 0 0-4.03-3.052 3.84 3.84 0 0 0-4 3.052h8.03zm-4.07-7.543a9.3 9.3 0 0 1 9.38 9.648 6.193 6.193 0 0 1-.14 1.44H60.17a3.734 3.734 0 0 0 3.89 3.3 4.023 4.023 0 0 0 3.26-1.4l.25-.247h5.45c-1.66 3.824-4.89 6.1-8.71 6.1a9.42 9.42 0 0 1-.07-18.84m14.27.6h5.02v1.86a5.34 5.34 0 0 1 4.89-2.457 6.9 6.9 0 0 1 4.81 1.79c1.34 1.263 1.77 2.632 1.77 5.44V68.4h-5.34v-9.61a4.3 4.3 0 0 0-.54-2.6 2.675 2.675 0 0 0-2.26-1.087 3.02 3.02 0 0 0-2.51 1.228 3.236 3.236 0 0 0-.5 2.21v9.86h-5.34V50.757zm-28.78-38.56a17.685 17.685 0 0 1-.23-1.767q-1.035-.493-1.98-.93a6.7 6.7 0 0 0 .25 4.33c.58 1.43.4 4.352-.4 7.215a11.816 11.816 0 0 1-1.79 3.45c.26.368.58.812.96 1.32a17.49 17.49 0 0 0 2.85-5.63 15.022 15.022 0 0 0 .34-7.987m10.35 3.352l-2.02-.974c-.75.736-1.42 1.33-1.83 1.686-1.68 2.388-2.16 2.566-1.88 1.06a31.032 31.032 0 0 0 1.17-3.98c-.59-.29-1.18-.576-1.76-.857-.37 1.884-.76 3.628-1 4.61-.42 1.78.75 4.567-4.97 10.344.19.245.39.5.61.76.12.115.25.233.38.35 1.88-2.133 4.13-4.76 6.03-7.076 1.66-2.01 3.63-3.962 5.27-5.924m.95 5.475c.84-1.454 1.61-2.77 2.25-3.947-.68-.322-1.39-.66-2.08-.993a19.13 19.13 0 0 0-2 3.9c-.23.744-1.79 3.264-5.43 6.7-1.18 1.12-2.42 2.23-3.54 3.3.25.26.5.522.75.786a30.192 30.192 0 0 1 2.61-2.008c2.27-1.85 5.74-4.808 7.44-7.735m-30.42-1.67c-.02.038-.05.078-.07.12a10.82 10.82 0 0 1 .4 3.594c-.25 2.886.34 5.613.96 4.916a23.365 23.365 0 0 0 1.42-4.356c.13-1.444-1.08-4.56-1.41-7.586-.55 1.437-.98 2.674-1.3 3.312m29.74 9.25l.21-.235a45.3 45.3 0 0 0-7.76 4.43c.41.474.8.947 1.18 1.413a10.217 10.217 0 0 1 1.99-1.257 12.5 12.5 0 0 0 2.02-1.366 36.59 36.59 0 0 1 2.36-2.985m-31.05-5.11a4.7 4.7 0 0 0-.09-1.273 31.272 31.272 0 0 0-2.24 4.873 15.363 15.363 0 0 0 .88 3.113 8.65 8.65 0 0 1 .27 1.855 10.16 10.16 0 0 0 .64.824 2.9 2.9 0 0 0 1.9 1.084c.04-.414.06-.848.08-1.3.01-.213.03-.43.05-.647a27.11 27.11 0 0 0-.97-3.848 8.716 8.716 0 0 1-.52-4.68m13.1-12.24c-.81 2.463-.98 3.952-.75 7.788s-.52 5.153-1.56 6.24a8.22 8.22 0 0 0-1.52 2.237 33.388 33.388 0 0 1 3.93-2.176 27.927 27.927 0 0 0 1.86-9.336 13.837 13.837 0 0 1 .23-4.638 26.392 26.392 0 0 0 .62-2.91c-.93-.4-1.72-.718-2.35-.93a10.71 10.71 0 0 1-.46 3.726m22.54 11.29c.77-1.22.89-2.743 1.49-4.015-.76-.34-.96-.435-1.76-.8-1.72 2.7-3.97 6.447-4.19 7.854a28.73 28.73 0 0 0 4.46-3.033m-25.9-10.976c1.55-1.948 1.28-6.785 1.69-9.763a9.706 9.706 0 0 1 .35-1.54l-.03-.263a39.79 39.79 0 0 0-3.53 3.176l-.62-.823-.24.294-.16 3.524s.98-1.136 1.62-1.793a.018.018 0 0 1 .01 0c2.31-2.12-1.16 3.092-2.6 6.528a11.13 11.13 0 0 0-.78 3.913 12.957 12.957 0 0 0 .1 2.306v.033a18.383 18.383 0 0 0 .8 3.368 6.447 6.447 0 0 1-.35 4.924 10.45 10.45 0 0 0-1.56 4.58 21.39 21.39 0 0 1-.12 2.622 11.564 11.564 0 0 0 1.61-1.95 10.572 10.572 0 0 1 1.52-1.756c-.01-1.018-.17-2.55.74-3.555 1.04-1.145.77-4.213.66-6.5s-.66-5.363.89-7.326m19.62 28.363c.8-5.336 5.16-9.533 6.14-11.026 1.06-1.132 4.95-5.7 2.35-10.3-.11 1.63.38 4.64-2.77 8.065-6.18 5.918-7.14 11.53-7.14 11.53l1.28 2.5z"/>
						</svg>
					</a>

					<button class='burger' id='burger' role="button">
						<svg class="icon"><use xlink:href="#icon-burger"></use></svg>
					</button>

					<nav role='navigation' class='nav' id='nav'>
						<?php wp_nav_menu(array('theme_location' => 'primary', 'container' => null, 'menu_id' => '', 'menu_class' => 'menu-main')); ?>
						<button class='close' id='close' role="button">
							<svg class="icon"><use xlink:href="#icon-cross"></use></svg>
						</button>
					</nav>

					<form role='search' method='get' action='<?php echo home_url('/'); ?>' class='form-search-header' id='form-search-header'>
						<div class='field-search js-field' id='search-header'>
							<input type='search' name='s' value='<?php the_search_query(); ?>' class='form-elt'>
							<label class="label" for='search-header' <?php if( get_search_query() ) echo 'class="off"'; ?>>searching</label>
						</div>
						<button type='submit' class='btn-search'>
							<svg class="icon"><use xlink:href="#icon-glass"></use></svg>
						</button>
					</form>
				</div>
			</header>

			<main role='main' class='main'>
