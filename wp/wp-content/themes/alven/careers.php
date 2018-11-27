<?php
/*
Template Name: Careers
*/



// Location with job(s)
$lwj = array();
// Startups with job(s)
$swj = array();

function populate_datas( $j ){
    global $swj;
    global $lwj;

    // Set startup datas to job datas
    $sid = get_field('job_startup', $j->ID);
    $j->from = array(
        'name' => get_the_title( $sid ),
        'logo' => get_the_post_thumbnail_url( $sid ),
        //...
    );

    // Populate startups array
    if( $sid ){
        $swj[ $j->from['name'] ] = array_key_exists( $j->from['name'], $swj ) ? $swj[ $j->from['name'] ]+1 : 1;
    }
    // Populate locations array
    $l = get_field('job_location', $j->ID);
    if( $l ){
        $lwj[ $l['address'] ] = array_key_exists( $l['address'], $lwj ) ? $lwj[ $l['address'] ]+1 : 1;
        $j->location = $l['address'];
    }

    return $j;
}





get_header();

    if ( have_posts() ) : the_post(); ?>

        
        <?php
            $is_details = is_singular( 'job' );

            if( $is_details ):
            else:

                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                $args = array(
                    'post_type'      => 'job',
                    'posts_per_page' =>  4,
                    'paged'          => $paged
                );
                $jobs = new WP_Query( $args );

                if( $jobs->have_posts() ):
                    // Add datas from the startup and populate arrays (startups, locations)
                    $jobs_extended = array_map( 'populate_datas' , $jobs->posts );
                endif;


                //var_dump($lwj);
            endif;

            
            
            
            $hasImg = false;
            if(has_post_thumbnail()){
                $hasImg = true;
                $imgUrl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0];
            }
        ?>

        <div class='content-header <?php if($hasImg){ echo 'has-img '; } ?>' id='contentHeader'>
            <div class='container align-center'>
                <h1><?php the_title(); ?></h1>
            </div>
            <?php if($hasImg){ ?>
                <div class='img' style='background-image:url(<?php echo $imgUrl; ?>);'>
                    <?php the_post_thumbnail(); ?>
                </div>
            <?php } ?>
        </div>

        <main role='main' id='main'>
            <section class='startups-jobs'>
                <div class='container flex-container'>
                    <div class='col-3 no-padding'>
                        <h2>Start-up jobs</h2>
                        <p>Join the alven Family</p>
                        <aside class="fields-area" role="complementary" aria-label="<?php esc_attr_e( 'Careers filters', 'alven' ); ?>">
                            <form role='search' method='get' action='<?php echo home_url('/'); ?>' class='form-search'>
                                <input type='search' name='s' value='<?php the_search_query(); ?>' id='search'>
                                <label for='search'>type some keywords</label>
                                <button type='submit' class='btn-search btn-no-text'>Explore</button>
                            </form>
                            <!-- Locations with number of jobs -->
                            <ul class='dropdown' data-filter='field'>
                                <li data-field='all' class='actif'>All locations</li>
                                <?php
                                    foreach($lwj as $key => $n){
                                        echo '<li data-field="'.$key.'">'.$key.'&nbsp;('.$n.')</li>';
                                    }
                                ?>
                            </ul>
                            <!-- Sartups with number of jobs -->
                            <ul class='dropdown' data-filter='field'>
                                <li data-field='all' class='actif'>All Companies</li>
                                <?php
                                    foreach($swj as $key => $n){
                                        echo '<li data-field="'.$key.'">'.$key.'&nbsp;('.$n.')</li>';
                                    }
                                ?>
                            </ul>
                            <!-- Functions -->
                            <ul class='dropdown' data-filter='field'>
                                <li data-field='all' class='actif'>All Functions</li>
                                <?php
                                    /*foreach($swj as $key => $n){
                                        echo '<li data-field="'.$key.'">'.$key.'&nbsp;('.$n.')</li>';
                                    }*/
                                ?>
                            </ul>
                            <!-- Sectors -->
                            <ul class='dropdown' data-filter='field'>
                                <li data-field='all' class='actif'>All Sectors</li>
                                <?php
                                    /*foreach($swj as $key => $n){
                                        echo '<li data-field="'.$key.'">'.$key.'&nbsp;('.$n.')</li>';
                                    }*/
                                ?>
                            </ul>
                        </aside>
                    </div>
                    <div class='col-8 no-padding'>
                        <div class=''>
                            <?php 
                                if( $is_details ):
                                    echo 'contenu de loffre';
                                    var_dump(get_field('job_location', get_the_ID()));
                                else:
                                    echo '<div class="list-jobs flex-container">';
                                    foreach ($jobs_extended as $key => $job) {
                                        /*echo '<pre>';
                                        var_dump($job);
                                        echo '</pre>';*/
                                        $article = '<a href="'.esc_url( get_permalink( $job->ID ) ).'" class="job no-padding">';
                                            $article .= '<div><img src="'.$job->from['logo'].'" alt="'.$job->from['name'].'"></div>';
                                            $article .= '<div><p class="job-title">'.$job->post_title.'</p><p class="job-location">'.$job->location.'</p></div>';
                                        $article .= '</a>';
                                        echo $article;
                                    }
                                    echo "</div>";

                                    echo "<div class='job-paginate align-center'>";
                                        $big = 999999999; // need an unlikely integer
                                        echo paginate_links( array(
                                            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                            'format'    => '?paged=%#%',
                                            'current'   => max( 1, get_query_var('paged') ),
                                            'total'     => $jobs->max_num_pages,
                                            'prev_text' => '',
                                            'next_text' => ''
                                        ) );
                                    echo "</div>";
                                endif;
                            ?>
                        </div>
                        <?php wp_reset_query(); ?>
                    </div>
                </div>
            </section>
            <section class='alven-jobs'>
                <div class='container'>
                    <div class='col-3 no-padding'>
                        <h2>Alven jobs</h2>
                        <p>Join the alven team</p>
                    </div>
                    <div class='col-8 no-padding'></div>
                </div>
            </section>
            <section class=''>
            </section>
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

    <?php endif;

get_footer(); ?>