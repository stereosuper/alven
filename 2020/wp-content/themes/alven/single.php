<?php get_header(); ?>

<div class='container'>

	<?php if ( have_posts() ) : the_post(); ?>

	 	<?php
            $hasImg = false;
            if(has_post_thumbnail()){
                $hasImg = true;
                $imgUrl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0];
            }

            $related = get_field('startup');
        ?>

		<div class='content-header <?php if($hasImg){ echo 'has-img '; } the_field('titlePos'); ?>' id='contentHeader'>
            <div class='container'>
                <h1><?php the_title(); ?></h1>
            </div>
            <?php if($hasImg){ ?>
                <div class='img' style='background-image:url(<?php echo $imgUrl; ?>);background-position:<?php the_field('coverPos'); ?>'>
                    <?php the_post_thumbnail(); ?>
                </div>
            <?php } ?>
        </div>

		<aside class='post-meta-header'>
            <?php the_category( ', ' ); ?> -
            <time datetime='<?php echo get_the_date('Y-m-d'); ?>'><?php echo get_the_date(); ?></time>
    	</aside>

        <h2><?php the_excerpt(); ?></h2>

		<div class='grid'>
            <article class='wysiwyg'>
                <?php the_content(); ?>

                <hr>

                <?php if(get_field('medium')){ ?>
                    <p class='post-medium'><a href='<?php the_field('medium'); ?>' target='_blank'>Comment on Medium</a></p>
                <?php } ?>

                <div class='share'>
                    <span>Share</span>
                    <ul>
                        <li>
                            <a href='http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>' class='icon-linkedin' rel='nofollow' target='_blank'>Linkedin</a>
                        </li><li>
                            <a href='http://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>&via=alvencap' class='icon-twitter' rel='nofollow' target='_blank'>Twitter</a>
                        </li>
					</ul>
                </div>
            </article>
			
			<?php $relatedPosts = alven_related_posts($post->ID); if($relatedPosts){ ?>
				<aside>
                    <span>Related articles</span>
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
                                <h4><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h4>
                                <div class='post-meta'>
                                    <?php the_category( ', ' ); ?> -
                                    <time datetime='<?php echo get_the_date('Y-m-d'); ?>'><?php echo get_the_date(); ?></time>
                                </div>
                                <a href='<?php the_permalink(); ?>' class='btn-arrow'>Read</a>
                            </li>
						<?php } wp_reset_postdata(); ?>
                    </ul>
                </aside>
			<?php } ?>
        </div>

		<?php if( $related ){ ?>
            <div class='related'>
				<span class='title-small'>Related startups</span>
                <?php foreach($related as $post){ setup_postdata($post); ?>
                    <div>
                        <?php if(has_post_thumbnail()){ ?>
                            <div class='img'>
                                <a href='<?php the_permalink(); ?>'>
                                    <?php the_post_thumbnail('medium', array('class' => 'no-scroll')); ?>
                                </a>
                            </div>
                        <?php } ?>
                    	<a href='<?php the_permalink(); ?>' class='btn-arrow'><?php the_title(); ?></a>
                    </div>
                <?php } ?>
            </div>
        <?php wp_reset_postdata(); } ?>

        <?php
            $lastPosts = new WP_Query(array(
                'post__not_in' => array($post->ID),
                'posts_per_page'=> 3,
                'ignore_sticky_posts' => 1
            ));
            if($lastPosts->have_posts()):
        ?>
            <footer class='read-also-posts'>
                <?php while($lastPosts->have_posts()): $lastPosts->the_post(); ?>
                    <div>
                        <a href='<?php the_permalink(); ?>' class='img'><?php the_post_thumbnail('large'); ?></a>
                        <h4><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h4>
                        <div class='post-meta'>
                            <?php the_category( ', ' ); ?> -
                            <time datetime='<?php echo get_the_date('Y-m-d'); ?>'><?php echo get_the_date(); ?></time>
                        </div>
                    	<a href='<?php the_permalink(); ?>' class='btn-arrow'>Read</a>
                    </div>
                <?php endwhile; wp_reset_query(); ?>
            </footer>
        <?php endif; ?>

		<?php
            $spotlightPosts = new WP_Query(array(
                'post__not_in' => array($post->ID),
                'posts_per_page'=> 6
            ));

            if($spotlightPosts->have_posts()):
        ?>

            <div>
                <?php while($spotlightPosts->have_posts()): $spotlightPosts->the_post(); ?>
					<div class='spotlight-post'>
                        <div class='content'>
                            <h4><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h4>
                            <?php
                                echo alven_cut_content(get_the_content());
                                $btn = get_field('readMoreLink') ? get_field('readMoreLink') : 'Read more';
                            ?>
                            <a href='<?php the_permalink(); ?>' class='btn-arrow'><?php echo $btn; ?></a>
                        </div>
                	</div>
				<?php endwhile; ?>
            </div>

        <?php endif; ?>

	<?php else : ?>
				
		<h1>404</h1>

	<?php endif; ?>

</div>

<?php get_footer(); ?>
