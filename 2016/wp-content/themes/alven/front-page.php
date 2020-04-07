<?php
/*
Template Name: Home
*/

require_once('includes/form-contact.php');

// we get the cookie that contains the ids of the startups displayed last time, if it exists
$portfolioCookie = isset($_COOKIE['alv-portfolio']) ? unserialize($_COOKIE['alv-portfolio']) : false;

get_header(); ?>

    <?php if ( have_posts() ) : the_post(); ?>

        <div class='content-header has-img has-video' id='contentHeader'>
            <div class='container'>
                <h1><?php the_field('title'); ?></h1><ul class='menu-home'>
                    <li>
                        <a href='<?php echo get_permalink( get_option('page_for_posts' ) ); ?>' class='btn-arrow'><span class='txt-big'><?php the_field('titleHeaderMag'); ?></span></a>
                    </li><li>
                        <a href='<?php echo get_permalink(PORTFOLIO_ID); ?>' class='btn-arrow'><span class='txt-big'><?php the_field('titleHeaderPortfolio'); ?></span></a>
                    </li><li>
                        <a href='<?php echo home_url('#who-we-are'); ?>' class='btn-arrow'><span class='txt-big'><?php the_field('titleHeaderTeam'); ?></span></a>
                    </li><li>
                        <a href='<?php the_field('urlPageCareer'); ?>' class='btn-arrow'><span class='txt-big'><?php the_field('titleHeaderCareers'); ?></span><span class='txt-small'><?php _e('Join the Alven Family','alven'); ?></span></a>
                    </li>
                </ul>
            </div>
            <?php if(get_field('videoImg')){ ?>
                <div class='img' style='background-image:url(<?php echo wp_get_attachment_url(get_field('videoImg')); ?>);'>
                    <?php echo wp_get_attachment_image(get_field('videoImg')); ?>
                </div>
            <?php } ?>
            <?php if(get_field('video')){ ?>
                <div class='wrapper-video' style='opacity:<?php the_field('videoOpacity'); ?>'>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1084.09 1278.32" preserveAspectRatio="xMaxYMin slice">
                        <path fill="none" d="M465.62.17L.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M465.62.17L.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M471.62.17L6.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M477.62.17L12.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M483.62.17L18.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M489.62.17L24.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M495.62.17L30.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M501.62.17L36.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M507.62.17L42.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M513.62.17L48.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M519.62.17L54.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M525.62.17L60.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M531.62.17L66.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M537.62.17L72.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M543.62.17L78.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M549.62.17L84.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M555.62.17L90.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M561.62.17L96.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M567.62.17L102.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M573.62.17L108.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M579.62.17L114.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M585.62.17L120.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M591.62.17L126.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M597.62.17L132.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M603.62.17L138.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M609.62.17L144.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M615.62.17L150.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M621.62.17L156.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M627.62.17L162.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M633.62.17L168.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M639.62.17L174.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M645.62.17L180.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M651.62.17L186.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M657.62.17L192.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M663.62.17L198.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M669.62.17L204.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M675.62.17L210.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M681.62.17L216.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M687.62.17L222.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M693.62.17L228.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M699.62.17L234.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M705.62.17L240.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M711.62.17L246.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M717.62.17L252.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M723.62.17L258.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M729.62.17L264.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M735.62.17L270.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M741.62.17L276.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M747.62.17L282.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M753.62.17L288.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M759.62.17L294.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M765.62.17L300.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M771.62.17L306.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M777.62.17L312.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M783.62.17L318.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M789.62.17L324.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M795.62.17L330.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M801.62.17L336.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M807.62.17L342.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M813.62.17L348.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M819.62.17L354.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M825.62.17L360.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M831.62.17L366.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M837.62.17L372.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M843.62.17L378.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M849.62.17L384.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M855.62.17L390.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M861.62.17L396.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M867.62.17L402.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M873.62.17L408.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M879.62.17L414.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M885.62.17L420.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M891.62.17L426.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M897.62.17L432.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M903.62.17L438.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M909.62.17L444.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M915.62.17L450.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M921.62.17L456.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M927.62.17L462.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M933.62.17L468.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M939.62.17L474.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M945.62.17L480.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M951.62.17L486.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M957.62.17L492.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M963.62.17L498.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M969.62.17L504.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M975.62.17L510.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M981.62.17L516.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M987.62.17L522.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M993.62.17L528.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M999.62.17L534.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M1005.62.17L540.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M1011.62.17L546.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M1017.62.17L552.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M1023.62.17L558.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M1029.62.17L564.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M1035.62.17L570.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M1041.62.17L576.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M1047.62.17L582.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M1053.62.17L588.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M1059.62.17L594.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M1065.62.17L600.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M1071.62.17L606.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M1077.62.17L612.47 1278.15"/>
                        <path fill="none" stroke="#fde98f" stroke-miterlimit="10" d="M1083.62.17L618.47 1278.15"/>
                    </svg>
                    <video class='video' id='video' autoplay muted loop>
                        <source data-src='<?php the_field('video'); ?>' type='video/mp4'>
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

                            <a href='<?php echo get_permalink( get_option('page_for_posts' ) ); ?>' class='btn'>See all</a>
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
                            'ignore_sticky_posts' => 1,
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

                    <?php endif; wp_reset_query(); ?>
                </section>


                <section class='theme-portfolio'>
                    <h2 class='section-title'><?php the_field('portfolioTitle'); ?></h2>
                    <strong class='subtitle'><?php the_field('portfolioSubtitle'); ?></strong>
                    <?php if (get_field('portfolioText')){ ?>
                        <div class='container'>
                            <div class='section-header'>
                                <p><?php the_field('portfolioText'); ?></p>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                        // $startups = new WP_Query(array('post_type' => 'startup', 'posts_per_page' => 19, 'orderby' => 'menu_order', 'order' => 'ASC'));

                        // si le cookie existe
                        if($portfolioCookie){
                            // on remplit ce tableau avec max 19 startups aléatoires qui n'ont pas les meme id
                            $otherPortfolio = [];
                            $otherPortfolioPosts = get_posts(array(
                                'post_type' => 'startup',
                                'posts_per_page' => 19,
                                'orderby' => 'rand',
                                'meta_key' => 'displayHome',
                                'meta_value' => true,
                                'exclude' => $portfolioCookie
                            ));
                            foreach($otherPortfolioPosts as $portfolio){
                               $otherPortfolio[] = $portfolio->ID;
                            }
                            // si on a récupéré moins de 19 startups, on complete avec des startups aléatoires dont les ids ne sont
                            // pas dans le tableau précédent (et qui doivent donc etre présente dans le cookie)
                            $countCompletePortfolio = 19 - count($otherPortfolio);
                            if($countCompletePortfolio > 0){
                                $completePortfolioPosts = get_posts(array(
                                    'post_type' => 'startup',
                                    'posts_per_page' => $countCompletePortfolio,
                                    'orderby' => 'rand',
                                    'meta_key' => 'displayHome',
                                    'meta_value' => true,
                                    'exclude' => $otherPortfolio
                                ));
                                foreach($completePortfolioPosts as $portfolio){
                                   $otherPortfolio[] = $portfolio->ID;
                                }
                            }
                            $args = array('post_type' => 'startup', 'posts_per_page' => 19, 'orderby' => 'rand', 'post__in' => $otherPortfolio);
                        }else{
                            $args = array('post_type' => 'startup', 'posts_per_page' => 19, 'orderby' => 'rand', 'meta_key' => 'displayHome', 'meta_value' => true);
                        }
                        $startups = new WP_Query($args);
                        if($startups->have_posts()):
                    ?>
                        <div class='portfolio-list' id='portfolio'>
                            <div class='container'>
                                <ul class='grid'>
                                    <?php while($startups->have_posts()): $startups->the_post(); $portfolioIds[] = $post->ID; ?>
                                        <?php if(get_field('investment') !== 'past'){ ?><li class='col-2'>
                                            <a href='<?php the_permalink(); ?>' class='off'>
                                                <?php if( has_post_thumbnail() ){
                                                    echo $post->ID . alven_get_svg(get_post_thumbnail_id());
                                                } ?>
                                            </a>
                                        </li><?php }else{ ?><li class='col-2 transfered'>
                                            <a href='<?php the_permalink(); ?>' class='off'>
                                                <span class='content-transfered <?php if(!get_field('acquiredBy')){ echo 'no-by'; } ?>'>
                                                    <span><?php echo alven_get_svg(get_post_thumbnail_id()); ?></span>
                                                    <?php if(get_field('acquiredBy')){ ?>
                                                        <span>Sold to</span>
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
                                                        <span>Sold</span>
                                                    <?php } ?>
                                                </span>
                                            </a>
                                        </li><?php } ?>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; setcookie('alv-portfolio', serialize($portfolioIds), time()+3600); wp_reset_query(); ?>

                    <div class='container align-center'>
                        <div id='ctaPortfolio'>
                            <a href='#contact-us'>
                                <span>
                                    Could you be next?
                                    <span class='btn-invert'>Send your pitch</span>
                                </span>
                            </a>
                        </div>
                        <a href='<?php echo get_permalink(PORTFOLIO_ID); ?>' class='btn'><?php the_field('portfolioBtn'); ?></a>
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
                                    <a href='#' class='btn-arrow-only left'>Previous profile</a>
                                </div>
                                <div class='wrapper-btn-glob btn-next'>
                                    <a href='#' class='btn-arrow-only'>Next profile</a>
                                </div>
                                <ul class='team'>
                                    <?php while($team->have_posts()): $team->the_post(); ?><li class='col-2'>
                                        <a class='team-member' href='#'>
                                            <?php the_post_thumbnail('team-thumb'); ?>
                                            <span class='infos'>
                                                <span class='name'><?php the_title(); ?></span>
                                                <span class='function'><?php the_field('job'); ?></span>
                                            </span>
                                        </a>
                                        <?php //if(get_field('linkedin') || get_field('twitter')){ ?>
                                            <!--<ul class='social'>
                                                <?php //if(get_field('linkedin')){ ?><li>
                                                    <a href='<?php //the_field('linkedin'); ?>' class='icon-linkedin' target='_blank'>Linkedin</a>
                                                </li><?php //} if(get_field('twitter')){ ?><li>
                                                    <a href='<?php //the_field('twitter'); ?>' class='icon-twitter' target='_blank'>Twitter</a>
                                                </li><?php //} ?>
                                            </ul>-->
                                        <?php //} ?>
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

                <section class='contact-us' id='contact-us'>
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
