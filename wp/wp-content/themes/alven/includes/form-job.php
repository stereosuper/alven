<?php

if( !function_exists( 'wp_handle_upload' ) ){
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
}

$status_job         = false;
$errorFirstname_job = '';
$errorLastname_job  = '';
$errorEmail_job     = '';
$errorDocument_job  = '';
$errorUrl_job       = '';
$errorSend_job      = '';

$firstname_job = isset($_POST['firstname_job']) ? strip_tags(stripslashes($_POST['firstname_job'])) : '';
$lastname_job  = isset($_POST['lastname_job']) ? strip_tags(stripslashes($_POST['lastname_job'])) : '';
$email_job     = isset($_POST['email_job']) ? strip_tags(stripslashes($_POST['email_job'])) : '';
$document_job  = isset($_FILES['document_job']) ? $_FILES['document_job'] : '';
$url_job       = isset($_POST['url_job']) ? strip_tags(stripslashes($_POST['url_job'])) : '';
$spamUrl_job   = isset($_POST['spam_job']) ? strip_tags(stripslashes($_POST['spam_job'])) : '';

if( isset( $_POST['directappsubmit'] ) ){

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

    if( !empty($document_job['name']) ){

        //var_dump($document_job);

        $allowedMimes = array(
            'pdf'  => 'application/pdf',
            'doc'  => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'rtf'  => 'application/rtf'
        );
        $document_type = wp_check_filetype(basename($document_job['name']), $allowedMimes);

        if( empty( $document_type['ext'] ) ){
            $status_job = 'error';
            $errorDocument_job = true;
            $errorSend_job = 'Sorry, your document couldn\'t be send: the uploaded file extension isn\'t valid.';
        }
    }

    if( $status_job === 'error' && empty( $errorSend_job ) ){
        $errorSend_job = 'Sorry, your message counldn\'t be send, the form contains errors. Please check the red fields.';
    }

    if( !$status_job ){

        if( empty( $spamUrl_job ) ){

            $candidate = array(
                'firstname'  => $firstname_job, 
                'lastname'   => $lastname_job, 
                'email'      => $email_job,
                'resume'     => array(
                    'name' => $document_job['name'],
                    'data' => chunk_split( base64_encode( file_get_contents( $document_job['tmp_name'] ) ) ) 
                )
            );

            $workable_datas = null;
            $workable_args = array(
                'headers' => array(
                    'Content-Type: application/json',
                    'Authorization' => 'Bearer ' . WRKBL_TOKEN,
                    'Accept: application/json'
                ),
                'body'    => array(
                    'candidate' => $candidate
                )
            );

            // ?state=published
            $workable_response = wp_remote_post( 'https://'. WRKBL_SUBDOMAIN .'.workable.com/spi/v3/jobs/'. WRKBL_APPLICATION .'/candidates', $workable_args );
            $workable_response_code = wp_remote_retrieve_response_code( $workable_response );

            if( $workable_response_code == 201 ):
                $status_job = 'success';
            else:
                $workable_datas_application = json_decode( $workable_response['body'], true );
                $status_job    = 'error';
                $errorSend_job = $workable_datas_application['error'];
            endif;

        }else{
            $status_job = 'success';
        }
    }
}