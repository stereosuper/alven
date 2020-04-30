<?php
/*
Template Name: Contact
*/

require_once('includes/form-contact.php');

get_header(); ?>

<?php if ( have_posts() ) : the_post(); ?>
	<div class='title-wrapper'>
		<div class='container'>
			<h1><?php the_title(); ?></h1>
		</div>
	</div>

	<div class="container">
		<div class="content wysiwyg">
			<?php the_content(); ?>
		</div>
        <?php require_once('includes/contact.php'); ?>
    </div>
	
<?php endif; ?>

<?php get_footer(); ?>