<!--This is where the users info that he entered when signing up are handled and the user creation is done-->
<?php

if (isset($_POST['signup-submit'])) {

    require 'dbh.inc.php';

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['password-repeat'];
    $type = $_POST['type'];

    global $conn;

// We make an SQL Request to see if the email already exists
    $req_email = $conn->prepare('select * from employé where email = ?');
    $req_emailsm = $conn->prepare('select * from employésm where email = ?');
    $req_emailadmin = $conn->prepare('select * from administrateur where email = ?');

    $req_email->execute(array($email));
    $req_emailsm->execute(array($email));
    $req_emailadmin->execute(array($email));

    $existemail = $req_email->rowCount();
    $existemailsm = $req_emailsm->rowCount();
    $existemailadmin = $req_emailadmin->rowCount();


    if (!$existemail == 0 || !$existemailsm == 0 || !$existemailadmin == 0) {
        header("Location: ../signup.php?message=Email deja utilisé");
        exit();
    } else if ($passwordRepeat !== $password) {
        header("Location: ../signup.php?message= Confirmez votre mot de passe");
        exit();
    } else {
        $hashed_pwd = md5($password);

        if ($type == 'pe') {
            $insertsql = $conn->prepare('insert into employé values(?,?,?,?,?) ');
        }

        else{ $insertsql = $conn->prepare('insert into employésm values(?,?,?,?,?) ');}

        $insertsql->execute(array(0, $nom, $prenom, $email, $hashed_pwd));

        if (!$insertsql) {
            header("Location: ../signup.php?message=Sign up failed");
            exit();
        } else {
            header("Location: ../signup.php?message=Sign up success");
        }
        $conn = null;
    }
} else {
    header("Location: ../signup.php?message=No u don't");
}