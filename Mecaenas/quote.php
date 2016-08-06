<?php
   

    session_cache_limiter( 'nocache' );
    header( 'Expires: ' . gmdate( 'r', 0 ) );
    header( 'Content-type: application/json' );


    $to         = 'info@mecaenas.com';

    $email_template = 'quote.html';

    $subject    = strip_tags($_POST['subject']);
    $company    = strip_tags($_POST['company']);
    $email      = strip_tags($_POST['email']);
    $phone      = strip_tags($_POST['phone']);
    $name       = strip_tags($_POST['name']);
    $location   = strip_tags($_POST['location']);
    $url        = strip_tags($_POST['url']);
    $message    = nl2br( htmlspecialchars($_POST['message'], ENT_QUOTES) );
    $result     = array();


    if(empty($name)){

        $result = array( 'response' => 'error', 'empty'=>'name', 'message'=>'<strong>Error!</strong>&nbsp; Name is empty.' );
        echo json_encode($result );
        die;
    }

    if(empty($phone)){

        $result = array( 'response' => 'error', 'empty'=>'phone', 'message'=>'<strong>Error!</strong>&nbsp; Mobile no. is empty.' );
        echo json_encode($result );
        die;
    }

    if(empty($subject)){

        $result = array( 'response' => 'error', 'empty'=>'subject', 'message'=>'<strong>Error!</strong>&nbsp; Please select from dropdown.' );
        echo json_encode($result );
        die;
    }

    if(empty($company)){

        $result = array( 'response' => 'error', 'empty'=>'company', 'message'=>'<strong>Error!</strong>&nbsp; Company name is empty.' );
        echo json_encode($result );
        die;
    }

    if(empty($location)){

        $result = array( 'response' => 'error', 'empty'=>'location', 'message'=>'<strong>Error!</strong>&nbsp; Location is empty.' );
        echo json_encode($result );
        die;
    } 

    if(empty($email)){

        $result = array( 'response' => 'error', 'empty'=>'email', 'message'=>'<strong>Error!</strong>&nbsp; Email is empty.' );
        echo json_encode($result );
        die;
    } 

    if(empty($message)){

         $result = array( 'response' => 'error', 'empty'=>'message', 'message'=>'<strong>Error!</strong>&nbsp; Message body is empty.' );
         echo json_encode($result );
         die;
    }
    


    $headers  = "From: " . $name . ' <' . $email . '>' . "\r\n";
    $headers .= "Reply-To: ". $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";


    $templateTags =  array(
        '{{request_for}}' => $request_for,
        '{{email}}'=>$email,
        '{{message}}'=>$message,
        '{{name}}'=>$name,
        '{{company}}'=>$company,
        '{{phone}}'=>$phone,
        '{{subject}}'=>$subject,
        '{{url}}'=>$url,
        '{{location}}'=>$location
        );


    $templateContents = file_get_contents( dirname(__FILE__) . '/email-templates/'.$email_template);

    $contents =  strtr($templateContents, $templateTags);

    if ( mail( $to, $subject, $contents, $headers ) ) {
        $result = array( 'response' => 'success', 'message'=>'<strong>Thank You!</strong>&nbsp; Your email has been delivered.' );
    } else {
        $result = array( 'response' => 'error', 'message'=>'<strong>Error!</strong>&nbsp; Cann\'t Send Mail.'  );
    }

    echo json_encode( $result );

    die;
?>