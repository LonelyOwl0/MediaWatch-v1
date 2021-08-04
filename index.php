<?php
require "header.php";
global $conn;

$getprio = $conn->prepare('select prio from priority limit 1');
$getprio->execute();
$prio = $getprio->fetchColumn();


?>

<main>
    <?php
    if (isset($_SESSION['id'])) { echo ("Welcome: ".$_SESSION['nom']."  ".$_SESSION['prenom']);
        echo ('</br>');
        if ($prio != '') {
    echo ("Le sujet de priorité est : ".$prio);}}
    else{echo("Not logged in");}
    ?>
</main>

<?php
require "footer.php" ?>
