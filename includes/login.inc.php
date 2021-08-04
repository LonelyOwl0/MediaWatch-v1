<?php

if(isset($_POST['login-submit'])){
    require 'dbh.inc.php';

    global $conn;

    $mail = $_POST['email'];
    $password = $_POST['pwd'];


    $loginstm = $conn -> prepare('SELECT * from employé where email  = ? AND password = ?');
    $loginstm -> execute(array($mail,md5($password)));
    $result = $loginstm->fetch();

    $loginstm2 = $conn -> prepare('SELECT * from employésm where email  = ? AND password = ?');
    $loginstm2 -> execute(array($mail,md5($password)));
    $result2 = $loginstm2->fetch();

    $loginstm3 = $conn -> prepare('SELECT * from administrateur where email  = ? AND password = ?');
    $loginstm3 -> execute(array($mail,md5($password)));
    $result3 = $loginstm3->fetch();

    if($result){
        session_start();
        $_SESSION['id'] = $result['id'];
        $_SESSION['nom'] = $result['nom'];
        $_SESSION['prenom'] = $result['prenom'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['password'] = $result['password'];

        header("Location: ./usercheck.inc.php ");
        exit();
    }

    else if($result2){
        session_start();
        $_SESSION['id'] = $result2['id'];
        $_SESSION['nom'] = $result2['nom'];
        $_SESSION['prenom'] = $result2['prenom'];
        $_SESSION['email'] = $result2['email'];
        $_SESSION['password'] = $result2['password'];

        header("Location: ./usercheck.inc.php ");
        exit();
    }

    else if($result3){
        session_start();
        $_SESSION['id'] = $result3['id'];
        $_SESSION['nom'] = $result3['nom'];
        $_SESSION['prenom'] = $result3['prenom'];
        $_SESSION['email'] = $result3['email'];
        $_SESSION['password'] = $result3['password'];

        header("Location: ./usercheck.inc.php ");
        exit();
    }
    else {  header("Location: ../index.php?message=User doesn't exist");
    exit();}

}

else{
    header("Location: ../index.php?message=No u don't");
    exit();
}