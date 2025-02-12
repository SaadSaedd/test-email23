<?php
// Enable error reporting (for debugging; remove or comment out in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name         = strip_tags(trim($_POST['name']));
    $email        = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subjectInput = strip_tags(trim($_POST['subject']));
    $date         = isset($_POST['date']) ? strip_tags(trim($_POST['date'])) : '';
    $messageInput = strip_tags(trim($_POST['message']));

    // Validate required fields
    if (empty($name) || empty($email) || empty($subjectInput) || empty($messageInput)) {
        echo "Please fill in all required fields.";
        exit;
    }

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    // Set the recipient email address (replace with your actual email)
    $to = "your-email@example.com";  // <-- Replace with your email address

    // Email subject (you can customize as needed)
    $subject = "New message from contact form: " . $subjectInput;

    // Build the email content
    $email_body  = "You have received a new message from your website contact form.\n\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Type: $subjectInput\n";
    if ($date !== '') {
        $email_body .= "Preferred Date: $date\n";
    }
    $email_body .= "Message:\n$messageInput\n";

    // Set the email headers.
    // IMPORTANT: The "From:" address should be an email address on your server’s domain.
    $headers  = "From: noreply@37354.hosts2.ma-cloud.nl\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Try to send the email
    if (mail($to, $subject, $email_body, $headers)) {
        echo "Your message has been sent successfully!";
    } else {
        echo "There was an error sending your message. Please try again later.";
    }
} else {
    echo "Invalid request.";
}
?>
