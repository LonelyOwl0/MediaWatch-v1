<?php

require "includes/dbh.inc.php";
global $conn; ?>

<?php
require "header.php" ?>

<?php
$check = $conn->prepare('select * from employésm where email = ?');
$check->execute(array($_SESSION['email']));
$existemail = $check->rowCount();

if (!$existemail == 0) { ?>
    <main>
        <h3> Bonjour <?=$_SESSION['nom']?>  <?=$_SESSION['prenom']?>   </h3>
        <?=$_SESSION['nom']?>
        <?=$_SESSION['prenom']?>
        <?=$_SESSION['email']?>
        <?=$_SESSION['password']?>
        <?=$_SESSION['id']?>

        <?php if (isset($_GET['message'])) {echo ($_GET['message']);} ?>


        <form action="includes/addsocialmedia.inc.php" method="POST">
            <input type="text" name="titre" required placeholder="titre..">
            <input type="text" name="auteur" required placeholder="Auteur..">
            <textarea name="contenu" placeholder="Contenu.." ></textarea>
            <input type="text" name="lien" required placeholder="lien..">
            <input type="date" name="date" required >

            <select name="source" required>
                <option value="1">1</option>
            </select>

            <select name="theme" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="1">3</option>
            </select>
            <select name="urgence" required>
                <option value="oui">Oui</option>
                <option value="non" selected>Non</option>
            </select>

            <select name="tendance" required>
                <option value="positive">Positif</option>
                <option value="neutre" selected>Neutre</option>
                <option value="négatif">Négatif</option>
            </select>

            <input type="number" name="likes" placeholder="likes.." required>
            <input type="number" name="comments" placeholder="comments.." required>
            <input type="number" name="shares" placeholder="shares.." required>

            <button type="submit" name="add"> Envoyer </button>

        </form>
    </main>

<?php } else header("Location: ./index.php?message=whyareuhere "); ?>

<?php
require "footer.php" ?>
