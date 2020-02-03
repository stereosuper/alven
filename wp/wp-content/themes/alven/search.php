<?php get_header(); ?>

    <section class='content-header-transparent'>
        <h2 class='section-title'>Search results</h2>
        <?php global $wp_query; $results = $wp_query->found_posts; ?>
        <?php if ( have_posts() ){ ?>
            <strong class='subtitle'>The research for "<?php the_search_query(); ?>" returned <?php if($results > 1){ echo $results . ' results'; }else{ echo '1 result'; } ?></strong>
        <?php }else{ ?>
            <strong class='subtitle'>No result found for "<?php the_search_query(); ?>"</strong>
        <?php } ?>
        <div class='container'>
            <div class='container-small filters'>
                <form role='search' method='get' action='<?php echo home_url('/'); ?>' class='form-search'>
                    <input type='search' name='s' value='<?php the_search_query(); ?>' id='search'>
                    <label for='search'>type some keywords</label>
                    <button type='submit' class='btn-search btn-no-text'><span class='visually-hidden'>Explore</span></button>
                </form>
            </div>
        </div>
    </section>


    <?php if ( have_posts() ) : ?>

        <main role='main' id='main'>
            <div class='content-main no-border' id='mainContent'>

                <?php while ( have_posts() ) : the_post(); ?><div class='post'>
                        <div class='container'>
                            <div class='grid'>
                                <?php $specialCat = get_the_category() ? in_array(get_the_category()[0]->term_id, $specialCats) : false; ?>
                                <div class='img col-4'>
                                    <?php
                                        if($specialCat){ ?>
                                            <div class='special-cat'>
                                                <?php if(get_the_category()[0]->slug === 'jobs'){ ?>
                                                    <div class='cat-job'>Job</div>
                                                <?php }else if(get_the_category()[0]->slug === 'definitions'){ ?>
                                                    <div class='cat-def'>Definition</div>
                                                <?php }else if(get_the_category()[0]->slug === 'books'){ ?>
                                                    <div class='cat-book'></div>
                                                <?php }else{ ?>
                                                    <div class='calendar'>
                                                        <span class='month'><?php echo get_the_date('M'); ?></span><span class='day'><?php echo get_the_date('j'); ?><sup><?php echo get_the_date('S'); ?></sup></span>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php }else{
                                            if(has_post_thumbnail()){
                                                the_post_thumbnail();
                                            }else{ ?>
                                                <div class='special-cat'><div class='cat-default'><div></div></div></div>
                                            <?php }
                                        }
                                    ?>
                                </div><div class='txt col-8'>
                                    <h3><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h3>
                                    <div class='post-meta'>
                                        <?php the_category( ', ' ); if(get_the_category()) echo ' -'; ?>
                                        <time datetime='<?php echo get_the_date('Y-m-d'); ?>'><?php echo get_the_date(); ?></time>
                                    </div>
                                    <?php the_excerpt(); ?>
                                    <a href='<?php the_permalink(); ?>' class='btn-arrow'>Read</a>
                                </div>
                            </div>
                        </div>
                </div><?php endwhile; ?>

                <div class='container pagination'>
                    <?php echo paginate_links( array( 'prev_text' => '', 'next_text'  => '' ) ); ?>
                </div>

            </div>
        </main>

    <?php else : ?>

        <main role='main' id='main'>
            <div class='content-main' id='mainContent'>
                <div class='container'>

                    <h2>Sorry, no posts matches your research!</h2>

                </div>
            </div>
        </main>

    <?php endif; ?>

<?php get_footer(); ?>

