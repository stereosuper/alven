<?php

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