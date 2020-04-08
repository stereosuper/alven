<?php get_header(); ?>

<div class='container'>

	<h1><?php single_post_title(); ?></h1>

	<div class='filters'>
        <ul class='filters-cat'>
            <li <?php if(intval(get_option( 'page_for_posts' )) === get_queried_object()->ID) echo "class='current-cat'"; ?>>
                <a href='<?php echo get_permalink(get_option( 'page_for_posts' )); ?>'>All</a>
            </li>
            <?php wp_list_categories(array('title_li' => '', 'current_category' => get_query_var('cat'))); ?>
        </ul>
        <span class='title-small'>or</span>
        <form role='search' method='get' action='<?php echo home_url('/'); ?>' class='form-search'>
            <input type='search' name='s' value='<?php the_search_query(); ?>' id='search'>
            <label for='search'>type some keywords</label>
        	<button type='submit' class='btn-search btn-no-text'><span class='visually-hidden'>Explore</span></button>
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
            <div class='main-spotlight-post'>
                <div class='img'>
                    <?php the_post_thumbnail('full', array('class' => 'no-scroll')); ?>
                </div>
				<div class='txt'>
                    <h3><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h3>
                    <div class='post-meta-spotlight'>
                        <?php the_category( ', ' ); ?> -
                        <time datetime='<?php echo get_the_date('Y-m-d'); ?>'><?php echo get_the_date(); ?></time>
                    </div>
                    <?php the_excerpt(); ?>
                    <a href='<?php the_permalink(); ?>' class='btn-arrow'>Read</a>
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
                        <?php if( has_post_thumbnail() ){
                            the_post_thumbnail();
                        }else{ ?>
                            <div class='special-cat'><div class='cat-default'><div></div></div></div>
                        <?php } ?>
                    </div>
					<div class='txt'>
                        <h3><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h3>
                        <div class='post-meta'>
                            <?php the_category( ', ' ); ?> -
                            <time datetime='<?php echo get_the_date('Y-m-d'); ?>'><?php echo get_the_date(); ?></time>
                        </div>
                        <?php the_excerpt(); ?>
                        <a href='<?php the_permalink(); ?>' class='btn-arrow'>Read</a>
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