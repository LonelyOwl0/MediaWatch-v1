<?php
session_start();

if (isset($_POST['addtheme'])) {
    require 'dbh.inc.php';

    $theme = $_POST['theme'];

    global $conn;

    $req_theme = $conn->prepare('select * from theme where names = ?');
    $req_theme -> execute(array($theme));
    $existetheme = $req_theme->rowCount();



    if ($existetheme == 0){
        $insertsql = $conn->prepare('insert into theme value (?)');
        $insertsql->execute(array($theme));
        $theme = 'poopoo';

        if (!$insertsql) {
            header("Location: ../themeadd.php?message=");
            exit();
        } else {
            header("Location: ../themeadd.php?message=Good");
        }
    }
    else{
        header("Location: ../themeadd.php?message=Theme exists");
    }

    $conn = null;
}

else{
    header("Location: ../index.php?message=Bruh"); }

