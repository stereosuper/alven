<?php
if ( have_posts() ) : the_post();

    $current_url = full_url($_SERVER);
    $redirect_url = alven_get_startup_permalink($post);
    if ($current_url != $redirect_url) {
        wp_redirect($redirect_url);
        return;
    }

endif;

get_header();
?>

    <?php if ( have_posts() ) : the_post(); ?>

        <?php get_template_part('ajax/single-startup'); ?>

    <?php endif; ?>

<?php get_footer(); ?>
