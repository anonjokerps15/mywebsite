<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer classes
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? 'Message from Contact Form';
    $message = $_POST['message'] ?? '';

    // Basic validation
    if (!empty($name) && !empty($email) && !empty($message)) {
        $mail = new PHPMailer(true);

        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'mr.joker1442@gmail.com';           // <-- Your Gmail address
            $mail->Password   = 'your_app_password_here';         // <-- Gmail App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Sender and recipient settings
            $mail->setFrom(oksana@gmail.com, 'Contact Form');
            $mail->addAddress('your_gmail@gmail.com');            // <-- You can change this

            // Email content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = "
                <h2>New Message from Contact Form</h2>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Message:</strong><br>{$message}</p>
            ";

            $mail->send();
            echo "✅ Message has been sent successfully.";
        } catch (Exception $e) {
            echo "❌ Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "❌ Please fill in all required fields.";
    }
}
?>
