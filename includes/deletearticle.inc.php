<?php
session_start();

if (isset($_POST['delart'])) {
    require 'dbh.inc.php';
    global $conn;

   if (isset($_GET['id'])) {
       $id = $_GET['id'];

       $delsql = $conn->prepare('delete from article where id = ?');
       $delsql->execute(array($id));
   }


    if (!$delsql) {
        header("Location: ../viewarticles.php?message=".$id);
        exit();
    } else {
        header("Location: ../viewarticles.php?message=Good");
    }

    $conn = null;
}

else{
    header("Location: ../index.php?message=Bruh"); }

