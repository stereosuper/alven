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
			<ul class='history'>
				<?php
					$datesQuery = new WP_Query(array('post_type' => 'date', 'posts_per_page' => -1));
					if( $datesQuery->have_posts() ) : while( $datesQuery->have_posts() ) : $datesQuery->the_post();
				?>
					<li class='history-date <?php the_field('bg'); ?>'>
						<h3><?php the_title(); ?></h3>
						<?php the_content(); ?>
					</li>
				<?php endwhile; endif; ?>
			</ul>
		</div>
	</div>
	
<?php endif; ?>

<?php get_footer(); ?>