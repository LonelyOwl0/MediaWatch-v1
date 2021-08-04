<?php
session_start();

if (isset($_POST['add'])) {
    require 'dbh.inc.php';

    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $contenu = $_POST['contenu'];
    $lien = $_POST['lien'];
    $date = $_POST['date'];
    $source = $_POST['source'];
    $theme = $_POST['theme'];
    $urgence = $_POST['urgence'];
    $tendance = $_POST['tendance'];
    $likes = $_POST['likes'];
    $comments = $_POST['comments'];
    $shares = $_POST['shares'];

    $employeid = $_SESSION['id'];
    $employename = $_SESSION['nom'];
    $employeprenom = $_SESSION['prenom'];

    global $conn;

    $insertsql = $conn->prepare('insert into socialmedia values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ');
    $insertsql->execute(array(0, $employeid, $titre, $auteur, $contenu, $source,$date,date("Y-m-d"),$theme,$urgence,$tendance,$lien,$likes,$comments,$shares,$employename));

    if (!$insertsql) {
        header("Location: ../Ajoutsm.php?message=Echec");
        exit();
    } else {
        header("Location: ../Ajoutsm.php?message=Good");
    }
    $conn = null;
}

else{
    header("Location: ../index.php?message=Bruh"); }

