<?php
/*
Template Name: Sitemap
*/
get_header(); ?>

    <?php if ( have_posts() ) : the_post(); ?>

        <div class='content-header' id='contentHeader'>
            <div class='container'>
                <h1><?php the_title(); ?></h1>
            </div>
        </div>

        <main role='main' id='main'>
            <div class='content-main' id='mainContent'>
                <div class='container'>

                    <h2><?php the_content(); ?></h2>

                    <div class='container-small'>
                        <div class='grid'>
                            <div class='content-default'>
                                <h3>Pages</h3>
                                <ul>
                                    <?php wp_list_pages( array('post_type' => 'page', 'title_li' => '', 'orderby' => 'menu_order') ); ?>
                                </ul>

                                <?php
                                    function listPosts($postType, $order='date'){
                                        $posts = get_posts( array('post_type' => $postType, 'orderby' => $order, 'posts_per_page' => -1) );

                                        if(!$posts)
                                            echo '<p>Nothing was found</p>';

                                        $output = "<ul>";
                                        foreach( $posts as $post ){
                                            $output .= '<li>';
                                            $output .= '<a href="'. get_permalink($post->ID) .'" title="Go to '. get_the_title($post->ID) .'">';
                                            $output .= get_the_title($post->ID);
                                            $output .= '</a>';
                                            $output .= '</li>';
                                        }
                                        $output .= '</ul>';

                                        echo $output;
                                    }
                                ?>

                                <h3>Magazine</h3>
                                <?php listPosts('post'); ?>

                                <h3>Portfolio</h3>
                                <?php listPosts('startup', 'menu_order'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
