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
        <form action="includes/addtheme.inc.php" method="POST">
            <input name="theme" required placeholder="theme..">
            <button type="submit" name="addtheme"> Ajouter </button>
        </form>
    </main>

<?php } else header("Location: ./index.php?message=^priopage "); ?>

<?php
require "footer.php" ?>