<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// define variables and set to empty values
$name_error = $email_error = $phone_error = "";
$name = $email = $phone = $message = $success = "";

//form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $name_error = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $name_error = "Only letters and white space allowed"; 
    }
  }

  if (empty($_POST["email"])) {
    $email_error = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_error = "Invalid email format"; 
    }
  }
  
if (empty($_POST["phone"])) {
    $phone_error = "Phone is required";
  } else {
    $phone = test_input($_POST["phone"]);
    // check if phone is well-formed
    if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{3,4}$/i",$phone)) {
      $phone_error = "Invalid phone number"; 
    }
  }

  if (empty($_POST["message"])) {
    $message = "";
  } else {
    $message = test_input($_POST["message"]);
  }
  
  if ($name_error == '' and $email_error == '' and $phone_error == ''){
      $message_body = '';
      unset($_POST['submit']);
      foreach ($_POST as $key => $value){
          $message_body .=  "$key: $value\n";
      }
      
      $to = 'traveleragjency@gmail.com';
      $subject = 'Contact Form Submit';
      $mail = new PHPMailer(true);
            try{
                $mail->Username = "travelagencykosovo1@gmail.com";
    
                $mail->Password = 'omer12345';
                $mail->SMTP = 1;
                $mail->isSendMail();
                $mail->isSMTP();
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->SMTPAuth = TRUE;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->setFrom($email,$name);
                $mail->addAddress('travelagencykosovo1@gmail.com','Traveler');

                $mail->isHTML(false);
                $mail->Subject =$subject;
                $mail->Body = $message_body;
                $mail->send();

                
                $success = "Message sent, thank you for contacting us!";
            } catch (Exception $ex) 
            {   
                echo $mail->ErrorInfo;
            }
      
  }
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}	