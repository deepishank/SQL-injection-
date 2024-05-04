<?php
$to_email = "ishank.20bcs@cmr.edu.in";
$subject = "Simple Email Test via PHP";
$body = "Hi, this is the code given my ,e ";
$headers = "From: deepishan@gmmail.com";

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}
