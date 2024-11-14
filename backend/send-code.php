<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
// require './database.php';

// $database = new MySQLDatabase();
$mail = new PHPMailer(true);
$generatedCode = rand(100000, 999999);
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['email'])) {
    $email = $data['email'];
} else {
    echo json_encode(['error' => 'Email is required']);
    exit;
}

session_start();
$_SESSION['generated_code'] = $generatedCode;
$_SESSION['email'] = $email;
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'jdmaster888@gmail.com';
    $mail->Password = 'mxvj qric haou eibj';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('jdmaster888@gmail.com', 'Lyza Drugstore');
    $mail->addAddress('jdmaster888@gmail.com');
    $mail->Subject = 'Generated Code for Password Reset';
    $mail->Body = "Dear User,\n\nHere is your generated code for password reset: $generatedCode\n\nPlease use this code to reset your password on our platform.\n\nBest regards,\nLyza Drugstore";

    $mail->send();
    echo json_encode(['success' => true, 'message' => 'Code sent successfully.']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
}
?>