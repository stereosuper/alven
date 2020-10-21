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
        <?php get_search_form(); ?>
    </div>

	<?php if ( have_posts() ) : ?>

        <?php
            while ( have_posts() ) :
                the_post();
                get_template_part('includes/post');
            endwhile;
        ?>

        <div class='container pagination'>
            <?php echo paginate_links( array( 'prev_text' => '', 'next_text'  => '' ) ); ?>
        </div>

    <?php else: ?>

        <p>Sorry, no results matching your search!</p>

    <?php endif; ?>

</div>

<?php get_footer(); ?>