<?php

$mailtoContact = get_field('mailList', 'option');

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
    }else if(!filter_var(sanitize_email($email2), FILTER_VALIDATE_EMAIL)){
        $status2 = 'error';
        $errorEmail2 = true;
    }

    if($status2 === 'error'){
        $errorSend = 'Sorry, your message counldn\'t be send, the form contains errors. Please check the red fields.';
    }

    if(!$status2){

        if(empty($spamUrl2)){

            $name2 = sprintf('%s %s', $firstname2, $lastname2);
            $subject2 = 'New message received from alven.co';
            $headers2 = 'From: "' . $name2 . '" <' . $email2 . '>' . "\r\n" .
                        'Reply-To: ' . $email2 . "\r\n";

            $content2 = 'From: ' . $name2 . "\r\n" .
                        'Email: ' . $email2 . "\r\n\r\n\r\n" .
                        'Message: ' . "\r\n" . $msg2;

            $sent2 = wp_mail($mailtoContact, $subject2, $content2, $headers2);

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
