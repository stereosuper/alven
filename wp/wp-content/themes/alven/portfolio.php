<?php
/*
Template Name: Portfolio
*/

get_header(); ?>

    <?php if ( have_posts() ) : the_post(); ?>

        <section class='content-header-transparent'>
            <h2 class='section-title'><?php the_field('title'); ?></h2>
            <strong class='subtitle'><?php the_field('subtitle'); ?></strong>
            <div class='container'>
                <div class='section-header'>
                    <p><?php the_field('text'); ?></p>
                </div>
            </div>
        </section>

        <div class='portfolio-filters' id='portfolioFilters'>
            <div class='container'>
                <div class='col-2'>
                    <ul class='dropdown'>
                        <li>All investments</li>
                        <li><button>Present</button></li>
                        <li><button>Past</button></li>
                    </ul>
                </div><div class='col-2'>
                    <ul class='dropdown'>
                        <li>Fields of activity</li>
                        <?php
                            $fields = get_terms(array('taxonomy' => 'field'));
                            foreach($fields as $field){
                                echo '<li><button>'.$field->name.'</button></li>';
                            }
                        ?>
                    </ul>
                </div><div class='col-2'>
                    <ul class='dropdown'>
                        <li>Global footprint</li>
                        <?php
                            $footprints = get_terms(array('taxonomy' => 'footprint'));
                            foreach($footprints as $footprint){
                                echo '<li><button>'.$footprint->name.'</button></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <main role='main' id='main'>
            <article class='content-main' id='mainContent'>
                <?php
                    $startups = new WP_Query(array('post_type' => 'startup', 'posts_per_page' => -1));
                    if($startups->have_posts()):
                ?>
                    <div class='portfolio-list' id='portfolio'>
                        <div class='container'>
                            <ul class='grid'>
                                <?php while($startups->have_posts()): $startups->the_post(); ?>
                                    <?php if(get_field('investment') !== 'past'){ ?><li class='col-2'>
                                        <a href='<?php the_permalink(); ?>' class='ajax-load off'>
                                            <?php if( has_post_thumbnail() ){
                                                echo alven_get_svg(get_post_thumbnail_id());
                                            } ?>
                                        </a>
                                    </li><?php } else{ ?><li class='col-2 transfered'>
                                        <a href='<?php the_permalink(); ?>' class='ajax-load'>
                                            <span class='content-transfered captain-train-trainline'>
                                                <span><?php echo alven_get_svg(get_post_thumbnail_id()); ?></span>
                                                <span>Acquired by</span>
                                                <span><?php echo alven_get_svg(get_field('acquiredByLogo')); ?></span>
                                            </span>
                                        </a>
                                    </li><?php } ?>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
                <div class='container align-center'>
                    <div id='ctaPortfolio'>
                        <a href='#contact'>
                            <span>
                                Could this be you&nbsp;?
                                <span class='btn-invert'>Send your pitch</span>
                            </span>
                        </a>
                    </div>
                    <div id='contact'>
                    </div>
                </div>
            </article>
        </main>

    <?php else : ?>

        <div class='content-header' id='contentHeader'>
            <div class='container'>
                <h1>404</h1>
            </div>
        </div>

        <main role='main' id='main'>
            <article class='content-main' id='mainContent'>
                <div class='container'>

                    <h2>Page not found</h2>

                </div>
            </article>
        </main>

    <?php endif; ?>

<?php get_footer(); ?>
