<?php
function sendmail($sendto, $messageto){
    $to       = $sendto;
    $subject  = 'ATA Medication Reminder';
    $message  = $messageto;
    $headers  = 'From: [your_gmail_account_username]@gmail.com' . "\r\n" .
                'MIME-Version: 1.0' . "\r\n" .
                'Content-type: text/html; charset=utf-8';
    if(mail($to, $subject, $message, $headers))
        echo "Email sent";
    else
        echo "Email sending failed";

}


?>