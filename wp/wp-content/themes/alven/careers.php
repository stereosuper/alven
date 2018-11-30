<?php
/*
Template Name: Careers
*/

$params   = array( 'location', 'company', 'function', 'sector' );
$taxquery = array( 'relation'   => 'AND' );
$metquery = array();

function extend_query( $j ){
    // Set startup datas to job datas
    $sid = get_field('job_company', $j->ID);
    $j->from = array(
        'name' => get_the_title( $sid ),
        'logo' => get_the_post_thumbnail_url( $sid ),
        //...
    );
    return $j;
}

// Origin of the function below : https://wordpress.stackexchange.com/questions/9394/getting-all-values-for-a-custom-field-key-cross-post
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
        'id'    => $k,
        'slug'  => get_post_field( 'post_name', $k ),
        'name'  => get_the_title( $k ),
        'count' => $s
    );
    return $extended;
}

function checkParams(){
    global $params;
    global $taxquery;
    global $metquery;

    foreach ($params as $key => $param) {
        if( get_query_var($param) ):
            $params[$param] = get_query_var($param);
            if( $param !== 'company' ):
                array_push($taxquery, array( 'taxonomy' => 'job_'.$param, 'field' => 'slug', 'terms' => $params[$param]));
            else:
                array_push($metquery, array( 'key' => 'job_'.$param, 'value' => $params[$param], 'compare' => '='));
            endif;            
        else:
            $params[$param] = '';
        endif;
    }
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
                $startups = get_meta_values('job_company', 'job');
                if( !empty($startups) ){
                    $startups_filtered = array_count_values( $startups );
                    $startups_extended = array_map( 'extend_datas', $startups_filtered, array_keys( $startups_filtered ) );
                }

                // Get posts
                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

                $posts_args = array(
                    'post_type'      => 'job',
                    'posts_per_page' =>  4,
                    'paged'          => $paged,
                    'meta_query'     => $metquery,
                    'tax_query'      => $taxquery,
                    's'              => sanitize_text_field( get_query_var('search') )
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
                    <div class='col-3 no-padding-left'>
                        <h2 class='job-sidebar-title'>Start-up jobs</h2>
                        <p>Join the alven Family</p>
                        <form role='search' method='get' action='<?php echo get_permalink(); ?>' class='' aria-label="<?php esc_attr_e( 'Careers filters', 'alven' ); ?>">
                            <input type='search' name='search' value='<?php the_search_query(); ?>' id='search'>
                            <button type='submit' class='btn-search btn-no-text'>Explore</button>
                            <label for='search'>type some keywords</label>
                           
                            <!-- Locations with number of jobs -->
                            <div class='select'>
                                <select name='location'>
                                    <option value=''>All Locations</option>
                                    <?php
                                        foreach ($locations as $key => $location) {
                                            $los = $location->slug === $params['location'] ? 'selected' : '';
                                            $lo  = '<option value="'.$location->slug.'" '.$los.'>';
                                            $lo .= $location->name.'&nbsp;('.$location->count.')';
                                            $lo .= '</option>';
                                            echo $lo;
                                        }
                                    ?>
                                </select>
                            </div>
                            <!-- Sartups with number of jobs -->
                            <div class='select'>
                                <select name='company'>
                                    <option value=''>All Companies</option>
                                    <?php
                                        foreach ($startups_extended as $key => $startup) {
                                            $sos = $startup['id'] == $params['company'] ? 'selected' : '';
                                            $so  = '<option value="'.$startup['id'].'" '.$sos.'>';
                                            $so .= $startup['name'].'&nbsp;('.$startup['count'].')';
                                            $so .= '</option>';
                                            echo $so;
                                        }
                                    ?>
                                </select>
                            </div>
                            <!-- Functions -->
                            <div class='select'>
                                <select name='function'>
                                    <option value=''>All Functions</option>
                                    <?php
                                        foreach ($functions as $key => $function) {
                                            $fos = $function->slug === $params['function'] ? 'selected' : '';
                                            $fo  = '<option value="'.$function->slug.'" '.$fos.'>';
                                            $fo .= $function->name.'&nbsp;('.$function->count.')';
                                            $fo .= '</option>';
                                            echo $fo;
                                        }
                                    ?>
                                </select>
                            </div>
                            <!-- Sectors -->
                            <div class='select'>
                                <select name='sector'>
                                    <option value=''>All Sectors</option>
                                    <?php
                                        foreach ($sectors as $key => $sector) {
                                            $seos = $sector->slug === $params['sector'] ? 'selected' : '';
                                            $seo  = '<option value="'.$sector->slug.'" '.$seos.'>';
                                            $seo .= $sector->name.'&nbsp;('.$sector->count.')';
                                            $seo .= '</option>';
                                            echo $seo;
                                        }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" id="searchsubmit" class="btn">Search</button>
                        </form>
                    </div>
                    <div class='col-8 no-padding-right'>
                        <?php 
                            if( $is_details ):
                                echo 'contenu de loffre';
                                var_dump(get_field('job_location', get_the_ID()));
                            else:
                                echo '<div class="list-jobs flex-container">';
                                if( !empty($jobs_extended) ):
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
                                else:
                                    echo '<p>'.__('Aucun post ne correspond à cette recherche.','alven').'</p>';
                                endif;
                            endif;
                        ?>
                        <?php wp_reset_query(); ?>
                    </div>
                </div>
            </section>

            <section class='alven-jobs'>
                <div class='container flex-container'>
                    <div class='col-3 no-padding-left'>
                        <h2 class='job-sidebar-title'>Alven jobs</h2>
                        <p>Join the alven team</p>
                    </div>

                    <div class='col-8 no-padding-right'>
                        <div class="list-jobs-alven flex-container">
                            <a href="" class="job-alven">
                                <p class="job-title-alven">Business development assistant</p>
                                <p class="job-location-alven">Paris, France</p>
                            </a>
                            <a href="" class="job-alven">
                                <p class="job-title-alven">Business development assistant</p>
                                <p class="job-location-alven">Paris, France</p>
                            </a>
                            <a href="" class="job-alven">
                                <p class="job-title-alven">Business development assistant</p>
                                <p class="job-location-alven">Paris, France</p>
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