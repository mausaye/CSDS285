// Progress script for birthday email. This didn't have correct email permissions set up to send.
<?php

// The goal of this script is to read a file of all friends birthdays and then send happy birthday
// to anyones who's birthday is today
$subject = "Happy Birthday!";
$message = "Happy Birthday! Have a good day!";
$headers = "From: lintammy1000@gmail.com\r\n";
$headers .= "Reply-To: lintammy1000@gmail.com\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if(($file = fopen("birthdays.csv", "r")) !== false) {

    while(($data = fgetcsv($file)) !== false){
        $name = $data[0];
        $date = $data[1];
        $email = $data[2];

        $today = date("m-d");
        echo $today;

        if($date == $today){

            if (mail($email, $subject, $message, $headers)) {
                echo "Email sent successfully!";
            } else {
                echo "Email sending failed.";
            }

           // $status = mail($email, $subject, $message, $from);
           // echo "Mail sent: $status";
            echo "Birthday message sent to $name";
        }
       
    }

    fclose($file);
    }
    
?>