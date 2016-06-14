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
                            </article><?php
                            function getRelatedPosts($currentId){
                                $relatedPosts = array();
                                $countPosts = 0;
                                $notInIds = array($currentId);

                                $tags = wp_get_post_tags($currentId);
                                if($tags){
                                    $tagIds = array();
                                    foreach($tags as $tag){
                                        $tagIds[] = $tag->term_id;
                                    }

                                    $relatedPosts = get_posts( array(
                                        'post_type' => 'post',
                                        'tag__in' => $tagIds,
                                        'post__not_in' => $notInIds,
                                        'posts_per_page'=> 2
                                    ) );
                                    $countPosts = count($relatedPosts);
                                }

                                if($countPosts < 2){
                                    foreach($relatedPosts as $related){
                                        $notInIds[] = $related->ID;
                                    }

                                    $cats = get_the_category($currentId)[0];
                                    if($cats){
                                        $catsPosts = get_posts( array(
                                            'post_type' => 'post',
                                            'tax_query' => array( array(
                                                'taxonomy' => 'category',
                                                'field' => 'slug',
                                                'terms' => $cats->slug
                                            ) ),
                                            'post__not_in' => $notInIds,
                                            'posts_per_page' => 2 - $countPosts
                                        ) );

                                        if(count($catsPosts) > 0){
                                            foreach($catsPosts as $catsPost){
                                                $notInIds[] = $catsPost->ID;
                                            }
                                            $relatedPosts[] = $catsPosts[0];
                                            $countPosts = count($relatedPosts);
                                        }
                                    }

                                    if($countPosts < 2){
                                        $otherPosts = get_posts( array(
                                            'post_type' => 'post',
                                            'post__not_in' => $notInIds,
                                            'posts_per_page'=> 3 - $countPosts
                                        ) );

                                        if(count($otherPosts) > 0){
                                            foreach($otherPosts as $prev){
                                                $notInIds[] = $prev->ID;
                                            }
                                            $relatedPosts[] = $otherPosts[0];
                                        }
                                    }
                                }

                                return $relatedPosts;
                            }

                            $relatedPosts = getRelatedPosts($post->ID);
                            if($relatedPosts){ ?><aside class='col-2 post-sidebar' id='postSidebar'>
                                <span class='title-small'>Related articles</span>
                                <ul>
                                <?php foreach($relatedPosts as $post){ setup_postdata($post); ?>
                                    <li>
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
                    'posts_per_page'=> 3
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
