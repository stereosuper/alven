<?php get_header(); ?>

	<?php if ( have_posts() ) : ?>

        <section class='content-header-transparent'>
            <h2 class='section-title'>Think, read, exchange</h2>
            <strong class='subtitle'>Alven online magazine</strong>
            <div class='container'>
                <div class='section-header'>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id sodales mauris. Mauris et aliqae lacus aliquet mattis. Sed mi arcu, tristique id ex ut, facilisis accumsan sapien.
                    </p>

                    <a href='#' class='btn'>Read Alven magazine</a>
                </div>
            </div>

        <main role='main' id='main'>
            <article class='content-main' id='mainContent'>
                <div class='container'>

                    <h2></h2>

                    <div class='container-small'>
                        <div class='grid'>
                            <div class='col-8 content-default'>

                                <?php while ( have_posts() ) : the_post(); ?>
                                	<span><?php echo get_the_date(); ?></span>
                                	<h2><?php the_title(); ?></h2>
                                	<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
                                	<span><?php if(get_the_category()){ foreach((get_the_category()) as $cat) { echo $cat->cat_name . ' - '; } } ?></span>
                                	<?php the_excerpt(); ?>
                                	<a href="<?php the_permalink(); ?>">lire la suite</a>
                                <?php endwhile; ?>

                                <?php previous_posts_link('Articles suivants'); ?>
                                <?php next_posts_link('Articles précédents'); ?>

                                <div class='pagination'>
                                	<?php echo paginate_links( array( 'prev_text' => '<b>‹</b> <span>' . 'Précédent' . '</span>', 'next_text'  => '<span>' . 'Suivant' . '</span> <b>›</b>' ) ); ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </main>

	<?php else : ?>

		<div class='content-header' id='contentHeader'>
            <div class='container'>
                <h1><?php the_title(); ?></h1>
            </div>
        </div>

        <main role='main' id='main'>
            <article class='content-main' id='mainContent'>
                <div class='container'>

                    <h2>No posts yet</h2>

                </div>
            </article>
        </main>

	<?php endif; ?>

<?php get_footer(); ?>

