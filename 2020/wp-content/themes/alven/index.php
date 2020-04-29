<?php get_header(); ?>

<div class='title-wrapper'>
	<div class='container'>
		<h1><?php single_post_title(); ?></h1>
	</div>
</div>

<div class='container'>

    <div class="form-search-wrapper">
        <form role='search' method='get' action='<?php echo home_url('/'); ?>' class='form-search'>
            <div class='field-search js-field'>
                <input type='search' name='s' value='<?php the_search_query(); ?>' id='search'>
                <label for='search' <?php if( get_search_query() ) echo 'class="off"'; ?>>search</label>
            </div>
            <button type='submit' class='btn-search'>
                <svg class="icon"><use xlink:href="#icon-glass-bold"></use></svg>
            </button>
        </form>
    </div>

	<?php if ( have_posts() ) : ?>

		<?php
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;

			$stickies = array_reverse( get_option( 'sticky_posts' ) );
			$sticky = 0;
            if( $stickies && $paged === 1 ):
				$post = $stickies[0];
				$sticky = $post;
                setup_postdata($post);
        ?>
            <div class='spotlight-post'>
                <div class='img'>
                    <?php the_post_thumbnail('full', array('class' => 'no-scroll')); ?>
                </div>
				<div class='txt'>
                    <time datetime='<?php echo get_the_date('Y-m-d'); ?>' class='date'><?php echo get_the_date(); ?></time>
                    <h2 class="h2"><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h2>
                    <?php the_excerpt(); ?>
                    <a href='<?php the_permalink(); ?>' class='btn'>Read</a>
                </div>
            </div>
        <?php wp_reset_postdata(); endif; ?>

        <?php
            $queryPost = new WP_Query(array('post__not_in' => array($sticky), 'paged' => $paged));
            if( $queryPost->have_posts() ):
        ?>
            <?php while ( $queryPost->have_posts() ) : $queryPost->the_post(); ?>
                <div class='post'>
                    <div class='img'>
                        <?php if( has_post_thumbnail() ){ the_post_thumbnail(); } ?>
                    </div>
					<div class='txt'>
                        <time datetime='<?php echo get_the_date('Y-m-d'); ?>' class='date'><?php echo get_the_date(); ?></time>
                        <h2 class="h6"><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h2>
                        <?php the_excerpt(); ?>
                        <a href='<?php the_permalink(); ?>' class='btn'>Read</a>
                    </div>
                </div>
            <?php endwhile; ?>

            <div class='container pagination'>
                <?php echo paginate_links( array( 'prev_text' => '', 'next_text'  => '' ) ); ?>
            </div>
        <?php endif; ?>
	
	<?php else : ?>
				
		<p><?php _e('No posts yet'); ?></p>

	<?php endif; ?>

</div>

<?php get_footer(); ?>