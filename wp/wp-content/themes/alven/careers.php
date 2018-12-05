<?php
/*
Template Name: Careers
*/

$params   = array( 'location', 'company', 'function', 'sector' );
$taxquery = array( 'relation'   => 'AND' );
$metquery = array();


function populate_form( $d ){
    $action = formredir( $d );
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

    return array(
        'action'    => $action,
        'locations' => $locations,
        'functions' => $functions,
        'sectors'   => $sectors,
        'startups'  => $startups_extended 
    );
}

// Get page carreer url and return it
function formredir( $s ){
    if( $s ):
        $page = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'careers.php'
        ));
        return get_permalink( $page[0]->ID );
    else:
        return get_permalink();
    endif;
}

function extend_query( $j ){
    // Set location
    $j->location = get_the_terms($j->ID, 'job_location');
    // Set startup datas to job datas
    $sid     = get_field('job_company', $j->ID);
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

function check_params(){
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

function extend_post( $id ){
    $company_datas = null;
    
    if( $id ):
        $company_datas = array(
            'name'     => get_the_title( $id ),
            'logo_url' => get_the_post_thumbnail_url( $id ),
            'sectors'  => wp_get_post_terms( $id, 'field' )
        );
    endif;

    return $company_datas;
}

// Get a list of jobs available in workable
function get_jobs(){
    $workable_datas = null;
    $subdomain = 'alven'; 
    $token     = '74069b76972b9edc000610fd9cd1f2f9945483d3425e7483467d0faa6f43680b';
    $workable_args = array(
        'headers' => array(
            'Content-Type: application/json',
            'Authorization' => 'Bearer ' . $token
        ),
    );

    // ?state=published
    $workable_response = wp_remote_get( 'https://'.$subdomain.'.workable.com/spi/v3/jobs', $workable_args );
    $workable_response_code = wp_remote_retrieve_response_code( $workable_response );

    if( $workable_response_code == 200 ):
        $workable_datas_filtered = json_decode( $workable_response['body'], true );
        $workable_datas = $workable_datas_filtered['jobs'];
    endif;

    return $workable_datas;
}

get_header();

    if ( have_posts() ) : the_post(); ?>

        
        <?php
            $is_details = is_singular( 'job' );
            $form = populate_form( $is_details );

            check_params();

            if( $is_details ):
                $current_id = get_the_ID();

                $details       = get_field('job_details', $current_id);
                $urlapply      = get_field('job_link', $current_id);
                $company_datas = extend_post( get_field('job_company', $current_id) );

            else:
                require_once('includes/form-job.php');

                // Get jobs from workable
                $jobs_alven = get_jobs();

                // Get jobs from worpdress
                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

                $posts_args = array(
                    'post_type'      => 'job',
                    'posts_per_page' =>  6,
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
            <div class="content-main content-career" id="mainContent">
                <section class='startups-jobs'>
                    <div class='container flex-container'>
                        <div class='col-3 no-padding-left'>
                            <h2 class='job-sidebar-title'>Start-up jobs</h2>
                            <p>Join the alven Family</p>

                            <form role='search' method='get' action='<?php echo $form['action']; ?>' class='jobs-form' aria-label="<?php esc_attr_e( 'Careers filters', 'alven' ); ?>">
                                <div class='jobs-search'>
                                    <input type='search' name='search' value='<?php the_search_query(); ?>' id='search'>
                                    <button type='submit' class='btn-search btn-no-text'>Explore</button>
                                    <label for='search'>Free search</label>
                                </div>
                            
                                <!-- Locations with number of jobs -->
                                <div class='select'>
                                    <select name='location'>
                                        <option value=''>All Locations</option>
                                        <?php
                                            foreach ($form['locations'] as $key => $location) {
                                                $los = $location->slug === $params['location'] ? 'selected' : '';
                                                $lo  = '<option value="'.$location->slug.'" '.$los.'>';
                                                $lo .= $location->name.'&nbsp;('.$location->count.')';
                                                $lo .= '</option>';
                                                echo $lo;
                                            }
                                        ?>
                                    </select>
                                </div><div class='select'>
                                    <select name='company'>
                                        <option value=''>All Companies</option>
                                        <?php
                                            foreach ($form['startups'] as $key => $startup) {
                                                $sos = $startup['id'] == $params['company'] ? 'selected' : '';
                                                $so  = '<option value="'.$startup['id'].'" '.$sos.'>';
                                                $so .= $startup['name'].'&nbsp;('.$startup['count'].')';
                                                $so .= '</option>';
                                                echo $so;
                                            }
                                        ?>
                                    </select>
                                </div><div class='select'>
                                    <select name='function'>
                                        <option value=''>All Functions</option>
                                        <?php
                                            foreach ($form['functions'] as $key => $function) {
                                                $fos = $function->slug === $params['function'] ? 'selected' : '';
                                                $fo  = '<option value="'.$function->slug.'" '.$fos.'>';
                                                $fo .= $function->name.'&nbsp;('.$function->count.')';
                                                $fo .= '</option>';
                                                echo $fo;
                                            }
                                        ?>
                                    </select>
                                </div><div class='select'>
                                    <select name='sector'>
                                        <option value=''>All Sectors</option>
                                        <?php
                                            foreach ($form['sectors'] as $key => $sector) {
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
                                    echo '<div class="details-job flex-container">';
                                        echo '<div class="details-job-main">';
                                            $details_header  = '<header class="flex-container details-job-header">';
                                            $details_header .= '<div><p class="title-small">'.__('Job Type','alven').'</p><p>Permanent Contract</p></div>';
                                            $details_header .= '<div><p class="title-small">'.__('Location','alven').'</p><p>Paris</p></div>';
                                            $details_header .= '</header>';
                                            echo $details_header;

                                            $details_section = '<section>';
                                            if( $details ):
                                                if( $details['job_details_about'] ):
                                                    $details_section .= '<h2 class="job-single-title">'.__('About','alven').'&nbsp'.$company_datas['name'].'</h2>';
                                                    $details_section .= $details['job_details_about'];
                                                endif;
                                                if( $details['job_details_desc'] ):
                                                    $details_section .= '<h2 class="job-single-title">'.__('Job description','alven').'</h2>';
                                                    $details_section .= $details['job_details_desc'];
                                                endif;
                                                if( $details['job_details_profil'] ):
                                                    $details_section .= '<h2 class="job-single-title">'.__('Profile','alven').'</h2>';
                                                    $details_section .= $details['job_details_profil'];
                                                endif;
                                                if( $details['job_details_why'] ):
                                                    $details_section .= '<h2 class="job-single-title">'.__('Why you should join us','alven').'</h2>';
                                                    $details_section .= $details['job_details_why'];
                                                endif;
                                                if( $details['job_details_process'] ):
                                                    $details_section .= '<h2 class="job-single-title">'.__('Hiring Process','alven').'</h2>';
                                                    $details_section .= $details['job_details_process'];
                                                endif;
                                            endif;
                                            $details_section .= '</section>';
                                            echo $details_section;
                                        echo '</div>';
                                        echo '<div class="details-job-sidebar">';
                                            if( $urlapply ):
                                                echo '<a href="'.$urlapply.'" alt="'.__('Apply','alven').'" tarrget="_blank" rel="noopener noreferrer" class="btn">'.__('Apply','alven').'</a>';
                                            endif;
                                            $job_company  = '<div>';
                                            $job_company .= '<p class="title-small">'.__('The company','alven').'</p>';
                                            $job_company .= '<img src="'.$company_datas['logo_url'].'" alt="'.$company_datas['name'].'">';
                                            $job_company .= '<p class="title-small">'.__('Sectors','alven').'</p>';
                                            if( !empty($company_datas['sectors']) ):
                                                $job_company .= '<ul>';
                                                foreach ($company_datas['sectors'] as $key => $value) {
                                                    $job_company .= '<li>'.$value->name.'</li>';
                                                }
                                                $job_company .= '</ul>';
                                            endif;
                                            $job_company  .= '</div>';
                                            echo $job_company;
                                        echo '</div>';
                                    echo '</div>';
                                else:
                                    echo '<div class="list-jobs flex-container">';
                                    if( !empty($jobs_extended) ):
                                        foreach ($jobs_extended as $key => $job) {
                                            $article = '<a href="'.esc_url( get_permalink( $job->ID ) ).'" class="job no-padding">';
                                            $article .= '<div class="align-center"><img src="'.$job->from['logo'].'" alt="'.$job->from['name'].'"></div>';
                                            $article .= '<div><p class="job-title">'.$job->post_title.'</p>';
                                            if( $job->location ):
                                                $article .= '<p class="job-location">'.$job->location[0]->name.'</p></div>';
                                            else:
                                                $article .= '</div>';
                                            endif;
                                            $article .= '</a>';
                                            echo $article;
                                        }
                                        echo "</div>";

                                        echo "<div class='job-paginate align-center'>";
                                        $big = 999999999; // need an unlikely integer
                                        echo paginate_links( array(
                                            //'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                            'base'      => preg_replace('/\?.*/', '/', get_pagenum_link(1)) . '%_%',
                                            'format'    => '?paged=%#%',
                                            'current'   => max( 1, get_query_var('paged') ),
                                            'total'     => $jobs->max_num_pages,
                                            'prev_text' => '',
                                            'next_text' => '',
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

                <?php if( $jobs_alven && !empty( $jobs_alven ) ): ?>
                    <section class='alven-jobs'>
                        <div class='container flex-container'>
                            <div class='col-3 no-padding-left'>
                                <h2 class='job-sidebar-title'>Alven jobs</h2>
                                <p>Join the alven team</p>
                            </div>

                            <div class='col-8 no-padding-right'>
                                <div class="list-jobs-alven flex-container">
                                    <?php 
                                        foreach ($jobs_alven as $key => $job_alven) {
                                        //var_dump($job_alven);
                                        $job_alven_link  = '<a href="'.$job_alven['url'].'" class="job-alven">';
                                        $job_alven_link .= '<p class="job-title-alven">'.$job_alven['title'].'</p>';
                                        // Line below do the trick also
                                        // $job_alven_location = ($job_alven['location']['city'] && $job_alven['location']['country'] ? $job_alven['location']['city'] . ',&nbsp;' . $job_alven['location']['country'] : ($job_alven['location']['city'] ? $job_alven['location']['city'] : $job_alven['location']['country']));
                                        $job_alven_location = join(',&nbsp;', array_filter([$job_alven['location']['city'], $job_alven['location']['country']]));
                                        $job_alven_link .= '<p class="job-location-alven">'.$job_alven_location.'</p>';
                                        $job_alven_link .= '</a>';
                                        echo $job_alven_link;
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>

                <section class=''>
                    <h2>Direct application</h2>
                    <div class='container flex-container'>
                        <div class='col-3 no-padding-left'>
                            <?php the_field('career_directapp_desc'); ?>
                        </div>
                        <div class='col-8 no-padding-right'>
                            <?php if($status_job === 'success'): ?>
                                <p class='form-success'><?php _e('Your message has been sent!<br> Thank you, we will be back to you shortly.', 'alven'); ?></p>
                            <?php else: ?>
                                <?php if( $errorSend_job ): ?>
                                    <p class='form-error'><?php echo $errorSend_job; ?></p>
                                <?php endif; ?>
                                <form action='<?php the_permalink(); ?>' method='post' class='' enctype='multipart/form-data' autocomplete='off'>
                                    <fieldset>
                                        <legend class='active'><?php _e('Please', 'alven'); ?><span><?php _e('Introduce yourself', 'alven'); ?></span></legend>
                                        <section class='form-section <?php if($errorFirstname || $errorLastname || $errorEmail) echo "invalid"; ?>'>
                                            <div>
                                                <input type='text' name='firstname_job' id='firstname_job' required class='form-elt <?php if($errorFirstname_job) echo "invalid"; ?>' value='<?php echo $firstname_job; ?>'>
                                                <label for='firstname_job'><?php _e('Your first name', 'alven'); ?></label>
                                            </div>
                                            <div>
                                                <input type='text' name='lastname_job' id='lastname_job' required class='form-elt <?php if($errorLastname_job) echo "invalid"; ?>' value='<?php echo $lastname_job; ?>'>
                                                <label for='lastname_job'><?php _e('Your last name', 'alven'); ?></label>
                                            </div>
                                            <div>
                                                <input type='email' name='email_job' id='email_job' required class='form-elt <?php if($errorEmail_job) echo "invalid"; ?>' value='<?php echo $email_job; ?>'>
                                                <label for='email_job'><?php _e('Your email', 'alven'); ?></label>
                                            </div>
                                            <div class='full has-desc'>
                                                <input type='file' name='document_job' id='document_job' required class='form-elt <?php if($errorDocument_job) echo "invalid"; ?>'>
                                                <label for='document_job'>Your document</label>
                                                <span class='form-desc'>.pdf, .doc, .docx, .rtf</span>
                                            </div>
                                            <div class='hidden'>
                                                <input type='url' name='url_job' id='url_job' value='<?php echo $spamUrl_job; ?>'>
                                                <label for='url_job'>Leave this field empty please</label>
                                            </div>
                                        </section>
                                    </fieldset>
                                    <button type='submit' name='directappsubmit' class='btn-invert'>Confirm</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
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

    <?php endif;

get_footer(); ?>