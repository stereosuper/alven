<?php if ($jobs_alven && !empty($jobs_alven)): ?>
    <section class='alven-jobs'>
        <div class='container flex-container'>
            <div class='col-3 no-padding-left'>
                <h2 class='job-sidebar-title'><?php _e('Alven jobs', 'alven')?></h2>
                <p><?php _e('Join the Alven team', 'alven')?></p>
            </div>

            <div class='col-8 no-padding-right'>
                <div class="list-jobs-alven flex-container">
                    <?php
                    foreach ($jobs_alven as $key => $job_alven) {
                        $job_alven_link = '<a href="' . $job_alven['url'] . '" class="job-alven">';
                        $job_alven_link .= '<p class="job-title-alven">' . $job_alven['title'] . '</p>';
                        // Line below do the trick also
                        // $job_alven_location = ($job_alven['location']['city'] && $job_alven['location']['country'] ? $job_alven['location']['city'] . ',&nbsp;' . $job_alven['location']['country'] : ($job_alven['location']['city'] ? $job_alven['location']['city'] : $job_alven['location']['country']));
                        $job_alven_location = join(',&nbsp;', array_filter([$job_alven['location']['city'], $job_alven['location']['country']]));
                        $job_alven_link .= '<p class="job-location-alven">' . $job_alven_location . '</p>';
                        $job_alven_link .= '</a>';
                        echo $job_alven_link;
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>

    <section class='workable-form-application'>
        <h2><?php _e('Direct application','alven'); ?></h2>
        <div class="separator"></div>
        <div class='container flex-container'>
            <div class='col-3 no-padding-left'>
                <?php the_field('career_directapp_desc');?>
            </div>
            <div class='col-8 no-padding-right'>
            <?php if ($status_job === 'success'): ?>
                <p class='form-success'><?php _e('Your message has been sent!<br> Thank you, we will be back to you shortly.', 'alven');?></p>
            <?php else: ?>
                <?php if ($errorSend_job): ?>
                    <p class='form-error'><?php echo $errorSend_job; ?></p>
                <?php endif;?>
                <form action='<?php the_permalink();?>' method='post' class='form-to-open form-wrkbl-to-open' enctype='multipart/form-data' autocomplete='off'>
                    <fieldset>
                        <legend class='active'><?php _e('Please', 'alven');?><span><?php _e('Introduce yourself', 'alven');?></span></legend>
                        <section class='form-section form-section-inline <?php if ( $errorFirstname_job || $errorLastname_job || $errorEmail_job ) { echo "invalid"; } ?>'>
                            <div>
                                <input type='text' name='firstname_job' id='firstname_job' required class='form-elt <?php if ($errorFirstname_job) { echo "invalid"; } ?>' value='<?php echo $firstname_job; ?>'>
                                <label for='firstname_job'><?php _e('Your first name', 'alven');?></label>
                            </div>
                            <div>
                                <input type='text' name='lastname_job' id='lastname_job' required class='form-elt <?php if ($errorLastname_job) { echo "invalid"; } ?>' value='<?php echo $lastname_job; ?>'>
                                <label for='lastname_job'><?php _e('Your last name', 'alven');?></label>
                            </div>
                            <div>
                                <input type='email' name='email_job' id='email_job' required class='form-elt <?php if ($errorEmail_job) { echo "invalid"; } ?>' value='<?php echo $email_job; ?>'>
                                <label for='email_job'><?php _e('Your email', 'alven');?></label>
                            </div>
                        </section>
                    </fieldset>
                    <fieldset>
                        <legend><?php _e('Send us','alven'); ?><span><?php _e('Your document (CV, recommandations...)','alven'); ?></span></legend>
                        <section class='form-section'>
                            <div class='full has-desc margin-bottom-large'>
                                <input type='file' name='document_job' id='document_job' required class='form-elt <?php if ($errorDocument_job) { echo "invalid"; } ?>'>
                                <label for='document_job'><?php _e('Upload your file','alven'); ?></label>
                                <span class='form-desc'><?php _e('.pdf, .doc, .docx, .rtf','alven'); ?></span>
                            </div>
                            <div class='full has-desc'>
                                <input type='url' name='url_job' id='url_job' class='form-elt <?php if($errorUrl_job) echo "invalid"; ?>'>
                                <label for='url_job' value='<?php echo $url_job; ?>'>
                                    <?php _e('Insert here a link to your linkedin page (or other)','alven'); ?>
                                </label>
                            </div>
                            <div class='hidden'>
                                <input type='url' name='spam_job' id='spam_job' value='<?php echo $spamUrl_job; ?>'>
                                <label for='spam_job'><?php _e('Leave this field empty please','alven'); ?></label>
                            </div>
                        </section>
                    </fieldset>
                    <button type='submit' name='directappsubmit' class='btn-invert margin-top-large'><?php _e('Confirm','alven'); ?></button>
                </form>
            <?php endif;?>
        </div>
    </div>
</section>