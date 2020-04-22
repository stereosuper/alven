<?php
/*
Template Name: About
*/

get_header(); ?>

<?php if ( have_posts() ) : the_post(); ?>
	<div class='title-wrapper'>
		<div class='container'>
			<h1><?php the_title(); ?></h1>
		</div>
	</div>

	<div class='container'>
		<div class='content wysiwyg'>
			<?php the_content(); ?>
		</div>
	</div>

	<div class='history-wrapper'>
		<div class='container'>
			<h2 class='h2'><?php the_field('history_title'); ?></h2>
			<ul class='periods'>
            	<?php
                    $periods = get_terms(array('taxonomy' => 'period'));
                    foreach($periods as $period){
                        echo '<li><button data-field="'.$period->slug.'">'.$period->name.'</button></li>';
                    }
                ?>
			</ul>
			<div class='history'>
				<ul class='dates clearfix'>
					<?php
						$datesQuery = new WP_Query(array('post_type' => 'date', 'posts_per_page' => -1));
						if( $datesQuery->have_posts() ) : while( $datesQuery->have_posts() ) : $datesQuery->the_post();
							$cover = get_field('cover');
							$hasImg = has_post_thumbnail();
							$link = get_field('link');
					?>
						<li class='history-date <?php the_field('bg'); if( $hasImg && !$cover ) echo " has-icon";?>'>
							<?php if( $hasImg ) : ?>
								<div class="img" <?php if( $cover ) echo 'style="background-image:url(' . get_the_post_thumbnail_url($post, 'medium') . ')"'; ?>>
									<?php if( !$cover ) the_post_thumbnail('medium'); ?>
								</div>
							<?php endif; ?>
							<div class="txt">
								<h3><?php the_title(); ?></h3>
								<?php the_content(); ?>
								<?php if( $link ) : ?>
									<p>
										<a href='<?php echo $link['url']; ?>' class='link-roboto'><?php echo $link['title']; ?></a>
									</p>
								<?php endif; ?>
							</div>
						</li>
					<?php endwhile; endif; ?>
				</ul>
			</div>
		</div>
	</div>
	
<?php endif; ?>

<?php get_footer(); ?>