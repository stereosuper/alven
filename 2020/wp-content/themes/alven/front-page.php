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
                        <h3><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h3>
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
                            <h4><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h4>
                            <?php the_excerpt(); ?>
                            <a href='<?php the_permalink(); ?>' class='btn'>Read</a>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; wp_reset_query(); ?>
        </section>

        <section class="container">
            <h2 class='title-home'><?php the_field('whoTitle'); ?></h2>
        </section>

        <section class="container contact-wrapper">
            <h2 class='title-home'><?php echo get_the_title(CONTACT_ID); ?></h2>
            <strong class='subtitle'><?php the_field('contactSubtitle', CONTACT_ID); ?></strong>
            <?php require_once('includes/contact.php'); ?>
        </section>

    <?php endif; ?>

<?php get_footer(); ?>
