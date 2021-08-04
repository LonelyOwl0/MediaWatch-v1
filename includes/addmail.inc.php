<?php
session_start();

if (isset($_POST['addmail'])) {
    require 'dbh.inc.php';

    $mail = $_POST['mail'];

    global $conn;

    $req_theme = $conn->prepare('select * from mail where mails = ?');
    $req_theme -> execute(array($mail));
    $existetheme = $req_theme->rowCount();



    if ($existetheme == 0){
        $insertsql = $conn->prepare('insert into mail value (?)');
        $insertsql->execute(array($mail));


        if (!$insertsql) {
            header("Location: ../emailadd.php?message=");
            exit();
        } else {
            header("Location: ../emailadd.php?message=Good");

        }
    }
    else{
        header("Location: ../emailadd.php?message=Theme exists");
    }

    $conn = null;
}

else{
    header("Location: ../index.php?message=Bruh"); }
