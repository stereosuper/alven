<?php
/*
Template Name: Home
*/

require_once('includes/form-contact.php');

get_header(); ?>

    <?php if ( have_posts() ) : the_post(); ?>

        <div class='content-header has-img has-video' id='contentHeader'>
            <div class='container'>
                <h1><?php the_field('title'); ?></h1><ul class='menu-home'>
                    <li>
                        <span>Read us :</span>
                        <a href='<?php echo get_permalink( get_option('page_for_posts' ) ); ?>' class='btn-arrow'>Magazine</a>
                    </li><li>
                        <span>We fund :</span>
                        <a href='<?php echo get_permalink(PORTFOLIO_ID); ?>' class='btn-arrow'>Portfolio</a>
                    </li><li>
                        <span>Team :</span>
                        <a href='<?php echo home_url('#who-we-are'); ?>' class='btn-arrow'>Who we are</a>
                    </li>
                </ul>
            </div>
            <?php if(get_field('videoImg')){ ?>
                <div class='img' style='background-image:url(<?php echo wp_get_attachment_url(get_field('videoImg')); ?>);'>
                    <?php echo wp_get_attachment_image(get_field('videoImg')); ?>
                </div>
            <?php } ?>
            <?php if(get_field('video')){ ?>
                <div class='wrapper-video'>
                    <video class='video' poster='<?php echo wp_get_attachment_url(get_field('videoImg')); ?>' autoplay muted loop>
                        <source src='<?php the_field('video'); ?>' type='video/mp4' />
                    </video>
                </div>
            <?php } ?>
        </div>

        <main role='main' id='main'>
            <div class='content-main' id='mainContent'>

                <section class='theme-magazine'>
                    <h2 class='section-title'><?php the_field('title', get_option('page_for_posts' )); ?></h2>
                    <strong class='subtitle'><?php the_field('subtitle', get_option('page_for_posts' )); ?></strong>
                    <div class='container'>
                        <div class='section-header'>
                            <p><?php the_field('text', get_option('page_for_posts' )); ?></p>

                            <a href='<?php echo get_permalink( get_option('page_for_posts' ) ); ?>' class='btn'>Read Alven magazine</a>
                        </div>
                    </div>

                    <?php
                        $stickies = array_reverse(get_option( 'sticky_posts' ));
                        $sticky = array();
                        if($stickies):
                            $sticky = $stickies[0];
                            $post = $sticky;
                            setup_postdata($post);
                    ?>
                        <div class='main-spotlight-post'>
                            <div class='container'>
                                <div class='img col-6 img-fit'>
                                    <?php the_post_thumbnail('full', array('class' => 'no-scroll')); ?>
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
                        $queryPost = new WP_Query( array(
                            'post__not_in' => array($sticky),
                            'posts_per_page' => 3,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field'    => 'term_id',
                                    'terms'    => $specialCats,
                                    'operator' => 'NOT IN'
                                )
                            )
                        ));
                        if($queryPost->have_posts()):
                    ?>
                        <div class='content-footer read-also-posts' id='related'>
                            <div class='container'>
                                <div class='grid'>
                                    <?php while ( $queryPost->have_posts() ) : $queryPost->the_post(); ?><div class='col-4 read-also-post'>
                                        <h4><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h4>
                                        <div class='post-meta'>
                                            <?php the_category( ', ' ); ?> -
                                            <time datetime='<?php echo get_the_date('Y-m-d'); ?>'><?php echo get_the_date(); ?></time>
                                        </div>
                                        <a href='<?php the_permalink(); ?>' class='btn-arrow'>Read</a>
                                    </div><?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php
                        $spotlightPosts = new WP_Query(array(
                            'post__not_in' => array($post->ID),
                            'posts_per_page'=> 6,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field'    => 'term_id',
                                    'terms'    => $specialCats
                                ),
                            )
                        ));

                        if($spotlightPosts->have_posts()):
                    ?>

                        <section class='spotlight-posts' id='spotlightPost'>
                            <div class='container' id='spotlightDrag'>
                                <div class='grid'>
                                    <?php while($spotlightPosts->have_posts()): $spotlightPosts->the_post(); ?><div class='col-2 spotlight-post'>
                                            <div>
                                                <div class='content'>
                                                    <h4><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h4>
                                                    <?php
                                                        echo alven_cut_content(get_the_content());
                                                        $btn = get_field('readMoreLink') ? get_field('readMoreLink') : 'Read more';
                                                    ?>
                                                    <a href='<?php the_permalink(); ?>' class='btn-arrow'><?php echo $btn; ?></a>
                                                </div>
                                            </div>
                                    </div><?php endwhile; ?>
                                </div>
                            </div>
                        </section>

                    <?php endif; ?>

                    <div class='newsletter'>
                        <div class='container'>
                            <div class='grid'>
                                <div class='col-6 newsletter-title'>
                                    <h3>
                                        Get some more fresh&nbsp;news&nbsp;?
                                    </h3><!--
                                    --><p>
                                        Signup for our newsletter and be in the&nbsp;loop!
                                    </p>
                                </div><!--<form method='post' action='' class='col-5'>
                                    <fieldset>
                                        <input type='email' name='email' id='email' required>
                                        <label for='email'>Your email</label>
                                    </fieldset><button type='submit' class='btn-invert'>Signup</button>
                                </form>-->
                                <?php dynamic_sidebar( 'newsletter' ); ?>
                            </div>
                        </div>
                    </div>
                </section>


                <section class='theme-portfolio'>
                    <h2 class='section-title'><?php the_field('title', PORTFOLIO_ID); ?></h2>
                    <strong class='subtitle'><?php the_field('subtitle', PORTFOLIO_ID); ?></strong>
                    <div class='container'>
                        <div class='section-header'>
                            <p><?php the_field('text', PORTFOLIO_ID); ?></p>
                        </div>
                    </div>

                    <?php
                        $startups = new WP_Query(array('post_type' => 'startup', 'posts_per_page' => 19, 'orderby' => 'menu_order', 'order' => 'ASC'));
                        if($startups->have_posts()):
                    ?>
                        <div class='portfolio-list' id='portfolio'>
                            <div class='container'>
                                <ul class='grid'>
                                    <?php while($startups->have_posts()): $startups->the_post(); ?>
                                        <?php if(get_field('investment') !== 'past'){ ?><li class='col-2'>
                                            <a href='<?php the_permalink(); ?>' class='off'>
                                                <?php if( has_post_thumbnail() ){
                                                    echo alven_get_svg(get_post_thumbnail_id());
                                                } ?>
                                            </a>
                                        </li><?php } else{ ?><li class='col-2 transfered'>
                                            <a href='<?php the_permalink(); ?>' class='off'>
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
                    <?php endif; wp_reset_query(); ?>

                    <div class='container align-center'>
                        <div id='ctaPortfolio'>
                            <a href='mailto:contact@alvencapital.com?subject=[Alven Capital Website] pitch&body=Please tell us about your startup. %0AYou can join a lightweight presentation'>
                                <span>
                                    Could this be you&nbsp;?
                                    <span class='btn-invert'>Send your pitch</span>
                                </span>
                            </a>
                        </div>
                        <a href='<?php echo get_permalink(PORTFOLIO_ID); ?>' class='btn'>Browse all companies</a>
                    </div>
                </section>

                <section class='theme-we' id='who-we-are'>
                    <h2 class='section-title'><?php the_field('whoTitle'); ?></h2>
                    <strong class='subtitle'><?php the_field('whoSubtitle'); ?></strong>
                    <div class='container'>
                        <div class='section-header'>
                            <?php the_field('whoText'); ?>
                        </div>
                    </div>
                    <?php
                        $team = new WP_Query(array('post_type' => 'team', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC'));
                        if($team->have_posts()):
                    ?>
                        <div class='container overflow-hidden'>
                            <div class='container-small container-team'>
                                <div class='wrapper-btn-glob btn-prev'>
                                    <a href='#' class='btn-arrow-only left'>Profil précédent</a>
                                </div>
                                <div class='wrapper-btn-glob btn-next'>
                                    <a href='#' class='btn-arrow-only'>Profil suivant</a>
                                </div>
                                <ul class='team'>
                                    <?php while($team->have_posts()): $team->the_post(); ?><li class='col-2'>
                                        <a class='team-member' href='#'>
                                            <?php the_post_thumbnail('medium'); ?>
                                            <span class='infos'>
                                                <span class='name'><?php the_title(); ?></span>
                                                <span class='function'><?php the_field('job'); ?></span>
                                            </span>
                                        </a>
                                        <?php if(get_field('linkedin') || get_field('twitter')){ ?>
                                            <ul class='social'>
                                                <?php if(get_field('linkedin')){ ?><li>
                                                    <a href='<?php the_field('linkedin'); ?>' class='icon-linkedin' target='_blank'>Linkedin</a>
                                                </li><?php } if(get_field('twitter')){ ?><li>
                                                    <a href='<?php the_field('twitter'); ?>' class='icon-twitter' target='_blank'>Twitter</a>
                                                </li><?php } ?>
                                            </ul>
                                        <?php } ?>
                                        <div class='desc'>
                                            <a class='btn-cross' href='#'>Close</a>
                                            <ul class='btn-desc'>
                                                <li><a href='#' class='btn-arrow-only left'>Profil précédent</a></li>
                                                <li><a href='#' class='btn-arrow-only'>Profil suivant</a></li>
                                            </ul>
                                            <?php the_content(); ?>
                                            <?php if(get_field('linkedin') || get_field('twitter')){ ?>
                                                <ul class='social social-desc'>
                                                    <?php if(get_field('linkedin')){ ?><li>
                                                        <a href='<?php the_field('linkedin'); ?>' target='_blank'>
                                                            <span class='icon-linkedin'></span>Linkedin profile
                                                        </a>
                                                    </li><?php } if(get_field('twitter')){ ?><li>
                                                        <a href='<?php the_field('twitter'); ?>' target='_blank'>
                                                            <span class='icon-twitter'></span>Twitter profile
                                                        </a>
                                                    </li><?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </div>
                                    </li><?php endwhile; ?>
                                </ul>
                                <div class='content-desc-responsive'></div>
                            </div>
                        </div>
                    <?php endif; wp_reset_query(); ?>
                </section>

                <section class='contact-us'>
                    <h2 class='section-title'><?php echo get_the_title(CONTACT_ID); ?></h2>
                    <strong class='subtitle'><?php the_field('contactSubtitle', CONTACT_ID); ?></strong>
                    <?php require_once('includes/contact.php'); ?>
                </section>

                <section class='quotes'>
                    <?php
                        $quotes = new WP_Query(array('post_type' => 'quote', 'posts_per_page' => 3, 'orderby' => 'menu_order', 'order' => 'ASC'));
                        if($quotes->have_posts()):
                    ?>
                        <div class='container'>
                            <div class='grid'>
                                <?php while($quotes->have_posts()): $quotes->the_post(); ?><div class='col-4 quote'>
                                    <div class='img-quote'><?php the_post_thumbnail('medium', array('class' => 'no-scroll')); ?></div>
                                    <blockquote>
                                        <p><?php the_field('quote'); ?></p>
                                        <?php if(get_field('author')){ ?>
                                            <footer><?php the_field('author'); ?></footer>
                                        <?php } ?>
                                    </blockquote>
                                </div><?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; wp_reset_query(); ?>
                </section>

            </div>

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
