<?php

require "includes/dbh.inc.php";
global $conn; ?>

<?php
require "header.php" ?>

<?php
$check = $conn->prepare('select * from administrateur where email = ?');
$check->execute(array($_SESSION['email']));
$existemail = $check->rowCount();

if (!$existemail == 0) { ?>
    <main>
        <h3> Bonjour <?= $_SESSION['nom'] ?>  <?= $_SESSION['prenom'] ?>   </h3>
        <?= $_SESSION['nom'] ?>
        <?= $_SESSION['prenom'] ?>
        <?= $_SESSION['email'] ?>
        <?= $_SESSION['password'] ?>
        <?= $_SESSION['id'] ?>

        <?php if (isset($_GET['message'])) {
            echo($_GET['message']);
        } ?>

    </main>

<?php } else header("Location: ./index.php "); ?>

<?php
require "footer.php" ?>
