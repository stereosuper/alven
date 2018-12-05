<?php

$status_job         = false;
$errorFirstname_job = '';
$errorLastname_job  = '';
$errorEmail_job     = '';
$errorMsg_job       = '';
$errorSend_job      = '';

$firstname_job = isset($_POST['firstname_job']) ? strip_tags(stripslashes($_POST['firstname_job'])) : '';
$lastname_job  = isset($_POST['lastname_job']) ? strip_tags(stripslashes($_POST['lastname_job'])) : '';
$email_job     = isset($_POST['email_job']) ? strip_tags(stripslashes($_POST['email_job'])) : '';
$spamUrl_job   = isset($_POST['url_job']) ? strip_tags(stripslashes($_POST['url_job'])) : '';

var_dump( $_POST['directappsubmit'] );
if( isset( $_POST['directappsubmit'] ) ){
    var_dump( 'pass' );
    if( empty($firstname_job) ){
        $status_job = 'error';
        $errorFirstname_job = true;
    }
    if( empty($lastname_job) ){
        $status_job = 'error';
        $errorLastname_job = true;
    }
    if( empty($email_job) ){
        $status_job = 'error';
        $errorEmail_job = true;
    }

    if( !preg_match('/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i', $email_job) ){
        $status_job = 'error';
        $errorEmail_job = true;
    }

    if( $status_job === 'error' ){
        $errorSend_job = 'Sorry, your message counldn\'t be send, the form contains errors. Please check the red fields.';
    }

    if( !$status_job ){

        if( empty( $spamUrl_job ) ){

            $send = array(
                    "firstname" => "Jj", 
                    "lastname" => "Botha", 
                    "email" => "jj_botha@fakemail.com"
            );

            var_dump( json_encode( $send ) );

            $workable_datas = null;
            $subdomain = 'alven'; 
            $token     = '74069b76972b9edc000610fd9cd1f2f9945483d3425e7483467d0faa6f43680b';
            $shortcode = 'E0D70C0FF7';
            $workable_args = array(
                'headers' => array(
                    'Content-Type: application/json',
                    'Authorization' => 'Bearer ' . $token,
                    'Accept: application/json'
                ),
                'body'    => array(
                    'candidate' => json_encode( $send )
                )
                    /*'data' => '{"candidate": { 
                            "firstname": "Jj", 
                            "lastname": "Botha", 
                            "email": "jj_botha@fakemail.com"
                        } 
                    }'*/
                
            );

            // ?state=published
            $workable_response = wp_remote_post( 'https://'.$subdomain.'.workable.com/spi/v3/jobs/'.$shortcode.'/candidates', $workable_args );
            $workable_response_code = wp_remote_retrieve_response_code( $workable_response );
var_dump( $workable_response );
            if( $workable_response_code == 201 ):
                $status_job = 'success';
            else:
                $status_job = 'error';
            endif;

            /*if($sent_job){
                $status_job = 'success';
            }else{
                $status_job = 'error';
                $errorSend_job = 'Sorry, an error occured and you message couldn\'t be send. Please try again later!';
            }*/

        }else{
            $status_job = 'success';
        }
    }
}