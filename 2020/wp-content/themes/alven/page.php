<?php get_header(); ?>

<div class='title-wrapper'>
	<div class='container'>
		<h1><?php the_title(); ?></h1>
	</div>
</div>

<div class='container'>

	<?php if ( have_posts() ) : the_post(); ?>

		<?php the_content(); ?>
	
	<?php endif; ?>

</div>

<?php get_footer(); ?>