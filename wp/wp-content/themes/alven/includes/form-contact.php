<?php

if(!function_exists( 'wp_handle_upload' )){
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
}

function wpse_183245_upload_dir( $dirs ){
    $dirs['subdir'] = '/pitch';
    $dirs['path'] = $dirs['basedir'] . '/pitch';
    $dirs['url'] = $dirs['baseurl'] . '/pitch';
    return $dirs;
}


$mailto = 'contact@alvencapital.com';

$status = '';
$errorFirstname = '';
$errorLastname = '';
$errorEmail = '';
$errorMsg = '';
$errorSend = '';
$errorUrl = '';
$errorFile = '';

$firstname = isset($_POST['firstname1']) ? strip_tags(stripslashes($_POST['firstname1'])) : '';
$lastname = isset($_POST['lastname1']) ? strip_tags(stripslashes($_POST['lastname1'])) : '';
$email = isset($_POST['email1']) ? strip_tags(stripslashes($_POST['email1'])) : '';
$file = isset($_FILES['pitchfile']) ? $_FILES['pitchfile'] : '';
$url = isset($_POST['pitchurl']) ? strip_tags(stripslashes($_POST['pitchurl'])) : '';
$msg = isset($_POST['pitchtext']) ? strip_tags(stripslashes($_POST['pitchtext'])) : '';

$spamUrl = isset($_POST['url']) ? strip_tags(stripslashes($_POST['url'])) : '';

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

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $status = 'error';
        $errorEmail = true;
    }else{
        list($userName, $mailDomain) = split('@', $email);
        // let's check if the email domain exists as a security mesure (go to hell, spammer!)
        if(!checkdnsrr($mailDomain, 'MX')){
            $status = 'error';
            $errorEmail = true;
        }
    }

    if(!empty($file['name'])){

        if($file['size'] > 20971520){
            $status = 'error';
            $errorFile = true;
            $errorSend = 'Sorry, your pitch couldn\'t be send: the uploaded file is too heavy.';
        }else{
            add_filter( 'upload_dir', 'wpse_183245_upload_dir' );
            $allowedMimes = array(
                'pdf' => 'application/pdf',
                'ppt' => 'application/vnd.ms-powerpoint',
                'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'key' => 'application/x-iWork-keynote-sffkey',
                'zip' => 'application/zip'
            );
            $fileInfo = wp_check_filetype(basename($file['name']), $allowedMimes);
            $overrides = array( 'test_form' => FALSE, 'mimes' => $allowedMimes );
            if(!empty($fileInfo['ext'])){
                $movefile = wp_handle_upload( $file, $overrides );
                remove_filter( 'upload_dir', 'wpse_183245_upload_dir' );
                if(!$movefile && isset($movefile['error'])){
                    $status = 'error';
                    $errorFile = true;
                    $errorSend = 'Sorry, your pitch couldn\'t be send, the file couldn\'t be uploaded: ' . $movefile['error'];
                }
            }else{
                $status = 'error';
                $errorFile = true;
                $errorSend = 'Sorry, your pitch couldn\'t be send: the uploaded file extension isn\'t valid.';
            }
        }

    }else{
        if(empty($url)){
            $status = 'error';
            $errorUrl = true;
        }
    }

    if($status === 'error' && !$errorSend){
        $errorSend = 'Sorry, your pitch counldn\'t be send, the form contains errors. Please check the red fields.';
    }

    if(!$status){

        if(empty($spamUrl)){

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
                $status = 'success';
            }else{
                $status = 'error';
                $errorSend = 'Sorry, an error occured and you pitch couldn\'t be send. Please try again later!';
            }

        }else{
            // if the url field is not empty, then is probably a spammer! so we don't send the email, but make him
            // think ye got whant he wanted
            // http://www.nfriedly.com/techblog/2009/11/how-to-build-a-spam-free-contact-forms-without-captchas/
            $status = 'success';
        }
    }

    //echo $status . $errorSend;
}



$status2 = '';
$errorFirstname2 = '';
$errorLastname2 = '';
$errorEmail2 = '';
$errorMsg2 = '';
$errorSend2 = '';

$firstname2 = isset($_POST['firstname2']) ? strip_tags(stripslashes($_POST['firstname2'])) : '';
$lastname2 = isset($_POST['lastname2']) ? strip_tags(stripslashes($_POST['lastname2'])) : '';
$email2 = isset($_POST['email2']) ? strip_tags(stripslashes($_POST['email2'])) : '';
$msg2 = isset($_POST['msg']) ? strip_tags(stripslashes($_POST['msg'])) : '';

$spamUrl2 = isset($_POST['url2']) ? strip_tags(stripslashes($_POST['url2'])) : '';

if(isset($_POST['submitcontact'])){

    if(empty($firstname2)){
        $status2 = 'error';
        $errorFirstname2 = true;
    }
    if(empty($lastname2)){
        $status2 = 'error';
        $errorLastname2 = true;
    }
    if(empty($msg2)){
        $status2 = 'error';
        $errorMsg2 = true;
    }
    if(empty($email2)){
        $status2 = 'error';
        $errorEmail2 = true;
    }

    if(!preg_match('/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i', $email2)){
        $status2 = 'error';
        $errorEmail2 = true;
    }

    if($status2 === 'error'){
        $errorSend = 'Sorry, your message counldn\'t be send, the form contains errors. Please check the red fields.';
    }

    if(!$status2){

        if(empty($spamUrl2)){

            $name2 = sprintf('%s %s', $firstname2, $lastname2);
            $subject2 = 'New message received from alvencapital.com';
            $headers2 = 'From: "' . $name2 . '" <' . $email2 . '>' . "\r\n" .
                        'Reply-To: ' . $email2 . "\r\n";

            $content2 = 'From: ' . $name2 . "\r\n" .
                        'Email: ' . $email2 . "\r\n\r\n\r\n" .
                        'Message: ' . "\r\n" . $msg2;

            $sent2 = wp_mail($mailto, $subject2, $content2, $headers2);

            if($sent2){
                $status2 = 'success';
            }else{
                $status2 = 'error';
                $errorSend2 = 'Sorry, an error occured and you message couldn\'t be send. Please try again later!';
            }

        }else{
            $status2 = 'success';
        }
    }
}

?>
