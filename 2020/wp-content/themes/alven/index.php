<?php get_header(); ?>

<div class='title-wrapper'>
	<div class='container'>
		<h1><?php single_post_title(); ?></h1>
	</div>
</div>

<div class='container'>

    <?php
        get_search_form();
    
        if ( have_posts() ) : 

            include_once('includes/spotlight.php');

            $queryPost = new WP_Query(array('post__not_in' => array($sticky), 'paged' => $paged));
            
            if( $queryPost->have_posts() ):
                while ( $queryPost->have_posts() ) :
                    $queryPost->the_post();
                    get_template_part('includes/post');
                endwhile;
            ?>

                <div class='container pagination'>
                    <?php echo paginate_links( array( 'prev_text' => '', 'next_text'  => '' ) ); ?>
                </div>
            <?php endif; ?>
	
	<?php else : ?>
				
		<p><?php _e('No posts yet'); ?></p>

	<?php endif; ?>

</div>

<?php get_footer(); ?>