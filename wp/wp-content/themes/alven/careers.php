<?php
/*
Template Name: Careers
*/

$params = array();

function extend_query( $j ){
    // Set startup datas to job datas
    $sid = get_field('job_startup', $j->ID);
    $j->from = array(
        'name' => get_the_title( $sid ),
        'logo' => get_the_post_thumbnail_url( $sid ),
        //...
    );
    return $j;
}

// function below origin : https://wordpress.stackexchange.com/questions/9394/getting-all-values-for-a-custom-field-key-cross-post
function get_meta_values( $key = '', $type = 'post', $status = 'publish' ) {
    global $wpdb;

    if( empty( $key ) )
        return;

    $r = $wpdb->get_col( $wpdb->prepare( "
        SELECT pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND p.post_type = '%s'
    ", $key, $status, $type ) );

    return $r;
}

function extend_datas( $s, $k ){
    $extended = array(
        'name'  => get_the_title( $k ),
        'count' => $s
    );
    return $extended;
}

function checkParams(){
    global $params;

    $params['location'] = get_query_var('location') ? get_query_var('location') : '';
    $params['company']  = get_query_var('company') ? get_query_var('company') : '';
    $params['function'] = get_query_var('function') ? get_query_var('function') : '';
    $params['sector']   = get_query_var('sector') ? get_query_var('sector') : '';
}


get_header();

    if ( have_posts() ) : the_post(); ?>

        
        <?php
            $is_details = is_singular( 'job' );

            if( $is_details ):
            else:
                checkParams();


                // Get locations
                $locations = get_terms( array(
                    'taxonomy'   => 'job_location',
                    'hide_empty' => false
                ) );

                // Get functions
                $functions = get_terms( array(
                    'taxonomy'   => 'job_function',
                    'hide_empty' => false
                ) );

                // Get sectors
                $sectors = get_terms( array(
                    'taxonomy'   => 'job_sector',
                    'hide_empty' => false
                ) );

                // Get startups
                $startups = get_meta_values('job_startup', 'job');
                if( !empty($startups) ){
                    $startups_filtered = array_count_values( $startups );
                    $startups_extended = array_map( 'extend_datas', $startups_filtered, array_keys( $startups_filtered ) );
                }

                // Get posts
                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                $posts_args = array(
                    'post_type'      => 'job',
                    'posts_per_page' =>  4,
                    'paged'          => $paged
                );
                $jobs = new WP_Query( $posts_args );
                if( $jobs->have_posts() ):
                    $jobs_extended = array_map( 'extend_query' , $jobs->posts );
                endif;


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
                        <h2 class='hn-reset'>Start-up jobs</h2>
                        <p>Join the alven Family</p>
                        <aside class="fields-area" role="complementary" aria-label="<?php esc_attr_e( 'Careers filters', 'alven' ); ?>">
                            <form role='search' method='get' action='<?php echo get_permalink(); ?>' class='form-search-job'>
                                <input type='search' name='s' value='<?php the_search_query(); ?>' id='search'>
                                <label for='search'>type some keywords</label>
                                <!--<button type='submit' class='btn-search btn-no-text'>Explore</button>-->
                           
                                <!-- Locations with number of jobs -->
                                <select name='location'>
                                    <option value=''>All Locations</option>
                                    <?php
                                        foreach ($locations as $key => $location) {
                                            $los = $location->name === $params['location'] ? 'selected' : '';
                                            $lo  = '<option value="'.str_replace(' ','',$location->name).'" '.$los.'>';
                                            $lo .= $location->name.'&nbsp;('.$location->count.')';
                                            $lo .= '</option>';
                                            echo $lo;
                                        }
                                    ?>
                                </select>
                                <!-- Sartups with number of jobs -->
                                <select name='company'>
                                    <option value=''>All Companies</option>
                                    <?php
                                        foreach ($startups_extended as $key => $startup) {
                                            $sos = $startup['name'] === $params['company'] ? 'selected' : '';
                                            $so  = '<option value="'.str_replace(' ','',$startup['name']).'" '.$sos.'>';
                                            $so .= $startup['name'].'&nbsp;('.$startup['count'].')';
                                            $so .= '</option>';
                                            echo $so;
                                        }
                                    ?>
                                </select>
                                <!-- Functions -->
                                <select name='function'>
                                    <option value=''>All Functions</option>
                                    <?php
                                        foreach ($functions as $key => $function) {
                                            $fos = $function->name === $params['function'] ? 'selected' : '';
                                            $fo  = '<option value="'.str_replace(' ','',$function->name).'" '.$fos.'>';
                                            $fo .= $function->name.'&nbsp;('.$function->count.')';
                                            $fo .= '</option>';
                                            echo $fo;
                                        }
                                    ?>
                                </select>
                                <!-- Sectors -->
                                <select name='sector'>
                                    <option value=''>All Sectors</option>
                                    <?php
                                        foreach ($sectors as $key => $sector) {
                                            $seos = $sector->name === $params['sector'] ? 'selected' : '';
                                            $seo  = '<option value="'.str_replace(' ','',$sector->name).'" '.$seos.'>';
                                            $seo .= $sector->name.'&nbsp;('.$sector->count.')';
                                            $seo .= '</option>';
                                            echo $seo;
                                        }
                                    ?>
                                </select>
                                <input type="submit" id="searchsubmit" value="Search" />
                            </form>
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
                                        $article = '<a href="'.esc_url( get_permalink( $job->ID ) ).'" class="job no-padding">';
                                            $article .= '<div class="align-center"><img src="'.$job->from['logo'].'" alt="'.$job->from['name'].'"></div>';
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
                <div class='container flex-container'>
                    <div class='col-3 no-padding'>
                        <h2 class='hn-reset'>Alven jobs</h2>
                        <p>Join the alven team</p>
                    </div>
                    <div class='col-8 no-padding'>
                        <div class="list-jobs-alven flex-container">
                            <a href="" class="job-alven">
                                <div>
                                    <p class="job-title-alven">Business development assistant</p>
                                    <p class="job-location-alven">Paris, France</p>
                                </div>
                            </a>
                            <a href="" class="job-alven">
                                <div>
                                    <p class="job-title-alven">Business development assistant</p>
                                    <p class="job-location-alven">Paris, France</p>
                                </div>
                            </a>
                            <a href="" class="job-alven">
                                <div>
                                    <p class="job-title-alven">Business development assistant</p>
                                    <p class="job-location-alven">Paris, France</p>
                                </div>
                            </a>
                        </div>
                    </div>
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