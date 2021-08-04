<?php

require "includes/dbh.inc.php";
global $conn; ?>

<?php
require "header.php" ?>

<?php
$check = $conn->prepare('select * from administrateur where email = ?');
$check->execute(array($_SESSION['email']));
$existemail = $check->rowCount();

$themelist = $conn->prepare('select mails from mail');
$themelist->execute();
$options = $themelist->fetch();

if (!$existemail == 0) { ?>
    <main>
        <form action="includes/deletemail.inc.php" method="POST">
            <select required name="choice"> <?php while ($a = $options) {
                    $options = $themelist->fetch(); ?>
                    <option value="<?= $a['mails'] ?>"><?= $a['mails'] ?></option>
                <?php }
                ?>
            </select>
            <button type="submit" name="delmail"> Supprimer </button>
        </form>
    </main>

<?php } else header("Location: ./index.php?message=^priopage "); ?>

<?php
require "footer.php" ?>