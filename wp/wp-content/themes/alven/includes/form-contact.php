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


$mailto = 'elisabeth@stereosuper.fr';

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
        //print_r($file);
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
                $errorFile = true;
                $errorSend = 'Sorry, your file couldn\'t be uploaded: ' . $movefile['error'];
            }
        }else{
            $status = 'error';
            $errorFile = true;
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

    if($status === 'error' && !$errorSend){
        $errorSend = 'Sorry, your pitch counldn\'t be send, the form contains errors. Please check the red fields.';
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
            $status = 'success';
        }else{
            $status = 'error';
            $errorSend = 'Sorry, an error occured and you pitch couldn\'t be send. Please try again later!';
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
    }
}

?>
