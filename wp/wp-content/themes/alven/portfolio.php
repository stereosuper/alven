<?php
/*
Template Name: Portfolio
*/

require_once('includes/form-contact.php');

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

        <main role='main' id='main'>
            <div class='portfolio-filters' id='portfolioFilters'>
                <div class='container'>
                    <ul class='dropdown' data-filter='investment'>
                        <li data-investment='all' class='actif'>All companies</li>
                        <li data-investment='present'><?php the_field('present', 'options'); ?></li>
                        <li data-investment='past'><?php the_field('past', 'options'); ?></li>
                    </ul>
                    <ul class='dropdown' data-filter='field'>
                        <li data-field='all' class='actif'>All fields</li>
                        <?php
                            $fields = get_terms(array('taxonomy' => 'field'));
                            foreach($fields as $field){
                                echo '<li data-field="'.$field->slug.'">'.$field->name.'</li>';
                            }
                        ?>
                    </ul>
                    <!--<ul class='dropdown' data-filter='footprint'>
                        <li data-footprint='all' class='actif'>Global footprint</li>
                        <?php
                            /*$footprints = get_terms(array('taxonomy' => 'footprint'));
                            foreach($footprints as $footprint){
                                echo '<li data-footprint="'.$footprint->slug.'">'.$footprint->name.'</li>';
                            }*/
                        ?>
                    </ul>-->
                </div>
            </div>

            <section class='content-main no-border' id='mainContent'>
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
                                            <?php
                                                if( has_post_thumbnail() ){
                                                    echo alven_get_svg(get_post_thumbnail_id());
                                                }else{ ?>
                                                    <span class='txt'><?php the_title(); ?></span>
                                                <?php }
                                            ?>
                                        </a>
                                    </li><?php } else{ ?><li class='col-2 transfered'>
                                        <a href='<?php the_permalink(); ?>' class='ajax-load off' data-investment='<?php the_field('investment') ?>' data-field='<?php echo $fieldList; ?>' data-footprint='<?php echo $footprintList; ?>'>
                                            <span class='content-transfered <?php if(!get_field('acquiredBy')){ echo 'no-by'; } ?>'>
                                                <span <?php if(!has_post_thumbnail()){ echo "class='txt-container'"; } ?>>
                                                    <?php
                                                        if(has_post_thumbnail()){
                                                            echo alven_get_svg(get_post_thumbnail_id());
                                                        }else{ ?>
                                                            <span class='txt'><?php the_title(); ?></span>
                                                        <?php }
                                                    ?>
                                                </span>
                                                <?php if(get_field('acquiredBy')){ ?>
                                                    <span>Acquired by</span>
                                                    <span <?php if(!get_field('acquiredByLogo')){ echo "class='txt-container'"; } ?>>
                                                        <?php
                                                            if(get_field('acquiredByLogo')){
                                                                echo alven_get_svg(get_field('acquiredByLogo'));
                                                            }else{ ?>
                                                                <span class='txt'><?php echo get_field('acquiredBy'); ?></span>
                                                            <?php }
                                                        ?>
                                                    </span>
                                                <?php }else{ ?>
                                                    <span>Acquired</span>
                                                <?php } ?>
                                            </span>
                                        </a>
                                    </li><?php } ?>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; wp_reset_query(); ?>
                <div class='container align-center'>
                    <div id='ctaPortfolio'>
                        <a href='#contact-us'>
                            <span>
                                Could this be you&nbsp;?
                                <span class='btn-invert'>Send your pitch</span>
                            </span>
                        </a>
                    </div>
                </div>
            </section>

            <section class='contact-us' id='contact-us'>
                <h2 class='section-title'><?php echo get_the_title(CONTACT_ID); ?></h2>
                <strong class='subtitle'><?php the_field('contactSubtitle', CONTACT_ID); ?></strong>
                <?php require_once('includes/contact.php'); ?>
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
