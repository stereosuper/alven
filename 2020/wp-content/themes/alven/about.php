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
			<ul class='periods' id='periods'>
            	<?php
					$periods = get_terms(array('taxonomy' => 'period'));
					$nbPeriods = count($periods);
					$i = 0;
                    foreach($periods as $period){
						$i++;
						echo '<li><button data-field="'.$period->slug.'"';
						if($nbPeriods === $i){
							echo ' class="on"';
							$lastPeriod = $period->slug;
						}
						echo '>'.$period->name.'</button></li>';
                    }
                ?>
			</ul>
			<div class='history' id='history'>
				<?php foreach($periods as $period) : ?>
					<?php
						$datesQuery = new WP_Query( array(
							'post_type' => 'date',
							'posts_per_page' => -1,
							'tax_query' => array(
								array(
									'taxonomy' => 'period',
									'field'    => 'slug',
									'terms'    => $period->slug,
								),
							)
						));
						if( $datesQuery->have_posts() ) :
					?>
						<ul class='dates clearfix <?php if( $lastPeriod !== $period->slug ) echo "off"; ?>' data-period='<?php echo $period->slug; ?>'>
							<?php while( $datesQuery->have_posts() ) : $datesQuery->the_post();
								$cover = get_field('cover');
								$hasImg = has_post_thumbnail();
								$link = get_field('link');

								$terms = get_the_terms($post, 'period');
								$class = 'history-date ' . get_field('bg');
								if( $hasImg && !$cover ){
									$class .= ' has-icon';
								}
							?>
								<li class='<?php echo $class; ?>'>
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
							<?php endwhile; ?>
						</ul>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	
<?php endif; ?>

<?php get_footer(); ?>