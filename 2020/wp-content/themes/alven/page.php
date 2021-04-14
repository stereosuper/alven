<?php get_header(); ?>

<?php if ( have_posts() ) : the_post(); ?>
	<div class='title-wrapper'>
		<div class='container'>
			<h1><?php the_title(); ?></h1>
			<?php if($subtitle = get_field('subtitle')) : ?>
				<p><?php echo $subtitle; ?></p>
			<?php endif; ?>
		</div>
	</div>

	<div class='container'>
		<div class='content wysiwyg'>
			<?php the_content(); ?>
		</div>
	</div>
	
<?php endif; ?>

<?php get_footer(); ?>