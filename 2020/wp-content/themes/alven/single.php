<?php get_header(); ?>

<?php if ( have_posts() ) : the_post(); ?>

	<?php
        $hasImg = has_post_thumbnail();
        
        if( $hasImg ){
            $imgUrl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0];
        }
    ?>

    <div class='title-wrapper <?php if($hasImg) echo "has-img"; ?>' style='background-image:url(<?php echo $imgUrl; ?>);'>
        <div class='container'>
            <h1><?php single_post_title(); ?></h1>
        </div>
    </div>

    <div class='container'>

        <div class='content'>

            <p class="meta">
                <time datetime='<?php echo get_the_date('Y-m-d'); ?>' class='date'><?php echo get_the_date(); ?></time>
                <?php
                    $categories = get_the_category();
                    $count = 0;
                    if($categories) : 
                        foreach($categories as $category):
                            if($count > 0) echo ', ';
                            echo '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '?cat=' . $category->slug . '">' . $category->name . '</a>';
                            $count ++;
                        endforeach;
                    endif;
                ?>
            </p>

            <h2 class='h2'><?php the_excerpt(); ?></h2>

            <div class='post-wrapper'>
                <article class='wysiwyg post-content'>
                    <?php the_content(); ?>

                    <hr>

                    <?php if(get_field('medium')){ ?>
                        <p class='post-medium'><a href='<?php the_field('medium'); ?>' target='_blank'>Comment on Medium</a></p>
                    <?php } ?>

                    <div class='secondary'>
                        <span class='title-small'>Share</span>
                        <ul class='share'>
                            <li>
                                <a href='http://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>&via=alvencap' class='icon-twitter' rel='nofollow' target='_blank'>
                                    <svg class="icon"><use xlink:href="#icon-twitter"></use></svg>    
                                </a>
                            </li>
                            <li>
                                <a href='http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>' class='icon-linkedin' rel='nofollow' target='_blank'>
                                    <svg class="icon"><use xlink:href="#icon-linkedin"></use></svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </article>
                
                <?php $relatedPosts = alven_related_posts($post->ID); if($relatedPosts){ ?>
                    <aside class='post-sidebar'>
                        <span class='title-small'>Related articles</span>
                        <ul>
                            <?php foreach($relatedPosts as $post){ setup_postdata($post); ?>
                                <li>
                                    <?php if(has_post_thumbnail()){ ?>
                                        <div class='img'>
                                            <a href='<?php the_permalink(); ?>'>
                                                <?php the_post_thumbnail('medium', array('class' => 'no-scroll')); ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <time datetime='<?php echo get_the_date('Y-m-d'); ?>' class="date"><?php echo get_the_date(); ?></time>
                                    <h4 class='h6'><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h4>
                                    <?php the_excerpt(); ?>
                                    <a href='<?php the_permalink(); ?>' class='btn'>Read</a>
                                </li>
                            <?php } wp_reset_postdata(); ?>
                        </ul>
                    </aside>
                <?php } ?>
            </div>

        </div>

    </div>

    <?php
        $lastPosts = new WP_Query(array(
            'post__not_in' => array($post->ID),
            'posts_per_page'=> 3,
            'ignore_sticky_posts' => 1
        ));
        if($lastPosts->have_posts()):
    ?>
        <section class='read-also-posts'>
            <div class='container'>
                <?php while($lastPosts->have_posts()): $lastPosts->the_post(); ?>
                    <div>
                        <time datetime='<?php echo get_the_date('Y-m-d'); ?>' class="date"><?php echo get_the_date(); ?></time>
                        <h4 class='h6'><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h4>
                        <?php the_excerpt(); ?>
                        <a href='<?php the_permalink(); ?>' class='btn'>Read</a>
                    </div>
                <?php endwhile; wp_reset_query(); ?>
            </div>
        </section>
    <?php endif; ?>

<?php endif; ?>

<?php get_footer(); ?>
