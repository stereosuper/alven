<?php

$status_job = '';
$errorFirstname_job = '';
$errorLastname_job = '';
$errorEmail_job = '';
$errorMsg_job = '';
$errorSend_job = '';

$firstname_job = isset($_POST['firstname_job']) ? strip_tags(stripslashes($_POST['firstname_job'])) : '';
$lastname_job = isset($_POST['lastname_job']) ? strip_tags(stripslashes($_POST['lastname_job'])) : '';
$email_job = isset($_POST['email_job']) ? strip_tags(stripslashes($_POST['email_job'])) : '';
$msg_job = isset($_POST['msg']) ? strip_tags(stripslashes($_POST['msg'])) : '';

$spamUrl_job = isset($_POST['url_job']) ? strip_tags(stripslashes($_POST['url_job'])) : '';

if(isset($_POST['submitcontact'])){

    if(empty($firstname_job)){
        $status_job = 'error';
        $errorFirstname_job = true;
    }
    if(empty($lastname_job)){
        $status_job = 'error';
        $errorLastname_job = true;
    }
    if(empty($msg_job)){
        $status_job = 'error';
        $errorMsg_job = true;
    }
    if(empty($email_job)){
        $status_job = 'error';
        $errorEmail_job = true;
    }

    if(!preg_match('/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i', $email2)){
        $status_job = 'error';
        $errorEmail_job = true;
    }

    if($status_job === 'error'){
        $errorSend = 'Sorry, your message counldn\'t be send, the form contains errors. Please check the red fields.';
    }

    if(!$status_job){

        if(empty($spamUrl_job)){

            $name_job = sprintf('%s %s', $firstname_job, $lastname_job);
            $subject_job = 'New message received from alven.co';
            $headers_job = 'From: "' . $name_job . '" <' . $email_job . '>' . "\r\n" .
                        'Reply-To: ' . $email_job . "\r\n";

            $content_job = 'From: ' . $name_job . "\r\n" .
                        'Email: ' . $email_job . "\r\n\r\n\r\n" .
                        'Message: ' . "\r\n" . $msg_job;

            $sent_job = wp_mail($mailtoContact, $subject_job, $content_job, $headers_job);

            if($sent_job){
                $status_job = 'success';
            }else{
                $status_job = 'error';
                $errorSend_job = 'Sorry, an error occured and you message couldn\'t be send. Please try again later!';
            }

        }else{
            $status_job = 'success';
        }
    }
}