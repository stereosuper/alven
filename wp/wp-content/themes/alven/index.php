<?php get_header(); ?>

    <?php $post = get_page(get_option('page_for_posts')); setup_postdata($post); ?>
        <?php if ( have_posts() ) : ?>
            <section class='content-header-transparent'>
                <h2 class='section-title'><?php the_field('title'); ?></h2>
                <strong class='subtitle'><?php the_field('subtitle'); ?></strong>
                <div class='container'>
                    <div class='section-header'>
                        <p><?php the_field('text'); ?></p>
                    </div>
                    <div class='container-small filters'>
                        <span class='title-small'>Choose your thema</span>
                        <ul class='filters-cat'>
                            <li <?php if(intval(get_option( 'page_for_posts' )) === get_queried_object()->ID) echo "class='current-cat'"; ?>>
                                <a href='<?php echo get_permalink(get_option( 'page_for_posts' )); ?>'>All</a>
                            </li>
                            <?php wp_list_categories(array('title_li' => '', 'current_category' => get_query_var('cat'))); ?>
                        </ul>
                        <span class='title-small'>or</span>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php wp_reset_postdata(); ?>


    <?php if ( have_posts() ) : ?>

        <main role='main' id='main'>
            <div class='content-main no-border' id='mainContent'>

                <?php
                    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

                    $stickies = array_reverse(get_option( 'sticky_posts' ));
                    $sticky = array();
                    if($stickies && $paged === 1):
                        $sticky = $stickies[0];
                        $post = $sticky;
                        setup_postdata($post);
                ?>
                    <div class='main-spotlight-post'>
                        <div class='container'>
                            <div class='img col-5'>
                                <?php the_post_thumbnail(); ?>
                            </div><div class='txt col-5'>
                                <h3><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h3>
                                <div class='post-meta-spotlight'>
                                    <?php the_category( ', ' ); ?> -
                                    <time datetime='<?php echo get_the_date('Y-m-d'); ?>'><?php echo get_the_date(); ?></time>
                                </div>
                                <?php the_excerpt(); ?>
                                <a href='<?php the_permalink(); ?>' class='btn-arrow'>Read</a>
                            </div>
                        </div>
                    </div>
                <?php wp_reset_postdata(); endif; ?>

                <?php
                    $queryPost = new WP_Query(array('post__not_in' => array($sticky), 'paged' => $paged));
                    if($queryPost->have_posts()):
                ?>
                    <?php while ( $queryPost->have_posts() ) : $queryPost->the_post(); ?>
                        <div class='post'>
                            <div class='container'>
                                <div class='grid'>
                                    <?php $specialCat = in_array(get_the_category()[0]->term_id, $specialCats); ?>
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
                                                the_post_thumbnail();
                                            }
                                        ?>
                                    </div><div class='txt col-8'>
                                        <h3><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h3>
                                        <div class='post-meta'>
                                            <?php the_category( ', ' ); ?> -
                                            <time datetime='<?php echo get_the_date('Y-m-d'); ?>'><?php echo get_the_date(); ?></time>
                                        </div>
                                        <?php the_excerpt(); ?>
                                        <a href='<?php the_permalink(); ?>' class='btn-arrow'>Read</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>

                    <div class='container pagination'>
                        <?php echo paginate_links( array( 'prev_text' => '', 'next_text'  => '' ) ); ?>
                    </div>
                <?php endif; ?>

            </div>
        </main>

    <?php else : ?>

        <main role='main' id='main'>
            <div class='content-main' id='mainContent'>
                <div class='container'>

                    <h2>No posts yet</h2>

                </div>
            </div>
        </main>

    <?php endif; ?>

<?php get_footer(); ?>

