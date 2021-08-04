<?php
session_start();

if (isset($_POST['delmail'])) {
    require 'dbh.inc.php';

    $mail = $_POST['choice'];

    global $conn;


    $insertsql = $conn->prepare('delete from mail where mails = ?');
    $insertsql->execute(array($mail));


    if (!$insertsql) {
        header("Location: ../emaildelete.php?message=");
        exit();
    } else {
        header("Location: ../emaildelete.php?message=Good");
    }



    $conn = null;
}

else{
    header("Location: ../index.php?message=Bruh"); }

