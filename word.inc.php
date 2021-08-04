<?php


use PhpOffice\PhpWord\TemplateProcessor;

require 'vendor/autoload.php';
require 'includes/dbh.inc.php';

global $conn;




if (isset($_GET['id'])) {

    $id = $_GET['id'];



    $infoslist = $conn->prepare('select titre, auteur, contenu, source, date_pub, theme, urgence, tendance, lien, employé  from article where id= ?');
    $infoslist->execute(array($id));
    $options = $infoslist->fetch();

    $title = $options['titre'];



$templateProcessor = new TemplateProcessor('Template.docx');

$templateProcessor->setValue('titre', $options['titre']);
$templateProcessor->setValue('source', $options['source']);
$templateProcessor->setValue('auteur', $options['auteur']);
    $templateProcessor->setValue('date_pub', $options['date_pub']);
$templateProcessor->setValue('contenu', $options['contenu']);


// $templateProcessor->saveAs('NewWordFile.docx');
try {
    header("Content-Disposition: attachment; filename=$title.docx");
    $templateProcessor->saveAs('php://output');
} catch (\Throwable $th) {

} }






