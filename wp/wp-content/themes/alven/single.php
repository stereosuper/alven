<?php get_header(); ?>

	<?php if ( have_posts() ) : the_post(); ?>

        <?php
            $hasImg = false;
            if(has_post_thumbnail()){
                $hasImg = !$hasImg;
                $imgUrl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0];
            }
        ?>

        <div class='content-header <?php if($hasImg){ echo 'has-img'; } ?>' id='contentHeader'>
            <div class='container'>
                <h1><?php the_title(); ?></h1>
            </div>
            <?php if($hasImg){ ?>
                <div class='img' style='background-image:url(<?php echo $imgUrl; ?>)'>
                    <?php the_post_thumbnail(); ?>
                </div>
            <?php } ?>
        </div>

        <main role='main' id='main'>
            <article class='content-main' id='mainContent'>
                <div class='container'>
                    <aside class='post-meta-header'>
                        <div>
                            <?php the_category( ', ' ); ?> -
                            <time datetime='<?php echo get_the_date('Y-m-d'); ?>'><?php echo get_the_date(); ?></time>
                        </div>
                        <div class='share'>
                            <span>Share</span>
                            <ul>
                                <li>
                                    <a href='#' class='icon-linkedin' rel='nofollow' target='_blank'>Linkedin</a>
                                </li><li>
                                    <a href='#' class='icon-twitter' rel='nofollow' target='_blank'>Twitter</a>
                                </li><?php if(get_field('medium')){ ?><li>
                                    <a href='<?php the_field('medium'); ?>' class='icon-medium' target='_blank'>Read this post on Medium</a>
                                </li><?php } ?>
                            </ul>
                            <div class='corner'></div>
                        </div>
                    </aside>

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
