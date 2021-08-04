<?php
session_start();

if (isset($_POST['deltheme'])) {
    require 'dbh.inc.php';

    $theme = $_POST['choice'];

    global $conn;


        $insertsql = $conn->prepare('delete from theme where names = ?');
        $insertsql->execute(array($theme));


        if (!$insertsql) {
            header("Location: ../themedelete.php?message=");
            exit();
        } else {
            header("Location: ../themedelete.php?message=Good");
        }



    $conn = null;
}

else{
    header("Location: ../index.php?message=Bruh"); }

