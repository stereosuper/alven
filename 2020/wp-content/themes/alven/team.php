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
                <div class='team-list' id='team'>
					<?php while($team->have_posts()): $team->the_post(); ?>
						<div class='member'>
                            <button class='team-member'>
                            	<?php the_post_thumbnail('large'); ?>
                                <span class='name'><?php the_title(); ?></span>
                                <span class='function'><?php the_field('job'); ?></span>
                            </button>
							<div class='team-desc'>
                                <?php the_content(); ?>
                                <?php if(get_field('linkedin') || get_field('twitter')){ ?>
                                	<ul class='share share-team'>
										<?php if(get_field('linkedin')){ ?>
											<li>
                                            	<a href='<?php the_field('linkedin'); ?>' target='_blank' target="_blank" rel="noopener noreferrer">
                                                    <svg class="icon"><use xlink:href="#icon-linkedin"></use></svg>
                                                </a>
											</li>
										<?php } if(get_field('twitter')){ ?>
											<li>
                                                <a href='<?php the_field('twitter'); ?>' target='_blank' target="_blank" rel="noopener noreferrer">
                                                    <svg class="icon"><use xlink:href="#icon-twitter"></use></svg>
                                            	</a>
											</li>
										<?php } ?>
                                    </ul>
								<?php } ?>
								<button role="button" class="team-btn prev">
									<svg class="icon"><use xlink:href="#icon-left"></use></svg>
								</button>
								<button role="button" class="team-btn next">
									<svg class="icon"><use xlink:href="#icon-right"></use></svg>
								</button>
                            </div>
						</div>
					<?php endwhile; ?>
                </div>
            </div>
		<?php endif; ?>
	
<?php endif; ?>

<?php get_footer(); ?>