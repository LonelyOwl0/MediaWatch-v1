<?php
session_start();
use PhpOffice\PhpWord\TemplateProcessor;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

require '../vendor/autoload.php';

if (isset($_POST['submit-btn'])) {
    require 'dbh.inc.php';

    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $contenu = $_POST['contenu'];
   // $lien = $_POST['lien'];
    $lien = ( urldecode($_POST['lien']) );
    $date = $_POST['date'];

    // Getting the source
    $listchoice = $_POST['list'];

if ($listchoice == 1) {$source = $_POST['liste1'];}
    if ($listchoice == 2) {$source = $_POST['liste2'];}
    if ($listchoice == 3) {$source = $_POST['liste3'];}

    $theme = $_POST['theme'];
    $urgence = $_POST['urgence'];
    $tendance = $_POST['tendance'];
    $employeid = $_SESSION['id'];
    $employename = $_SESSION['nom'];
    $employeprenom = $_SESSION['prenom'];

    global $conn;




    $req_theme = $conn->prepare('select * from mail');
    $req_theme -> execute();
    $emailist = $req_theme->fetchAll();




    // FILLING WORD FILE :


    $templateProcessor = new TemplateProcessor('../Template.docx');

    $templateProcessor->setValue('titre',$titre);
    $templateProcessor->setValue('source', $source);
    $templateProcessor->setValue('auteur', $auteur);
    $templateProcessor->setValue('date_pub', $date);
    $templateProcessor->setValue('contenu', $contenu);
    $templateProcessor->saveAs($titre.'.docx');


// PHP MAILER :

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

    foreach ($emailist as $e  ){
        $mail->addAddress($e['mails']);
    }

// Mail subject
    $mail->Subject = 'Email from Localhost by MediaWatch';

// Mail body content

    $mail->Body='This is the body';
    $mail->addAttachment($titre.'.docx');

// Send email
    if(!$mail->send()) {
        echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
    } else {
        echo 'Message has been sent.';
    }

        $insertsql = $conn->prepare('insert into article values(?,?,?,?,?,?,?,?,?,?,?,?,?) ');
        $insertsql->execute(array(0, $employeid, $titre, $auteur, $contenu, $source,$date,date("Y-m-d"),$theme,$urgence,$tendance,$lien,$employename));

        if (!$insertsql) {
            header("Location: ../AjoutArticle.php?message=Echec");
            exit();
        } else {
            if ($urgence == 'oui') {
                mail('mohocherry@gmail.com','Article Urgent Ajouté','Titre : '.$titre."\n Auteur : ".$auteur."\n  Contenu : ".$contenu);
            }
            header("Location: ../AjoutArticle.php?message=Good");
        }
        $conn = null;
        unlink($titre.'.docx');
}

else{
    header("Location: ../index.php?message=Bruh"); }

