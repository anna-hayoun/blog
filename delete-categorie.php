<?php

session_start();

require('alldata/database.php');

$Gid = $_GET['id'];

$req = $pdo->query("DELETE FROM `categories` WHERE id = $Gid");

header('location: admin-categorie.php');

?>