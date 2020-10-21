<?php get_header(); ?>

<div class='title-wrapper'>
	<div class='container'>
		<h1><?php single_post_title(); ?></h1>
	</div>
</div>

<div class='container'>

    <div class="form-search-wrapper blog-search">
        <div class="blog-filters">
            <p>Categories:</p>
            <?php
                $cat = isset($_GET['cat']) ? $_GET['cat'] : '';
                $categories = get_categories();
                if($categories) : 
                    echo '<ul>';
                    $class = empty($cat) ? 'on' : '';
                    echo '<li><a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '" class="' . $class . '">All</a></li>';
                    foreach($categories as $category):
                        $class = $category->slug === $cat ? 'on' : '';
                        echo '<li><a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '?cat=' . $category->slug . '" class="' . $class . '">' . $category->name . '</a></li>';
                    endforeach;
                    echo '</ul>';
                endif;
            ?>
        </div>

        <?php get_search_form(); ?>
    </div>

    <?php 
    
        if ( have_posts() ) : 

            if(($paged == 0 || $paged == 1) && empty($cat)){
                include_once('includes/spotlight.php');
            }else{
                $sticky = '';
            }

            $queryPost = new WP_Query(array('post__not_in' => array($sticky), 'paged' => $paged, 'category_name' => $cat));
            
            if( $queryPost->have_posts() ):
                while ( $queryPost->have_posts() ) :
                    $queryPost->the_post();
                    get_template_part('includes/post');
                endwhile;
            ?>

                <div class='container pagination'>
                    <?php echo paginate_links( array( 'prev_text' => '', 'next_text'  => '', 'total' => $queryPost->max_num_pages ) ); ?>
                </div>
            <?php endif; ?>
	
	<?php else : ?>
				
		<p><?php _e('No posts yet'); ?></p>

	<?php endif; ?>

</div>

<?php get_footer(); ?>