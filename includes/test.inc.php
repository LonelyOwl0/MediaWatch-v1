<?php

use PhpOffice\PhpWord\TemplateProcessor;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

require '../vendor/autoload.php';

$templateProcessor = new TemplateProcessor('../Template.docx');

$templateProcessor->setValue('titre','THIS IS A TITLE');
$templateProcessor->setValue('source', 'THIS IS A SOURCE');
$templateProcessor->setValue('auteur', 'THIS IS AN AUTHOR');
$templateProcessor->setValue('date_pub', 'THIS IS A DATE');
$templateProcessor->setValue('contenu', 'THIS IS CONTENT BABY');
$templateProcessor->saveAs('article.docx');





$mail = new PHPMailer;

$mail->isSMTP();                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers
$mail->SMTPAuth = true;               // Enable SMTP authentication
$mail->Username = 'mediawatchapp@gmail.com';   // SMTP username
$mail->Password = 'Media321';   // SMTP password
$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                    // TCP port to connect to

// Sender info
$mail->setFrom('mediawatchapp@gmail.com', 'MW');
$mail->addReplyTo('mediawatchapp@gmail.com', 'MW');

// Add a recipient
$mail->addAddress('medfouad2000@gmail.com');

// Mail subject
$mail->Subject = 'Email from Localhost by MediaWatch';

// Mail body content

$mail->Body='This is the body';
$mail->addAttachment('article.docx');

// Send email
if(!$mail->send()) {
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
} else {
    echo 'Message has been sent.';
}

?>




