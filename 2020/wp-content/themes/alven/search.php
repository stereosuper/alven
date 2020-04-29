<?php get_header(); ?>

<div class='title-wrapper'>
	<div class='container'>
        <?php
            global $wp_query;
	        $results = $wp_query->found_posts;
            $results = $results > 1 ? $results . ' results' : $results . ' result';
        ?>
        <h1>Search</h1>
		<p><?php echo __('The search for') . ' "' . get_search_query() .'" ' . __('returned ') . $results; ?></p>
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

		<?php while ( have_posts() ) : the_post(); ?>
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

    <?php else: ?>

        <p>Sorry, no results matching your search!</p>

    <?php endif; ?>

</div>

<?php get_footer(); ?>