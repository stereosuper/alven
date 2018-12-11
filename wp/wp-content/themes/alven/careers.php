<?php
/*
Template Name: Careers
*/

$params   = array( 'location', 'company', 'function', 'sector' );
$taxquery = array( 'relation'   => 'AND' );
$metquery = array();

function populate_params(){
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
            // Main variables
            $shortcode  = get_query_var( 'shortcode' );
            $is_details = is_singular( 'job' ) || (  $shortcode && ( !empty( $shortcode ) ) );
            $is_details_wrkbl = empty( $shortcode ) ? false : true;
            
            // Intialize datas for single and list jobs template EXCEPT if it is a single job from WORKABLE
            if( $is_details_wrkbl ):

                $job_alven = get_job_from_wrkbl( $shortcode );
            else:
                $form = get_form_datas( $is_details );
                populate_params();
                $jobs = get_posts_filtered( $is_details, $metquery, $taxquery );
            endif;


            // Initalize datas in regards of template
            if( $is_details ):
                $current_id    = get_the_ID();

                $details       = get_field('job_details', $current_id);
                $urlapply      = get_field('job_link', $current_id);
                $company_datas = extend_post( get_field('job_company', $current_id) );
            else:
                require_once('includes/form-job.php');

                // Get jobs from workable
                $jobs_alven = get_jobs_from_wrkbl();
            endif;

            $hasImg = false;
            if( !$is_details && has_post_thumbnail() ){
                $hasImg = true;
                $imgUrl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0];
            }
        ?>

        <div class='content-header <?php if( $hasImg ){ echo 'has-img '; } ?>' id='contentHeader'>
            <div class='container align-center'>
                <?php echo sprintf('<h1>%s</h1>', $is_details_wrkbl ? $job_alven['title'] : get_the_title()) ?>
                <p><?php _e('Join the Alven Family','alven'); ?></p>
                <?php if( $is_details ):
                    $backlink = esc_url( get_current_template_url( $is_details, 'careers.php' ) );
                    echo '<a class="btn-arrow" href="'. get_url_with_careers_params( $backlink, $params ) .'" title="'. __('Back to results','alven') .'">'. __('Back to results','alven') .'</a>';
                endif; ?>
            </div>
            <?php if( !$is_details && $hasImg ){ ?>
                <div class='img' style='background-image:url(<?php echo $imgUrl; ?>);'>
                    <?php the_post_thumbnail(); ?>
                </div>
            <?php } ?>
        </div>

        <main role='main' id='main'>
            <div class="content-main content-career" id="mainContent">
                <div class="separator"></div>
                <section class='startups-jobs'>
                    <div class='container flex-container'>
                        <div class='col-3 no-padding-left company-search wrapper-collant'>
                            <div class="company-search-wrapper js-company-search-wrapper">
                                <h2 class='job-sidebar-title'><?php _e('Start-up jobs','alven'); ?></h2>
                                <p><?php _e('Join the Alven Family','alven'); ?></p>
                                <?php
                                    if( !$is_details_wrkbl ):
                                        require_once('includes/form-filtered-job.php');
                                        if( $is_details && $jobs->have_posts() ):
                                            // check if the only post is the current one
                                            if( !( count( $jobs->posts ) === 1 && $jobs->post->ID === get_the_ID() ) ): ?>
                                                <div class='related-jobs'>
                                                    <p><?php _e('Related job offers', 'alven') ?></p>
                                                    <div class="related-jobs-links">
                                                    <?php
                                                        foreach ( extend_query($jobs->posts, array( 'location' => true, 'startup' => false ) ) as $key => $job) {
                                                            if( $job->ID !== get_the_ID() ):
                                                                    $article = '<a href="'. get_url_with_careers_params( esc_url( get_permalink( $job->ID ) ), $params ) .'" class="no-padding">';
                                                                    $article .= '<p class="job-title">'.$job->post_title.'</p>';
                                                                    if( $job->location ):
                                                                        $article .= '<p class="job-location">'.$job->location[0]->name.'</p>';
                                                                    endif;
                                                                    $article .= '</a>';

                                                                    echo $article;
                                                            endif;
                                                        }
                                                        ?>
                                                        </div>
                                                        <?php 
                                                        echo '<a class="btn-arrow" href="'. get_url_with_careers_params( $form['action'], $params ) .'" title="'.__('All related job offers').'">'.__('All related job offers').'</a>';
                                                    ?>
                                                </div>
                                            <?php endif;
                                        endif; // end if is details and query have posts
                                    endif; // end if is details job from workable
                                ?>
                            </div>
                        </div>
                        <div class='col-8 no-padding-right'>
                            <?php 
                                if( $is_details ):
                                    require_once('includes/job-details.php');
                                else:
                                    require_once('includes/jobs-list.php');
                                endif;
                                wp_reset_query();
                            ?>
                        </div>
                    </div>
                </section>
                <?php if( !$is_details ):
                    require_once('includes/jobs-workable.php');
                else:
                    if( !$is_details_wrkbl ):
                        require_once('includes/jobs-list-random.php');
                    endif;
                endif; ?> 
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