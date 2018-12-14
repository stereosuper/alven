<?php

if ( $jobs->have_posts() ):

    echo '<div class="flex-container list-jobs js-list-jobs">';
        foreach (extend_query($jobs->posts, array('location' => true, 'startup' => true)) as $key => $job) {
            $article = '<a href="' . get_url_with_careers_params( esc_url( get_permalink($job->ID) ), $params ) . '" class="job no-padding">';
            $article .= '<div class="align-center"><img src="' . $job->from['logo'] . '" alt="' . $job->from['name'] . '"></div>';
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

    echo "<div class='job-paginate align-center'>";
        $big = 999999999; // need an unlikely integer
        echo paginate_links(array(
            //'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'base' => preg_replace('/\?.*/', '/', get_pagenum_link(1)) . '%_%',
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $jobs->max_num_pages,
            'prev_text' => '',
            'next_text' => '',
        ));
    echo "</div>";

else:
    echo '<p class="no-jobs">' . __('There are no jobs available at the moment.', 'alven') . '</p>';
endif;
