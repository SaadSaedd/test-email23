<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$to = "tek4186@gmail.com";
$subject = "Test Email";
$message = "This is a test email from my PHP script.";
$headers  = "From: noreply@37354.hosts2.ma-cloud.nl\r\n";
$headers .= "Reply-To: noreply@37354.hosts2.ma-cloud.nl\r\n";

// Use the -f parameter to set the envelope sender
if (mail($to, $subject, $message, $headers, "-f noreply@37354.hosts2.ma-cloud.nl")) {
    echo "Email sent successfully!";
} else {
    $error = error_get_last();
    echo "There was an error sending your message: " . (isset($error['message']) ? $error['message'] : 'Unknown error');
}
?>
