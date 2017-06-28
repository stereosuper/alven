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
                        <span><?php the_field('titleHeaderMag'); ?></span>
                        <a href='<?php echo get_permalink( get_option('page_for_posts' ) ); ?>' class='btn-arrow'>Magazine</a>
                    </li><li>
                        <span><?php the_field('titleHeaderPortfolio'); ?></span>
                        <a href='<?php echo get_permalink(PORTFOLIO_ID); ?>' class='btn-arrow'>Portfolio</a>
                    </li><li>
                        <span><?php the_field('titleHeaderTeam'); ?></span>
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
                <div class='wrapper-video' style='opacity:<?php the_field('videoOpacity'); ?>'>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1084.09 1278.32">
                        <title>filet-header@1x</title>
                        <line x1="465.62" y1="0.17" x2="0.47" y2="1278.15" fill="none"/>
                        <line x1="465.62" y1="0.17" x2="0.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="471.62" y1="0.17" x2="6.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="477.62" y1="0.17" x2="12.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="483.62" y1="0.17" x2="18.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="489.62" y1="0.17" x2="24.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="495.62" y1="0.17" x2="30.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="501.62" y1="0.17" x2="36.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="507.62" y1="0.17" x2="42.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="513.62" y1="0.17" x2="48.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="519.62" y1="0.17" x2="54.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="525.62" y1="0.17" x2="60.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="531.62" y1="0.17" x2="66.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="537.62" y1="0.17" x2="72.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="543.62" y1="0.17" x2="78.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="549.62" y1="0.17" x2="84.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="555.62" y1="0.17" x2="90.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="561.62" y1="0.17" x2="96.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="567.62" y1="0.17" x2="102.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="573.62" y1="0.17" x2="108.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="579.62" y1="0.17" x2="114.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="585.62" y1="0.17" x2="120.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="591.62" y1="0.17" x2="126.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="597.62" y1="0.17" x2="132.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="603.62" y1="0.17" x2="138.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="609.62" y1="0.17" x2="144.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="615.62" y1="0.17" x2="150.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="621.62" y1="0.17" x2="156.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="627.62" y1="0.17" x2="162.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="633.62" y1="0.17" x2="168.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="639.62" y1="0.17" x2="174.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="645.62" y1="0.17" x2="180.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="651.62" y1="0.17" x2="186.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="657.62" y1="0.17" x2="192.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="663.62" y1="0.17" x2="198.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="669.62" y1="0.17" x2="204.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="675.62" y1="0.17" x2="210.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="681.62" y1="0.17" x2="216.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="687.62" y1="0.17" x2="222.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="693.62" y1="0.17" x2="228.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="699.62" y1="0.17" x2="234.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="705.62" y1="0.17" x2="240.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="711.62" y1="0.17" x2="246.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="717.62" y1="0.17" x2="252.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="723.62" y1="0.17" x2="258.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="729.62" y1="0.17" x2="264.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="735.62" y1="0.17" x2="270.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="741.62" y1="0.17" x2="276.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="747.62" y1="0.17" x2="282.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="753.62" y1="0.17" x2="288.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="759.62" y1="0.17" x2="294.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="765.62" y1="0.17" x2="300.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="771.62" y1="0.17" x2="306.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="777.62" y1="0.17" x2="312.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="783.62" y1="0.17" x2="318.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="789.62" y1="0.17" x2="324.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="795.62" y1="0.17" x2="330.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="801.62" y1="0.17" x2="336.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="807.62" y1="0.17" x2="342.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="813.62" y1="0.17" x2="348.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="819.62" y1="0.17" x2="354.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="825.62" y1="0.17" x2="360.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="831.62" y1="0.17" x2="366.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="837.62" y1="0.17" x2="372.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="843.62" y1="0.17" x2="378.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="849.62" y1="0.17" x2="384.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="855.62" y1="0.17" x2="390.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="861.62" y1="0.17" x2="396.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="867.62" y1="0.17" x2="402.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="873.62" y1="0.17" x2="408.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="879.62" y1="0.17" x2="414.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="885.62" y1="0.17" x2="420.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="891.62" y1="0.17" x2="426.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="897.62" y1="0.17" x2="432.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="903.62" y1="0.17" x2="438.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="909.62" y1="0.17" x2="444.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="915.62" y1="0.17" x2="450.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="921.62" y1="0.17" x2="456.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="927.62" y1="0.17" x2="462.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="933.62" y1="0.17" x2="468.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="939.62" y1="0.17" x2="474.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="945.62" y1="0.17" x2="480.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="951.62" y1="0.17" x2="486.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="957.62" y1="0.17" x2="492.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="963.62" y1="0.17" x2="498.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="969.62" y1="0.17" x2="504.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="975.62" y1="0.17" x2="510.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="981.62" y1="0.17" x2="516.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="987.62" y1="0.17" x2="522.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="993.62" y1="0.17" x2="528.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="999.62" y1="0.17" x2="534.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="1005.62" y1="0.17" x2="540.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="1011.62" y1="0.17" x2="546.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="1017.62" y1="0.17" x2="552.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="1023.62" y1="0.17" x2="558.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="1029.62" y1="0.17" x2="564.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="1035.62" y1="0.17" x2="570.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="1041.62" y1="0.17" x2="576.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="1047.62" y1="0.17" x2="582.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="1053.62" y1="0.17" x2="588.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="1059.62" y1="0.17" x2="594.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="1065.62" y1="0.17" x2="600.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="1071.62" y1="0.17" x2="606.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="1077.62" y1="0.17" x2="612.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                        <line x1="1083.62" y1="0.17" x2="618.47" y2="1278.15" fill="none" stroke="#fde98f" stroke-miterlimit="10"/>
                    </svg>
                    <video class='video' poster='<?php echo wp_get_attachment_url(get_field('videoImg')); ?>' autoplay muted loop>
                        <source src='<?php the_field('video'); ?>' type='video/mp4'>
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

                    <div class='newsletter'>
                        <div class='container'>
                            <div class='grid'>
                                <div class='col-6 newsletter-title'>
                                    <h3>
                                        <?php the_field('newsletterTitle'); ?>
                                    </h3><p>
                                        <?php the_field('newsletterText'); ?>
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
                    <?php endif; setcookie('alv-portfolio', serialize($portfolioIds), time()+3600); wp_reset_query(); ?>

                    <div class='container align-center'>
                        <div id='ctaPortfolio'>
                            <a href='#contact-us'>
                                <span>
                                    Could this be you&nbsp;?
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
