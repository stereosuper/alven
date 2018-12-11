<?php

function get_jobs_random(){
    $posts_args = array(
        'post_type'      => 'job',
        'posts_per_page' =>  3
    );
    $jobs = new WP_Query( $posts_args );

   return $jobs;
}

$jobs_random = get_jobs_random();

if ( $jobs_random->have_posts() ):
    echo '<div class="list-random-jobs js-list-random-jobs">';
    echo '<div class="container flex-container">';
        foreach (extend_query($jobs_random->posts, array('location' => true, 'startup' => true)) as $key => $job) {
            $article = '<a href="' . get_url_with_careers_params( esc_url( get_permalink($job->ID) ), $params ) . '" class="no-padding">';
            $article .= '<figure class="align-center"><img src="' . $job->from['logo'] . '" alt="' . $job->from['name'] . '"></figure>';
            $article .= '<div><p class="job-title">' . $job->post_title . '</p>';
            if ($job->location):
                $article .= '<p class="job-location">' . $job->location[0]->name . '</p></div>';
            else:
                $article .= '</div>';
            endif;
            $article .= '</a>';

            echo $article;
        }
    echo "</div>";
    echo "</div>";
endif;

?>