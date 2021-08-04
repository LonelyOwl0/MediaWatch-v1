<?php
require 'dbh.inc.php';
global $conn;

if (isset($_POST['resetprio'])) {

    $insertsql = $conn->prepare('UPDATE priority SET prio= ? ');
    $insertsql-> execute(array(''));

    if (!$insertsql) {
        header("Location: ../priochange.php?message=Update failed");
        exit();
    } else {
        header("Location: ../priochange.php?message=Update up success");
    }
    $conn = null;




}
else {
    header("Location : ../Admin.php?message=leave");
}



