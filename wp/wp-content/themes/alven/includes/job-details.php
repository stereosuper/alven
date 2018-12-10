<?php
                                
echo '<div class="flex-container details-job">';
    echo '<div class="details-job-main">';
        $details_header = '<header class="flex-container details-job-header">';
            $details_header .= '<a href="'. $company_datas['permalink'] .'" title="'. $company_datas['permalink'] .'"><figure class="company-image">';
                $details_header .= '<img src="' . $company_datas['logo_url'] . '" alt="' . $company_datas['name'] . '">';
            $details_header .= '</figure></a>';
            $details_header .= '<div class="company-info-wrapper">';
                $details_header .= '<div><p class="title-small">' . __('Job Type', 'alven') . '</p><p>Permanent Contract</p></div>';
                $details_header .= '<div><p class="title-small">' . __('Location', 'alven') . '</p><p>Paris</p></div>';
                if (!empty($company_datas['sectors'])):
                    $details_header .= '<ul class="company-sector">';
                    foreach ($company_datas['sectors'] as $key => $value) {
                        $details_header .= '<li>' . $value->name . '</li>';
                    }
                    $details_header .= '</ul>';
                endif;
            $details_header .= '</div>';
        $details_header .= '</header>';
        echo $details_header;

        $details_section = '<section class="job-details-main-content">';
        if ($details):
            if ($details['job_details_about']):
                $details_section .= '<div class="js-job-details-tab">';
                $details_section .= '<h2 class="job-single-title">' . __('About', 'alven') . '&nbsp' . $company_datas['name'] . '<i class="icon-arrow-tip"></i></h2>';
                $details_section .= $details['job_details_about'];
                $details_section .= '</div>';
            endif;
            if ($details['job_details_desc']):
                $details_section .= '<div class="js-job-details-tab">';
                $details_section .= '<h2 class="job-single-title">' . __('Job description', 'alven') . '<i class="icon-arrow-tip"></i></h2>';
                $details_section .= $details['job_details_desc'];
                $details_section .= '</div>';
            endif;
            if ($details['job_details_profil']):
                $details_section .= '<div class="js-job-details-tab">';
                $details_section .= '<h2 class="job-single-title">' . __('Profile', 'alven') . '<i class="icon-arrow-tip"></i></h2>';
                $details_section .= $details['job_details_profil'];
                $details_section .= '</div>';
            endif;
            if ($details['job_details_why']):
                $details_section .= '<div class="js-job-details-tab">';
                $details_section .= '<h2 class="job-single-title">' . __('Why you should join us', 'alven') . '<i class="icon-arrow-tip"></i></h2>';
                $details_section .= $details['job_details_why'];
                $details_section .= '</div>';
            endif;
            if ($details['job_details_process']):
                $details_section .= '<div class="js-job-details-tab">';
                $details_section .= '<h2 class="job-single-title">' . __('Hiring Process', 'alven') . '<i class="icon-arrow-tip"></i></h2>';
                $details_section .= $details['job_details_process'];
                $details_section .= '</div>';
            endif;
        endif;
        $details_section .= '</section>';
        echo $details_section;
    echo '</div>';

    echo '<div class="details-job-sidebar wrapper-collant">';
        echo '<div class="js-details-job-sidebar">';
            if ($urlapply):
                echo '<a href="' . $urlapply . '" alt="' . __('Apply', 'alven') . '" tarrget="_blank" rel="noopener noreferrer" class="btn">' . __('Apply', 'alven') . '</a>';
            endif;
            $job_company = '<div class="company-info">';
                $job_company .= '<p class="title-small">' . __('The company', 'alven') . '</p>';
                $job_company .= '<a href="'. $company_datas['permalink'] .'" title="'. $company_datas['permalink'] .'"><figure class="company-image">';
                    $job_company .= '<img src="' . $company_datas['logo_url'] . '" alt="' . $company_datas['name'] . '">';
                $job_company .= '</figure></a>';
                $job_company .= '<p class="title-small">' . __('Sectors', 'alven') . '</p>';
                if (!empty($company_datas['sectors'])):
                    $job_company .= '<ul class="company-sector">';
                    foreach ($company_datas['sectors'] as $key => $value) {
                        $job_company .= '<li>' . $value->name . '</li>';
                    }
                    $job_company .= '</ul>';
                endif;
            $job_company .= '</div>';
            echo $job_company;
        echo '</div>';
    echo '</div>';
echo '</div>';