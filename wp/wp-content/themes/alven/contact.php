<?php
/*
Template Name: Contact
*/

get_header(); ?>

    <?php if ( have_posts() ) : the_post(); ?>

        <section class='content-header-transparent'>
            <h2 class='section-title'><?php the_title(); ?></h2>
            <strong class='subtitle'><?php the_field('subtitle'); ?></strong>
        </section>

        <main role='main' id='main'>
            <article class='content-main theme-gold' id='mainContent'>
                <div class='container'>
                    <div class='container-small'>
                        <div class='grid wrapper-interactive-blocks'>
                            <div class='col-4 align-right interactive-block'>
                                <h3><?php the_field('pitchTitle'); ?></h3>
                                <?php the_field('pitchText'); ?>
                                <a href='mailto:contact@alvencapital.com?subject=[Alven Capital Website] pitch&body=Please tell us about your startup. %0AYou can join a lightweight presentation' class='btn btn-left'>Send your pitch</a>
                            </div><!--
                            --><div class='col-4 interactive-block'>
                                <h3><?php the_field('generalTitle'); ?></h3>
                                <?php the_field('generalText'); ?>
                                <a href='mailto:contact@alvencapital.com?subject=[Alven Capital Website] general question&body=Please tell us what you would like to know. %0AWe&#39;ll read it carefully, and answer you with pleasure' class='btn'>General questions</a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
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
