<?php
/*
Template Name: Portfolio
*/

get_header(); ?>

    <?php if ( have_posts() ) : the_post(); ?>

        <section class='content-header-transparent' id='ajaxDisappear'>
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
                    <ul class='dropdown' data-filter='investment'>
                        <li data-investment='all' class='actif'>All investments</li>
                        <li data-investment='present'>Present</li>
                        <li data-investment='past'>Past</li>
                    </ul>
                </div><div class='col-2'>
                    <ul class='dropdown' data-filter='field'>
                        <li data-field='all' class='actif'>All fields of activity</li>
                        <?php
                            $fields = get_terms(array('taxonomy' => 'field'));
                            foreach($fields as $field){
                                echo '<li data-field="'.$field->slug.'">'.$field->name.'</li>';
                            }
                        ?>
                    </ul>
                </div><div class='col-2'>
                    <ul class='dropdown' data-filter='footprint'>
                        <li data-footprint='all' class='actif'>Global footprint</li>
                        <?php
                            $footprints = get_terms(array('taxonomy' => 'footprint'));
                            foreach($footprints as $footprint){
                                echo '<li data-footprint="'.$footprint->slug.'">'.$footprint->name.'</li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <main role='main' id='main'>
            <section class='content-main' id='mainContent'>
                <?php
                    $startups = new WP_Query(array('post_type' => 'startup', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC'));
                    if($startups->have_posts()):
                ?>
                    <div class='portfolio-list' id='portfolio'>
                        <div class='container'>
                            <ul class='grid'>
                                <?php while($startups->have_posts()): $startups->the_post(); ?>
                                    <?php
                                        $fields = get_the_terms($post, 'field');
                                        $fieldList = '';
                                        if($fields){
                                            foreach($fields as $field){
                                                $fieldList .= $field->slug.',';
                                            }
                                        }

                                        $footprints = get_the_terms($post, 'footprint');
                                        $footprintList = '';
                                        if($footprints){
                                            foreach($footprints as $footprint){
                                                $footprintList .= $footprint->slug.',';
                                            }
                                        }
                                    ?>
                                    <?php if(get_field('investment') !== 'past'){ ?><li class='col-2'>
                                        <a href='<?php the_permalink(); ?>' class='ajax-load off' data-investment='<?php the_field('investment') ?>' data-field='<?php echo $fieldList; ?>' data-footprint='<?php echo $footprintList; ?>'>
                                            <?php if( has_post_thumbnail() ){
                                                echo alven_get_svg(get_post_thumbnail_id());
                                            } ?>
                                        </a>
                                    </li><?php } else{ ?><li class='col-2 transfered'>
                                        <a href='<?php the_permalink(); ?>' class='ajax-load off' data-investment='<?php the_field('investment') ?>' data-field='<?php echo $fieldList; ?>' data-footprint='<?php echo $footprintList; ?>'>
                                            <span class='content-transfered'>
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
                        <a href='mailto:contact@alvencapital.com?subject=[Alven Capital Website] pitch&body=Please tell us about your startup. %0AYou can join a lightweight presentation'>
                            <span>
                                Could this be you&nbsp;?
                                <span class='btn-invert'>Send your pitch</span>
                            </span>
                        </a>
                    </div>
                    <div id='contact'>
                    </div>
                </div>
            </section>
        </main>

    <?php else : ?>

        <div class='content-header' id='contentHeader'>
            <div class='container'>
                <h1>404</h1>
            </div>
        </div>

        <main role='main' id='main'>
            <div class='content-main' id='mainContent'>
                <div class='container'>

                    <h2>Page not found</h2>

                </div>
            </div>
        </main>

    <?php endif; ?>

<?php get_footer(); ?>
