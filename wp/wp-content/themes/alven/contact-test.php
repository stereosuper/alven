<?php
/*
Template Name: Contact Test
*/

if(!function_exists( 'wp_handle_upload' )){
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
}

function wpse_183245_upload_dir( $dirs ){
    $dirs['subdir'] = '/pitch';
    $dirs['path'] = $dirs['basedir'] . '/pitch';
    $dirs['url'] = $dirs['baseurl'] . '/pitch';

    return $dirs;
}

$mailto = 'elisabeth@stereosuper.fr';

$status = '';
$errorFirstname = '';
$errorLastname = '';
$errorEmail = '';
$errorMsg = '';
$errorSend = '';
$errorUrl = '';

$firstname = isset($_POST['firstname1']) ? strip_tags(stripslashes($_POST['firstname1'])) : '';
$lastname = isset($_POST['lastname1']) ? strip_tags(stripslashes($_POST['lastname1'])) : '';
$email = isset($_POST['email1']) ? strip_tags(stripslashes($_POST['email1'])) : '';
$file = isset($_FILES['pitchfile']) ? $_FILES['pitchfile'] : '';
$url = isset($_POST['pitchurl']) ? strip_tags(stripslashes($_POST['pitchurl'])) : '';
$msg = isset($_POST['pitchtext']) ? strip_tags(stripslashes($_POST['pitchtext'])) : '';

if(isset($_POST['submitpitch'])){

    if(empty($firstname)){
        $status = 'error';
        $errorFirstname = true;
    }
    if(empty($lastname)){
        $status = 'error';
        $errorLastname = true;
    }
    if(empty($msg)){
        $status = 'error';
        $errorMsg = true;
    }
    if(empty($email)){
        $status = 'error';
        $errorEmail = true;
    }

    if(!preg_match('/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i', $email)){
        $status = 'error';
        $errorEmail = true;
    }

    if(!empty($file['name'])){
        print_r($file);
        add_filter( 'upload_dir', 'wpse_183245_upload_dir' );
        /*$allowedMimes = array(
            'jpg|jpeg|jpe' => 'image/jpeg',
            'gif'          => 'image/gif',
            'png'          => 'image/png',
        );

        $fileInfo = wp_check_filetype(basename($_FILES['wpshop_file']['name']), $allowedMimes);*/
        $overrides = array( 'test_form' => FALSE/*, 'mimes' => $allowedMimes*/ );
        $fileInfo = wp_check_filetype(basename($file['name']));
        if(!empty($fileInfo['ext'])){
            $movefile = wp_handle_upload( $file, $overrides );
            remove_filter( 'upload_dir', 'wpse_183245_upload_dir' );
            if(!$movefile && isset($movefile['error'])){
                $status = 'error';
                $errorSend = 'Sorry, your file couldn\'t be uploaded: ' . $movefile['error'];
            }
        }else{
            $status = 'error';
            $errorSend = 'Sorry, your file couldn\'t be uploaded: the file extension isn\'t valid.';
        }

        //var_dump($movefile);
        //echo $movefile['file'];
        //echo WP_CONTENT_DIR;
    }else{
        if(empty($url)){
            $status = 'error';
            $errorUrl = true;
        }
    }

    if(!$status){

        $name = sprintf('%s %s', $firstname, $lastname);
        $subject = 'New pitch received from alvencapital.com';
        $headers = 'From: "' . $name . '" <' . $email . '>' . "\r\n" .
                   'Reply-To: ' . $email . "\r\n";

        $content = 'From: ' . $name . "\r\n" .
                   'Email: ' . $email . "\r\n" .
                   'Pitch: ' . $url . "\r\n\r\n\r\n" .
                   'Message: ' . "\r\n" . $msg;

        $attachment = isset($movefile) ? array($movefile['file']) : array();

        $sent = wp_mail($mailto, $subject, $content, $headers, $attachment);

        if($sent){
            $status = 'succes';
        }else{
            $status = 'error';
            $errorSend = 'Sorry, an error occured and you pitch couldn\'t be send. Please try again later!';
        }
    }

    //echo $status . $errorSend;
}


get_header(); ?>

    <?php if ( have_posts() ) : the_post(); ?>

        <section class='content-header-transparent'>
            <h2 class='section-title'><?php the_title(); ?></h2>
            <strong class='subtitle'><?php the_field('subtitle'); ?></strong>
        </section>

        <main role='main' id='main'>
            <article class='content-main theme-gold' id='mainContent'>
                <div class='container'>
                    <form action='<?php the_permalink(); ?>' method='post' enctype='multipart/form-data' class='align-left form-to-open'>
                        <fieldset>
                            <legend class='active'>Let's <span>Introduce yourself</span></legend>
                            <section class='form-section <?php if($errorFirstname || $errorLastname || $errorEmail) echo "invalid"; ?>'>
                                <div>
                                    <input type='text' name='firstname1' id='firstname1' required class='form-elt <?php if($errorFirstname) echo "invalid"; ?>' value='<?php echo $firstname; ?>'>
                                    <label for='firstname1'>Your firstname</label>
                                </div><div>
                                    <input type='text' name='lastname1' id='lastname1' required class='form-elt <?php if($errorLastname) echo "invalid"; ?>' value='<?php echo $lastname; ?>'>
                                    <label for='lastname1'>Your lastname</label>
                                </div><div class='large'>
                                    <input type='email' name='email1' id='email1' required class='form-elt <?php if($errorEmail) echo "invalid"; ?>' value='<?php echo $email; ?>'>
                                    <label for='email1'>Your email</label>
                                </div>
                            </section>
                        </fieldset>
                        <fieldset>
                            <legend>Send us <span>Your amazing pitch</span></legend>
                            <section class='form-section <?php if($errorUrl || $errorMsg) echo "invalid"; ?>'>
                                <div class='full'>
                                    <input type='file' name='pitchfile' id='pitchfile'><label for='pitchfile'>
                                        Upload your file
                                    </label><span class='form-desc'>
                                        a lightweight .pdf, .doc, .ptt, ...
                                    </span>
                                </div>
                                <span class='form-title'>Or</span>
                                <div class='full'>
                                    <input type='url' name='pitchurl' id='pitchurl' class='form-elt <?php if($errorUrl) echo "invalid"; ?>'><label for='pitchurl' value='<?php echo $url; ?>'>
                                        Send us your link
                                    </label><span class='form-desc'>
                                        a web page which describe your product or service
                                    </span>
                                </div>
                                <span class='form-title'>And</span>
                                <div class='full'>
                                    <textarea name='pitchtext' id='pitchtext' required class='form-elt <?php if($errorMsg) echo "invalid"; ?>'><?php echo $msg; ?></textarea>
                                    <label for='ptichtext'>Write us a few word there about what you expect from us</label>
                                </div>
                            </section>
                        </fieldset>
                        <button type='submit' name='submitpitch' class='btn-invert'>Confirm</button>
                    </form>
                </div>
            </article>
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

    <?php endif; ?>

<?php get_footer(); ?>
