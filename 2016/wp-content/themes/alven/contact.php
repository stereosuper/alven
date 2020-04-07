<?php
/*
Template Name: Contact
*/

require_once('includes/form-contact.php');

get_header(); ?>

    <?php if ( have_posts() ) : the_post(); ?>

        <section class='content-header-transparent'>
            <h2 class='section-title'><?php the_title(); ?></h2>
            <strong class='subtitle'><?php the_field('subtitle'); ?></strong>
            <div class='container'>
                <div class='section-header'><?php the_content(); ?></div>
            </div>
        </section>

        <main role='main' id='main'>
            <div class='content-main' id='mainContent'>
                <?php require_once('includes/contact.php'); ?>
            </div>
        </main>

    <?php else : ?>

        <div class='content-header' id='contentHeader'>
            <div class='container'>
                <h1>404</h1>
            </div>
        </div>

        <main role='main' id='main'>
            <article class='content-main' id='mainContent'>
                <div class='container'>

                    <h2>Page not found</h2>

                </div>
            </article>
        </main>

    <?php endif; ?>

<?php get_footer(); ?>
