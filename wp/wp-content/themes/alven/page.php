<?php get_header(); ?>

	<?php if ( have_posts() ) : the_post(); ?>

        <div class='content-header' id='contentHeader'>
            <div class='container'>
                <h1><?php the_title(); ?></h1>
            </div>
        </div>

        <main role='main' id='main'>
            <article class='content-main' id='mainContent'>
                <div class='container'>

                    <h2></h2>

                    <div class='container-small'>
                        <div class='grid'>
                            <div class='col-8 content-default'>
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
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

                    <h2>Page not found</h2>

                </div>
            </article>
        </main>

	<?php endif; ?>

<?php get_footer(); ?>
