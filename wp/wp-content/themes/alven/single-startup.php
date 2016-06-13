<?php get_header(); ?>

	<?php if ( have_posts() ) : the_post(); ?>

        <div class='content-header'>
            <div class='container'>
                <h1><?php the_title(); ?></h1>
                <?php the_post_thumbnail('full'); ?>
                <?php
                    $terms = get_the_terms( $post->ID , 'field' );
                    foreach($terms as $term){
                        echo $term->name;
                    }
                ?>
                <?php if(get_field('history')){ ?>
                    History
                    <?php the_field('history'); ?>
                <?php } ?>
                <?php if(get_field('keywords')){ ?>
                    Keywords
                    <?php the_field('keywords'); ?>
                <?php } ?>
                <?php if(get_field('website')){ $site = get_field('websiteDisplay') ? get_field('websiteDisplay') : get_field('website'); ?>
                    <a href='<?php the_field('website'); ?>' class='btn-invert' target='_blank'><?php echo $site; ?></a>
                <?php } ?>
                <?php if(get_field('appStoreLink') || get_field('googlePlayLink')){
                    if(get_field('appStoreLink')){ ?>
                        <a href='<?php the_field('appStoreLink'); ?>' target='_blank'>AppStore</a>
                    <?php }
                    if(get_field('googlePlayLink')){ ?>
                        <a href='<?php the_field('googlePlayLink'); ?>' target='_blank'>Google play</a>
                    <?php }
                } ?>
            </div>
        </div>

        <main role='main' id='main'>
            <article class='content-main'>
                <div class='container'>

                    <h2><?php the_excerpt(); ?></h2>

                    <div class='container-small'>
                        <div class='grid'>
                            <div class='col-8 content-default'>
                                <?php the_content(); ?>
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

                    <h2>Post not found</h2>

                </div>
            </article>
        </main>

	<?php endif; ?>

<?php get_footer(); ?>
