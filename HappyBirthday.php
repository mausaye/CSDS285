<?php

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\SMTP; 
use PHPMailer\PHPMailer\Exception; 

// Include library files 
require 'PHPMailer-master/src/Exception.php'; 
require 'PHPMailer-master/src/PHPMailer.php'; 
require 'PHPMailer-master/src/SMTP.php'; 

// Error reporting
    error_reporting(-1);
    ini_set('display_errors', 'On');
    set_error_handler("var_dump");
// The goal of this script is to read a file of all friends birthdays and then send happy birthday
// to anyones who's birthday is today

    $mail = new PHPMailer;

$mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output 
$mail->isSMTP();                            // Set mailer to use SMTP 
$mail->Host = 'smtp.gmail.com';           // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;                     // Enable SMTP authentication 
$mail->Username = 'lintammy1000@gmail.com';       // SMTP username 
$mail->Password = 'ilxwktqnokrrrqte';         // SMTP password 
$mail->SMTPSecure = 'tsl';                  // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 587;                          // TCP port to connect to 

// Sender info 
$mail->setFrom('lintammy1000@gmail.com', 'Tammy Lin'); 
$mail->addReplyTo('lintammy1000@gmail.com', 'Tammy Lin'); 

// Add a recipient 


//$mail->addCC('cc@example.com'); 
//$mail->addBCC('bcc@example.com'); 

    if(($file = fopen("birthdays.csv", "r")) !== false) {

    //fgetcsv($file); // retrieves header

    while(($data = fgetcsv($file)) !== false){
        $name = $data[0];
        $date = $data[1];
        $email = $data[2];

        $today = date("m-d");
       echo $today;

        if($date == $today){
            $mail->addAddress($email); 

            $mail->Subject = "Birthday Wishes!";
            $body = "Happy birthday!";
            $mail->Body = $body;

           // $status = mail($email, $subject, $message, $from);
           // echo "Mail sent: $status";
            echo "Birthday message sent to $name";
        }

    }

    fclose($file);
    }

    // Set email format to HTML 
    $mail->isHTML(true); 
    // Send email 
    if(!$mail->send()) { 
        echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
    } else { 
        echo 'Message has been sent.'; 
    }

?> 