<?php

$errors = array();
    $first_name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $user_email = $_POST['mail'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $from = $user_email;
    $to = 'dilip.mishra900@gmail.com'; 
    $subject = 'Message from Contact Us Form';
    
	if (!$_POST['first_name']) {
      $errors[] = 'Please enter your first name';
    }
    
    if (!$_POST['last_name']) {
      $errors[] = 'Please enter your last name';
    }
    

    if (!$_POST['phone']) {
      $errors[] = 'Please enter your phone number';
    }
    
    // Check if email has been entered and is valid
    if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'Please enter your email address';
    }
    
    //Check if message has been entered
    if (!$_POST['message']) {
      $errors[] = 'Please enter message';
    }

    if(count($errors) > 0){
     echo json_encode(array(
     	'status' => 'error',
    	'message' => $errors,
	));
    die;
    }

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$user_email."\r\n".
    'Reply-To: '.$user_email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$body = '<html><body>';
$body .= '<h1 style="color:#f40;">Message From Contact Us Form</h1>';
$body .= '<p style="color:#080;font-size:18px;">First Name : '.$first_name.'</p>';
$body .= '<p style="color:#080;font-size:18px;">Last Name : '.$last_name.'</p>';
$body .= '<p style="color:#080;font-size:18px;">Phone : '.$phone.'</p>';
$body .= '<p style="color:#080;font-size:18px;">Message : '.$message.'</p>';
$body .= '</body></html>';
 
// Sending email
if(mail($to, $subject, $body, $headers)){
   echo json_encode(array(
     	'status' => 'ok',
    	'message' => 'Thanks for contacting, I will get back to you shortly.',
	));
} else{
    echo json_encode(array(
     	'status' => 'error',
    	'message' => 'Sorry there was an error sending your message. Please try again later.',
	));
}