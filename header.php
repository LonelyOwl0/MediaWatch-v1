<!-- This is the header part of the page, and probably most pages , it contains :
The login form
The logout form
-->
<?php
session_start();
require "includes/dbh.inc.php";
global $conn;
$checknormal = $conn->prepare('select * from employé where email = ?');
$check = $conn->prepare('select * from administrateur where email = ?');
if (isset($_SESSION['email'])){
$check->execute(array($_SESSION['email']));
$checknormal->execute(array($_SESSION['email']));
}
$existemail = $check->rowCount();
$existenormie = $checknormal->rowCount();


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="This is an example of a meta description."
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> LoginProject</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="notify.js"></script>

</head>
<body>

<header>
    <nav>
        <a href="#">
            <img src="" alt="">
        </a>

        <ul>
            <li><a href="index.php"> Home</a></li>
            <?php if (!$existenormie == 0){ echo ('<li> <a href="AjoutArticle.php"> Ajouter Article </a> </li>'); } ?>
            <?php if (!$existemail == 0){ echo ('<li> <a href="viewarticles.php"> Voir les articles </a> </li>'); } ?>
            <?php if (!$existemail == 0){ echo ('<li> <a href="priochange.php"> Changer Priorité </a> </li>'); } ?>
            <?php if (!$existemail == 0){ echo ('<li> <a href="themeadd.php"> Ajouter Theme </a> </li>'); } ?>
                <?php if (!$existemail == 0){ echo ('<li> <a href="emailadd.php"> Ajouter Email </a> </li>'); } ?>
            <?php if (!$existemail == 0){ echo ('<li> <a href="themedelete.php"> Supprimer Theme </a> </li>'); } ?>
                <?php if (!$existemail == 0){ echo ('<li> <a href="emaildelete.php"> Supprimer Email </a> </li>'); } ?>


<?php
if (isset($_SESSION['id'])){
    echo ('<li> <form action="includes/logout.inc.php" method="post">
            <button type="logout" name="logout-submit"> Logout</button>
        </form></li>');
}

else{ ?> <li>  <form action="includes/login.inc.php" method="post">
            <input type="text" name="email" placeholder="Username/E-mail.." required>
            <input type="password" name="pwd" placeholder="Password.." required>
            <button type="submit" name="login-submit"> Login</button>
        </form> </li>
         <li><a href="signup.php">Sign up</a></li>
         <?php }
?>
        </ul>
    </nav>
</header>
