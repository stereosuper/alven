<?php

if ( have_posts() ) : the_post();

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            get_template_part('ajax/single-startup');
            return;
    }

    wp_redirect(alven_get_startup_permalink($post));

endif;

get_header();
?>

    <?php if ( have_posts() ) : the_post(); ?>

        <?php get_template_part('ajax/single-startup'); ?>

    <?php else : ?>

        <div class='content-header' id='contentHeader'>
            <div class='container'>
                <h1>404</h1>
            </div>
        </div>

        <main role='main' id='main'>
            <article class='content-main' id='mainContent'>
                <div class='container'>

                    <h2>Post not found</h2>

                </div>
            </article>
        </main>

    <?php endif; ?>

<?php get_footer(); ?>
