<?php
/* Registration process, inserts user info into the database
   and sends account confirmation email message
 */
 // use PHPMailer\PHPMailer\PHPMailer;
 // use PHPMailer\PHPMailer\Exception;



require 'vendor/autoload.php';
// Set session variables to be used on profile.php page


$name = $_POST['firstName'];
$passi = $_POST['password'];

$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstName'];
$_SESSION['last_name'] = $_POST['lastName'];

if( $_POST['password'] != $_POST['confirmpassword'] )
{
    $_SESSION['message'] = "Two passwords you entered don't match, try again!";
    header("location: error.php");
}
elseif(strlen($passi)<6)
{
	$_SESSION['message'] = "The password you entered has less than 6 characters!";
    header("location: error.php");
}
else
{

    // Escape all $_POST variables to protect against SQL injections
    $first_name = $mysqli->escape_string($_POST['firstName']);
    $last_name = $mysqli->escape_string($_POST['lastName']);
    $email = $mysqli->escape_string($_POST['email']);
    $password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
    $hash = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890[]$%^&*";
    $hash = str_shuffle($hash);
    $hash = substr($hash, 0, 20);

    // Check if user with that email already exists
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

    // We know user email exists if the rows returned are more than 0
    if ( $result ->num_rows > 0 ) {

        $_SESSION['message'] = 'User with this email already exists!';
        header("location: error.php");

    }
    else { // Email doesn't already exist in a database, proceed...

        // active is 0 by DEFAULT (no need to include it here)
        $sql = "INSERT INTO users (first_name, last_name, email, password, hash) "
                . "VALUES ('$first_name','$last_name','$email','$password', '$hash')";

        // Add user to the database
        if ( $mysqli->query($sql) ){

            $_SESSION['active'] = 0; //0 until user activates their account with verify.php
            $_SESSION['logged_in'] = true; // So we know the user has logged in
            $_SESSION['message'] =

                     "Confirmation link has been sent to $email, please verify
                     your account by clicking on the link in the message!";

            $message_body = '
                Hello '.$first_name.',<br><br>

                Thank you for signing up!<br>

                Please click this <a href = "http://localhost/ProjektiPI/verify.php?email='.$email.'&hash='.$hash.'">link</a> to activate your account.';
                $to = $email;
                $subject = "Account Verification";
                $headers = "From: travelagency20@gmail.com \r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                mail($to, $subject, $message_body, $headers);
        
                    header("location: profile.php");
        
        }
        
        else {
            $_SESSION['message'] = 'Registration failed!';
            header("location: error.php");
        }

    }
}
