<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.eu.mailgun.org';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'VeilleHub@nizarberiane.me';                     //SMTP username
    $mail->Password   = 'Nizar2005nizar#';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('support@nizarberiane.me', 'Mailer');
    $mail->addAddress('badrnewacc@gmail.com', 'Ana');     //Add a recipient

    $mail->addReplyTo('nizarberiane5@nizarberiane.me', 'Information');


    //Attachments

//    $mail->addAttachment('testimage.png', 'terraria');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
   $mail->Body    = 'Click bach check: <a href="instagram.com" style="background-color: #1D4ED8; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">Click here</a>';;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
//    echo 'Message has been sent';
} catch (Exception $e) {
//    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 flex items-center justify-center h-screen">
<div class="bg-white p-10 rounded-2xl shadow-2xl w-full max-w-lg transform transition duration-500 hover:scale-105 text-center">
    <h1 class="text-4xl font-extrabold mb-6 text-center text-gray-800">Welcome!</h1>
    <p class="text-lg text-gray-600 mb-8">This is the home page. Navigate to other pages using the buttons below.</p>
    <div class="flex flex-col space-y-4">
        <a href="../app/views/auth/login.php" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-bold transition duration-300">Login</a>
        <a href="../app/views/auth/register.php" class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 font-bold transition duration-300">Register</a>
    </div>
</div>
</body>
</html>