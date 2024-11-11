<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate form inputs
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '';
    $message = isset($_POST['message']) ? nl2br(htmlspecialchars($_POST['message'])) : '';

    // Create PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();  // Send using SMTP
        $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to Gmail
        $mail->SMTPAuth = true;  // Enable SMTP authentication
        $mail->Username = 'reddykrupakar298@gmail.com';  // Your Gmail address (use your own Gmail account for sending)
        $mail->Password = 'bthbkvecylggqmrh';  // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption
        $mail->Port = 587;  // TCP port to connect to

        // Recipients
        $mail->setFrom('reddykrupakar298@gmail.com', 'Mailer');  // Your Gmail address for sending
        $mail->addAddress('reddykrupakar298@gmail.com', 'Bindusha Kavula');  // Add recipient
        $mail->addReplyTo($email, $name);  // Add Reply-To to the user's email

        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = $subject;  // Subject from the form
        $mail->Body    = '<br>Message: ' . $message;  // Message from the form

        // Send the email
        if ($mail->send()) {
            // Redirect to the homepage after message is sent
            header("Location: main.html"); // Replace with the actual URL of your homepage
            exit();  // Ensure no further code is executed after the redirect
        } else {
            echo 'Message could not be sent.';
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Invalid request method.';
}
?>
