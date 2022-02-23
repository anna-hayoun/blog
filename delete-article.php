<?php

session_start();

require('alldata/database.php');
    
$Gid = $_GET['id'];

$req = $pdo->query("DELETE FROM `articles` WHERE id = $Gid");

header('location: admin-article.php');

?>