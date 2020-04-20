<?php
/*
Template Name: Home
*/

require_once('includes/form-contact.php');

get_header(); ?>

    <?php if ( have_posts() ) : the_post(); ?>

        <div class='container'>
            <h1><?php the_field('title'); ?></h1>
        </div>
        
        <section class="container">
            <h2 class='title-home'><?php the_field('title', get_option('page_for_posts' )); ?></h2>

            <?php
                $stickies = array_reverse( get_option( 'sticky_posts' ) );
                $sticky = 0;
                if( $stickies ):
                    $post = $stickies[0];
                    $ticky = $post;
                    setup_postdata($post);
            ?>
                <div class='spotlight-post'>
                    <div class='img'>
                        <?php the_post_thumbnail('full', array('class' => 'no-scroll')); ?>
                    </div><div class='txt'>
                        <time datetime='<?php echo get_the_date('Y-m-d'); ?>' class='date'><?php echo get_the_date(); ?></time>
                        <h3 class="h2"><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h3>
                        <?php the_excerpt(); ?>
                        <a href='<?php the_permalink(); ?>' class='btn'>Read</a>
                    </div>
                </div>
            <?php wp_reset_postdata(); endif; ?>

            <?php
                $queryPost = new WP_Query( array(
                    'post__not_in' => array($sticky),
                    'posts_per_page' => 3,
                    'ignore_sticky_posts' => 1
                ));
                if($queryPost->have_posts()):
            ?>
                <div class='home-posts'>
                    <?php while ( $queryPost->have_posts() ) : $queryPost->the_post(); ?>
                        <div>
                            <time datetime='<?php echo get_the_date('Y-m-d'); ?>' class='date'><?php echo get_the_date(); ?></time>
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

        <section class="container team-wrapper">
            <h2 class='title-home'><?php the_field('whoTitle'); ?></h2>
            <div class='team'>
                <div class='img'>
                    <?php echo wp_get_attachment_image(get_field('whoImg'), 'large'); ?>
                </div>
                <div class='txt'>
                    <?php the_field('whoText'); ?>
                </div>
            </div>
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
