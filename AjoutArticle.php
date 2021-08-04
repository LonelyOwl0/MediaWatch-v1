<?php

require "includes/dbh.inc.php";
global $conn; ?>

<?php
require "header.php" ?>

<?php
$check2 = $conn->prepare('select * from employé where email = ?');
$check2->execute(array($_SESSION['email']));
$existemail2 = $check2->rowCount();


// Mail


if (!$existemail2 == 0) { ?>
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


        <form action="includes/addarticle.inc.php" method="POST">
            <input type="text" name="titre" placeholder="titre..">
            <input type="text" name="auteur" placeholder="Auteur..">
            <textarea name="contenu" placeholder="Contenu.."></textarea>
            <input type="text" name="lien" placeholder="lien..">
            <input type="date" name="date">

            <select name="list" required id="list">
                <option disabled selected value> Choisissez votre groupe </option>
                <option value="1" onclick="l1();">Liste 1</option>
                <option value="2" onclick="l2()">Liste 2</option>
                <option value="3" onclick="l3()">Liste 3</option>
            </select>

            <select name="liste1" id="l1" style="visibility: hidden " >
                <option disabled selected value> Choisissez votre groupe </option>
                <option value="a">a</option>
                <option value="b">b</option>
                <option value="c">c</option>
            </select>

            <select name="liste2" id="l2" style="visibility: hidden">
                <option disabled selected value> Choisissez votre groupe </option>
                <option value="d">d</option>
                <option value="e">e</option>
                <option value="f">f</option>
            </select>

            <select name="liste3" id="l3" style="visibility: hidden">
                <option disabled selected value> Choisissez votre groupe </option>
                <option value="g">g</option>
                <option value="h">h</option>
                <option value="i">i</option>
            </select>

            <select name="theme">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="1">3</option>
            </select>
            <select name="urgence">
                <option value="oui">Oui</option>
                <option value="non" selected>Non</option>
            </select>

            <select name="tendance">
                <option value="positive">Positif</option>
                <option value="neutre" selected>Neutre</option>
                <option value="négatif">Négatif</option>
            </select>

            <button type="submit" name="submit-btn"> Envoyer</button>

        </form>

        <script>
            function l1(){
                document.getElementById('l1').style.visibility="visible";
                document.getElementById('l2').style.visibility="hidden";
                document.getElementById('l3').style.visibility="hidden";
            }
            function l2(){
                document.getElementById('l1').style.visibility="hidden";
                document.getElementById('l2').style.visibility="visible";
                document.getElementById('l3').style.visibility="hidden";
            }
            function l3(){
                document.getElementById('l1').style.visibility="hidden"
                document.getElementById('l2').style.visibility="hidden"
                document.getElementById('l3').style.visibility="visible"
            }
        </script>
    </main>

<?php } else header("Location: ./index.php?message=whythis "); ?>

<?php
require "footer.php" ?>
