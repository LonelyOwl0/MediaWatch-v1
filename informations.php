<?php

require "includes/dbh.inc.php";
global $conn; ?>

<?php
require "header.php" ?>

<?php
$check = $conn->prepare('select * from administrateur where email = ?');
$check->execute(array($_SESSION['email']));
$existemail = $check->rowCount();

$id = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}


$infoslist = $conn->prepare('select titre, auteur, contenu, source, date_pub, theme, urgence, tendance, lien, employé  from article where id= ?');
$infoslist->execute(array($id));
$options = $infoslist->fetch();


if (!$existemail == 0) { ?>
    <main>
        <h1 align="center"> <?= $options['titre'] ?> </h1>
        <h3 align="center"> Article par : <?= $options['auteur'] ?> </h3>
        <h4 align="center"> Dans : <?= $options['source'] ?> </h4>
        <h4 align="center"> Lien : <a href=<?= urldecode($options['lien'])  ?> target="_blank"
                                      rel="noopener noreferrer"> <?= urldecode($options['lien'])  ?> </a> </h4>
        <h5 align="center"> Au : <?= $options['date_pub'] ?> </h5>
        <h5 align="center"> Theme : <?= $options['theme'] ?> </h5>
        <p> <?= $options['contenu'] ?></p>

        <h6 align="center"> Article envoyé par : <?= $options['employé']  ?> </h6>


    </main>


<?php } else header("Location: ./index.php?message=dont "); ?>

<?php
require "footer.php" ?>
