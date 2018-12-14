<?php

// DATAS
if( !$is_details_wrkbl ):
    $location = $job_startup['location'][0]->name;
    $type     = $job_startup['type'][0]->name;

    $content  = '';
    if ( $job_startup['details'] ):
        if ( $job_startup['details']['job_details_about'] ):
            $content .= '<div class="js-job-details-tab">';
            $content .= '<h2 class="job-single-title">' . __('About', 'alven') . '&nbsp' . $job_startup['startup_datas']['name'] . '<i class="icon-arrow-tip"></i></h2>';
            $content .= $job_startup['details']['job_details_about'];
            $content .= '</div>';
        endif;
        if ( $job_startup['details']['job_details_desc'] ):
            $content .= '<div class="js-job-details-tab">';
            $content .= '<h2 class="job-single-title">' . __('Job description', 'alven') . '<i class="icon-arrow-tip"></i></h2>';
            $content .= $job_startup['details']['job_details_desc'];
            $content .= '</div>';
        endif;
        if ( $job_startup['details']['job_details_profil'] ):
            $content .= '<div class="js-job-details-tab">';
            $content .= '<h2 class="job-single-title">' . __('Profile', 'alven') . '<i class="icon-arrow-tip"></i></h2>';
            $content .= $job_startup['details']['job_details_profil'];
            $content .= '</div>';
        endif;
        if ( $job_startup['details']['job_details_why'] ):
            $content .= '<div class="js-job-details-tab">';
            $content .= '<h2 class="job-single-title">' . __('Why you should join us', 'alven') . '<i class="icon-arrow-tip"></i></h2>';
            $content .= $job_startup['details']['job_details_why'];
            $content .= '</div>';
        endif;
        if ( $job_startup['details']['job_details_process'] ):
            $content .= '<div class="js-job-details-tab">';
            $content .= '<h2 class="job-single-title">' . __('Hiring Process', 'alven') . '<i class="icon-arrow-tip"></i></h2>';
            $content .= $job_startup['details']['job_details_process'];
            $content .= '</div>';
        endif;
    endif;

    $job_company_logo = $job_startup['startup_link'] ? '<a class="company-image" href="'. $job_startup['startup_link'] .'" target="_blank" rel="noopener noreferer" title="'. __('Lien vers ','alven') . $job_startup['startup_datas']['name'] .'">' : '<div class="company-image">';
    $job_company_logo .= '<figure>';
    $job_company_logo .= '<img src="' . $job_startup['startup_datas']['logo_url'] . '" alt="' . $job_startup['startup_datas']['name'] . '">';
    $job_company_logo .= '</figure>';
    $job_company_logo .= $job_startup['startup_link'] ? '</a>' : '</div>';

    $job_company_link = $job_startup['urlapply'];
else:
    $location = $job_alven['location']['city'];
    $type     = $job_alven['employment_type'];

    $content  = '';
    if( !empty( $job_alven['full_description'] ) ):
        $content .= '<p><strong>Description</strong></p>';
        $content .= $job_alven['full_description'];
    endif;
    
    $job_company_logo  = '<a class="company-image" href="' . home_url( '/' ) . '" title="' . get_bloginfo( 'name' ) . '" rel="home"><figure>';
    $job_company_logo .= '<svg xmlns="http://www.w3.org/2000/svg" width="95" height="69" viewBox="0 0 95 69">
    <path d="M9.8 64.053a4.473 4.473 0 1 0-.03-8.946 4.473 4.473 0 0 0 .03 8.946m-.63-13.928c2.69 0 4.39.807 5.38 2.49v-1.858h5.02V68.4h-5.02v-1.894c-.85 1.684-2.66 2.49-5.52 2.49-5.35 0-9.03-3.858-9.03-9.437 0-5.543 3.79-9.438 9.17-9.438m16.46-5.227h5.34v23.5h-5.34V44.9zm9.06 5.86h5.52l3.43 11.015 3.43-11.016h5.53L46.19 68.4h-5.13zM68.31 57.7a3.9 3.9 0 0 0-4.03-3.052 3.84 3.84 0 0 0-4 3.052h8.03zm-4.07-7.543a9.3 9.3 0 0 1 9.38 9.648 6.193 6.193 0 0 1-.14 1.44H60.17a3.734 3.734 0 0 0 3.89 3.3 4.023 4.023 0 0 0 3.26-1.4l.25-.247h5.45c-1.66 3.824-4.89 6.1-8.71 6.1a9.42 9.42 0 0 1-.07-18.84m14.27.6h5.02v1.86a5.34 5.34 0 0 1 4.89-2.457 6.9 6.9 0 0 1 4.81 1.79c1.34 1.263 1.77 2.632 1.77 5.44V68.4h-5.34v-9.61a4.3 4.3 0 0 0-.54-2.6 2.675 2.675 0 0 0-2.26-1.087 3.02 3.02 0 0 0-2.51 1.228 3.236 3.236 0 0 0-.5 2.21v9.86h-5.34V50.757zm-28.78-38.56a17.685 17.685 0 0 1-.23-1.767q-1.035-.493-1.98-.93a6.7 6.7 0 0 0 .25 4.33c.58 1.43.4 4.352-.4 7.215a11.816 11.816 0 0 1-1.79 3.45c.26.368.58.812.96 1.32a17.49 17.49 0 0 0 2.85-5.63 15.022 15.022 0 0 0 .34-7.987m10.35 3.352l-2.02-.974c-.75.736-1.42 1.33-1.83 1.686-1.68 2.388-2.16 2.566-1.88 1.06a31.032 31.032 0 0 0 1.17-3.98c-.59-.29-1.18-.576-1.76-.857-.37 1.884-.76 3.628-1 4.61-.42 1.78.75 4.567-4.97 10.344.19.245.39.5.61.76.12.115.25.233.38.35 1.88-2.133 4.13-4.76 6.03-7.076 1.66-2.01 3.63-3.962 5.27-5.924m.95 5.475c.84-1.454 1.61-2.77 2.25-3.947-.68-.322-1.39-.66-2.08-.993a19.13 19.13 0 0 0-2 3.9c-.23.744-1.79 3.264-5.43 6.7-1.18 1.12-2.42 2.23-3.54 3.3.25.26.5.522.75.786a30.192 30.192 0 0 1 2.61-2.008c2.27-1.85 5.74-4.808 7.44-7.735m-30.42-1.67c-.02.038-.05.078-.07.12a10.82 10.82 0 0 1 .4 3.594c-.25 2.886.34 5.613.96 4.916a23.365 23.365 0 0 0 1.42-4.356c.13-1.444-1.08-4.56-1.41-7.586-.55 1.437-.98 2.674-1.3 3.312m29.74 9.25l.21-.235a45.3 45.3 0 0 0-7.76 4.43c.41.474.8.947 1.18 1.413a10.217 10.217 0 0 1 1.99-1.257 12.5 12.5 0 0 0 2.02-1.366 36.59 36.59 0 0 1 2.36-2.985m-31.05-5.11a4.7 4.7 0 0 0-.09-1.273 31.272 31.272 0 0 0-2.24 4.873 15.363 15.363 0 0 0 .88 3.113 8.65 8.65 0 0 1 .27 1.855 10.16 10.16 0 0 0 .64.824 2.9 2.9 0 0 0 1.9 1.084c.04-.414.06-.848.08-1.3.01-.213.03-.43.05-.647a27.11 27.11 0 0 0-.97-3.848 8.716 8.716 0 0 1-.52-4.68m13.1-12.24c-.81 2.463-.98 3.952-.75 7.788s-.52 5.153-1.56 6.24a8.22 8.22 0 0 0-1.52 2.237 33.388 33.388 0 0 1 3.93-2.176 27.927 27.927 0 0 0 1.86-9.336 13.837 13.837 0 0 1 .23-4.638 26.392 26.392 0 0 0 .62-2.91c-.93-.4-1.72-.718-2.35-.93a10.71 10.71 0 0 1-.46 3.726m22.54 11.29c.77-1.22.89-2.743 1.49-4.015-.76-.34-.96-.435-1.76-.8-1.72 2.7-3.97 6.447-4.19 7.854a28.73 28.73 0 0 0 4.46-3.033m-25.9-10.976c1.55-1.948 1.28-6.785 1.69-9.763a9.706 9.706 0 0 1 .35-1.54l-.03-.263a39.79 39.79 0 0 0-3.53 3.176l-.62-.823-.24.294-.16 3.524s.98-1.136 1.62-1.793a.018.018 0 0 1 .01 0c2.31-2.12-1.16 3.092-2.6 6.528a11.13 11.13 0 0 0-.78 3.913 12.957 12.957 0 0 0 .1 2.306v.033a18.383 18.383 0 0 0 .8 3.368 6.447 6.447 0 0 1-.35 4.924 10.45 10.45 0 0 0-1.56 4.58 21.39 21.39 0 0 1-.12 2.622 11.564 11.564 0 0 0 1.61-1.95 10.572 10.572 0 0 1 1.52-1.756c-.01-1.018-.17-2.55.74-3.555 1.04-1.145.77-4.213.66-6.5s-.66-5.363.89-7.326m19.62 28.363c.8-5.336 5.16-9.533 6.14-11.026 1.06-1.132 4.95-5.7 2.35-10.3-.11 1.63.38 4.64-2.77 8.065-6.18 5.918-7.14 11.53-7.14 11.53l1.28 2.5z"/>
    </svg>';
    $job_company_logo .= '</figure></a>';
    
    $job_company_link = $job_alven['application_url'];
endif;


// TEMPLATE
echo '<div class="flex-container details-job">';
    echo '<div class="details-job-main">';
        $details_header = '<header class="flex-container details-job-header">';
            $details_header .= '<a class="company-image" href="'. $job_startup['startup_datas']['permalink'] .'" title="'. $job_startup['startup_datas']['name'] .'"><figure>';
                $details_header .= '<img src="' . $job_startup['startup_datas']['logo_url'] . '" alt="' . $job_startup['startup_datas']['name'] . '">';
            $details_header .= '</figure></a>';
            $details_header .= '<div class="company-info-wrapper">';
                $details_header .= '<div><p class="title-small">' . __('Job Type', 'alven') . '</p><p>'. $type .'</p></div>';
                $details_header .= '<div><p class="title-small">' . __('Location', 'alven') . '</p><p>'. $location .'</p></div>';
                if (!empty( $job_startup['startup_datas']['sectors'] )):
                    $details_header .= '<ul class="company-sector">';
                    foreach ($job_startup['startup_datas']['sectors'] as $key => $value) {
                        $details_header .= '<li>' . $value->name . '</li>';
                    }
                    $details_header .= '</ul>';
                endif;
            $details_header .= '</div>';
        $details_header .= '</header>';
        echo $details_header;

        $details_section = '<section class="job-details-main-content">';
            $details_section .= $content;
        $details_section .= '</section>';
        echo $details_section;
    echo '</div>';

    echo '<div class="details-job-sidebar wrapper-collant" data-collant="1">';
        echo '<div class="js-details-job-sidebar" data-collant="1">';
            if ( $job_company_link ):
                echo '<a data-collant="3" href="' . $job_company_link . '" alt="' . __('Apply', 'alven') . '" target="_blank" rel="noopener noreferrer" class="btn js-apply-btn">' . __('Apply', 'alven') . '</a>';
            endif;
            $job_company = '<div class="company-info">';
                $job_company .= '<p class="title-small">' . __('The company', 'alven') . '</p>';
                $job_company .= $job_company_logo;
                if( !$is_details_wrkbl ):
                    $job_company .= '<p class="title-small">' . __('Sectors', 'alven') . '</p>';
                    if ( !empty( $job_startup['startup_datas']['sectors'] ) ):
                        $job_company .= '<ul class="company-sector">';
                        foreach ($job_startup['startup_datas']['sectors'] as $key => $value) {
                            $job_company .= '<li>' . $value->name . '</li>';
                        }
                        $job_company .= '</ul>';
                    endif;
                endif;
            $job_company .= '</div>';
            echo $job_company;
        echo '</div>';
    echo '</div>';
echo '</div>';