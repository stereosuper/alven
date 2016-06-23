<?php get_header(); ?>

	<?php if ( have_posts() ) : the_post(); ?>

        <?php
            $hasImg = false;
            if(has_post_thumbnail()){
                $hasImg = true;
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
            <section class='content-main' id='mainContent'>
                <div class='container'>
                    <aside class='post-meta-header'>
                        <div>
                            <?php the_category( ', ' ); ?> -
                            <time datetime='<?php echo get_the_date('Y-m-d'); ?>'><?php echo get_the_date(); ?></time>
                        </div>
                        <div class='share'>
                            <span class='title-small'>Share</span>
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
                            <article class='col-8 content-default'>
                                <?php the_content(); ?>
                            </article><?php $relatedPosts = alven_related_posts($post->ID);
                            if($relatedPosts){ ?><aside class='col-2 post-sidebar' id='postSidebar'>
                                <span class='title-small'>Related articles</span>
                                <ul>
                                <?php foreach($relatedPosts as $post){ setup_postdata($post); ?>
                                    <li class='post-small'>
                                        <?php if(has_post_thumbnail()){ ?>
                                            <div class='img'>
                                                <?php the_post_thumbnail('medium', array('class' => 'no-scroll')); ?>
                                            </div>
                                        <?php } ?>
                                        <h4><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h4>
                                        <div class='post-meta'>
                                            <?php the_category( ', ' ); ?> -
                                            <time datetime='<?php echo get_the_date('Y-m-d'); ?>'><?php echo get_the_date(); ?></time>
                                        </div>
                                        <a href='<?php the_permalink(); ?>' class='btn-arrow'>Read</a>
                                    </li><?php
                                } wp_reset_postdata(); ?>
                                </ul>
                            </aside><?php } ?>
                        </div>
                    </div>
                </div>
            </section>

            <?php

                $lastPosts = new WP_Query(array(
                    'post_type' => 'post',
                    'post__not_in' => array($post->ID),
                    'posts_per_page'=> 3,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'term_id',
                            'terms'    => $specialCats,
                            'operator' => 'NOT IN'
                        ),
                    )
                ));
                if($lastPosts->have_posts()):
            ?>
                <footer class='content-footer read-also-posts' id='related'>
                    <div class='container'>
                        <div class='grid'>
                            <?php while($lastPosts->have_posts()): $lastPosts->the_post(); ?>
                                <div class='col-4 read-also-post'>
                                    <h4><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h4>
                                    <div class='post-meta'>
                                        <?php the_category( ', ' ); ?> -
                                        <time datetime='<?php echo get_the_date('Y-m-d'); ?>'><?php echo get_the_date(); ?></time>
                                    </div>
                                    <a href='<?php the_permalink(); ?>' class='btn-arrow'>Read</a>
                                </div>
                            <?php endwhile; wp_reset_query(); ?>
                        </div>
                    </div>
                </footer>
            <?php endif; ?>
        </main>

        <?php
            $spotlightPosts = new WP_Query(array(
                'post_type' => 'post',
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
                        <?php while($spotlightPosts->have_posts()): $spotlightPosts->the_post(); ?>
                            <div class='col-2 spotlight-post'>
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
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </section>

        <?php endif; ?>

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
