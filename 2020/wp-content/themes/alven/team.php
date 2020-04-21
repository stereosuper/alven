<?php
/*
Template Name: Team
*/

get_header(); ?>

<?php if ( have_posts() ) : the_post(); ?>
	<div class='title-wrapper'>
		<div class='container'>
			<h1><?php the_title(); ?></h1>
		</div>
	</div>

		<?php
        	$team = new WP_Query(array('post_type' => 'team', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC'));
            if($team->have_posts()):
        ?>
            <div class='container-small container-team'>
                <button>Previous profile</button>
				<button>Next profile</button>
				<button>Close</button>
                <div class='team-list'>
					<?php while($team->have_posts()): $team->the_post(); ?>
						<div>
                            <button class='team-member'>
                            	<?php the_post_thumbnail('large'); ?>
                                <span class='name'><?php the_title(); ?></span>
                                <span class='function'><?php the_field('job'); ?></span>
                            </button>
							<div class='team-desc'>
                                <?php the_content(); ?>
                                <?php if(get_field('linkedin') || get_field('twitter')){ ?>
                                	<ul class=''>
										<?php if(get_field('linkedin')){ ?>
											<li>
                                            	<a href='<?php the_field('linkedin'); ?>' target='_blank'>
                                                    Linkedin
                                                </a>
											</li>
										<?php } if(get_field('twitter')){ ?>
											<li>
                                                <a href='<?php the_field('twitter'); ?>' target='_blank'>
                                                    Twitter
                                            	</a>
											</li>
										<?php } ?>
                                    </ul>
                                <?php } ?>
                            </div>
						</div>
					<?php endwhile; ?>
                </div>
            </div>
		<?php endif; ?>
	
<?php endif; ?>

<?php get_footer(); ?>