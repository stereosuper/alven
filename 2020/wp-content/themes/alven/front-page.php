<?php
/*
Template Name: Home
*/

require_once('includes/form-contact.php');

get_header(); ?>

    <?php if ( have_posts() ) : the_post(); ?>

        <section class="slider" id="slider">
            <div class="container">
                <?php
                    $mainStartups = get_posts(
                        array(
                            'post_type' => 'startup',
                            'posts_per_page' => 8,
                            'meta_key' => 'force_front',
                            'meta_value' => true,
                            'orderby' => 'rand'
                        )
                    );
                    foreach($mainStartups as $mainStartup){
                        $forceIds[] = $mainStartup->ID;
                    }
                    $startups = get_posts(
                        array(
                            'post_type' => 'startup',
                            'posts_per_page' => 8 - count($mainStartups),
                            'meta_key' => 'front',
                            'meta_value' => true,
                            'orderby' => 'rand',
                            'post__not_in' => $forceIds
                        )
                    );
                    $startups = array_merge($mainStartups, $startups);
                    $i = 0;
                    foreach( $startups as $startup ) :
                        $baseline = get_field('baseline', $startup->ID);
                ?>
                    <div class="slide <?php if($i == 0) echo 'on'; ?>" style="background-image:url(<?php the_field('img', $startup->ID); ?>)" data-startup="<?php echo $startup->ID; ?>">
                        <div class='slide-content container'>
                            <a href='<?php echo get_the_permalink($startup->ID); ?>'>
                                <div class='img'>
                                    <?php echo alven_get_svg(get_post_thumbnail_id($startup->ID)); ?>
                                </div>
                                <?php if( $baseline ) : ?>
                                    <p class='baseline'>
                                        <?php echo $baseline; ?>
                                    </p>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                <?php $i++; endforeach; ?>
                <div class="slider-title">
                    <div>
                        <h1 class='main-title-home'><?php the_field('title'); ?></h1>
                        <ul class='slider-nav' id='slider-nav'>
                            <?php $i = 0; foreach( $startups as $startup ) : ?>
                                <li>
                                    <button <?php if( $i == 0 ) echo 'class="on"'; ?> data-slide="<?php echo $startup->ID; ?>">
                                        <?php echo $startup->post_title; ?>
                                    </button>
                                </li>
                            <?php $i++; endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="philo">
            <div class="container">
                <div class="philo-content">
                    <h2 class='title-home'><?php the_field('philoTitle'); ?></h2>
                    <?php the_field('philoText'); ?>
                    <?php
                        $link1 = get_field('philoLink1');
                        $link2 = get_field('philoLink2');
                        $link3 = get_field('philoLink3');

                        if( $link1 || $link2 || $link3 ) :
                    ?>
                        <ul class="philo-list">
                            <?php if( $link1 ) : ?>
                                <li>
                                    <a href="<?php echo $link1['url']; ?>"><?php echo $link1['title']; ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if( $link2 ) : ?>
                                <li>
                                    <a href="<?php echo $link2['url']; ?>"><?php echo $link2['title']; ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if( $link3 ) : ?>
                                <li>
                                    <a href="<?php echo $link3['url']; ?>"><?php echo $link3['title']; ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="team-wrapper">
            <div class="container">
                <h2 class='title-home'><?php the_field('whoTitle'); ?></h2>
                <div class='team'>
                    <div class='img'>
                        <div>
                            <?php echo wp_get_attachment_image(get_field('whoImg'), 'large'); ?>
                        </div>
                    </div>
                    <div class='txt'>
                        <?php the_field('whoText'); ?>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="container">
            <h2 class='title-home'><?php the_field('title', get_option('page_for_posts' )); ?></h2>

            <?php include_once('includes/spotlight.php'); ?>

            <?php
                $queryPost = new WP_Query( array(
                    'post__not_in' => array($sticky),
                    'posts_per_page' => 3,
                    'ignore_sticky_posts' => 1
                ));
                if($queryPost->have_posts()):
            ?>
                <div class='posts home-posts'>
                    <?php while ( $queryPost->have_posts() ) : $queryPost->the_post(); ?>
                        <div>
                            <p class="meta">
                                <time datetime='<?php echo get_the_date('Y-m-d'); ?>' class='date'><?php echo get_the_date(); ?></time>
                                <?php
                                    $categories = get_the_category();
                                    $count = 0;
                                    if($categories) : 
                                        foreach($categories as $category):
                                            if($count > 0) echo ', ';
                                            echo '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '?cat=' . $category->slug . '">' . $category->name . '</a>';
                                            $count ++;
                                        endforeach;
                                    endif;
                                ?>
                            </p>
                            <h4 class="h6"><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h4>
                            <?php the_excerpt(); ?>
                            <a href='<?php the_permalink(); ?>' class='btn'>Read</a>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="home-posts-link">
                    <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="link">See all</a>
                </div>
            <?php endif; wp_reset_query(); ?>
        </section>

        <section class="contact-wrapper">
            <div class="container">
                <h2 class='title-home'><?php echo get_the_title(CONTACT_ID); ?></h2>
                <p class='subtitle'><?php the_field('contactSubtitle', CONTACT_ID); ?></p>
                <?php require_once('includes/contact.php'); ?>
            </div>
        </section>

    <?php endif; ?>

<?php get_footer(); ?>
