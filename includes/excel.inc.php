<?php

require 'dbh.inc.php';
global $conn;

if (isset($_POST['excel'])){

    $begin = $_POST['debutdate'];
    $finish = $_POST['findate'];
    if (isset($_POST['theme'])){
        $theme = $_POST['theme'];
    }

    if ($begin > $finish) {
        header("Location : ../viewarticles.php?message=");
    }
    else{
//Query our MySQL table

        $sql = "SELECT * FROM article";
        if (isset($_POST['theme'])){$sql = $conn -> prepare("SELECT * FROM article where date_pub < ? AND article.date_pub > ? AND theme = ?");
        $sql -> execute(array($finish,$begin,$theme));}

        else {$sql = $conn -> prepare("SELECT * FROM article where date_pub < ? AND article.date_pub > ?");
            $sql -> execute(array($finish,$begin));}

$stmt = $sql;


//Retrieve the data from our table.
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

//The name of the Excel file that we want to force the
//browser to download.
$filename = 'articles.xls';

//Send the correct headers to the browser so that it knows
//it is downloading an Excel file.
header("Content-Type: application/xls;charset=UTF-8");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");



//Define the separator line
$separator = "\t";

//If our query returned rows
if(!empty($rows)){

    //Dynamically print out the column names as the first row in the document.
    //This means that each Excel column will have a header.
    echo implode($separator, array_keys($rows[0])) . "\n";

    //Loop through the rows
    foreach($rows as $row){

        //Clean the data and remove any special characters that might conflict
        foreach($row as $k => $v){
            $row[$k] = str_replace($separator . "$", "", $row[$k]);
            $row[$k] = preg_replace("/\r\n|\n\r|\n|\r/", " ", $row[$k]);
            $row[$k] = trim($row[$k]);
        }

        //Implode and print the columns out using the
        //$separator as the glue parameter
        echo implode($separator, $row) . "\n";
    }
} } }

else { header("Location : ../index.php?message=ExcelDenied");}