<?php
session_start();
require 'dbh.inc.php';
global $conn;

$curr_id = $_SESSION['id'];
$curr_nom = $_SESSION['nom'];
$curr_prenom = $_SESSION['prenom'];
$curr_email = $_SESSION['email'];
$curr_tel = $_SESSION['password'];


if ($curr_id != null) {
    $test = $conn->prepare('select * from employé where email=?');
    $test->execute(array($curr_email));
    $count = $test->rowCount();

    $test2 = $conn->prepare('select * from employésm where email=?');
    $test2->execute(array($curr_email));
    $count2 = $test2->rowCount();

    $test3 = $conn->prepare('select * from administrateur where email=?');
    $test3->execute(array($curr_email));
    $count3 = $test3->rowCount();

    if ($count == 0 && $count2 == 0 && $count3 == 0) {
        header("Location: ../index.php?Message=Get_Out_Of_Here");
        exit();
    } else {
        if ($count != 0 ) {
            header("Location: ../AjoutArticle.php");
        }
        else if ($count2 != 0 ) {
            header("Location: ../Ajoutsm.php");
        }
        else {
            header("Location: ../Admin.php");
        }
    }
} else {
    header("Location: ../index.php?Message=You're_not_allowed_here");
}

