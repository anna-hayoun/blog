<?php

session_start();

require('alldata/database.php');

$Gid = $_GET['id'];

$req = $pdo->query("DELETE FROM `utilisateurs` WHERE id = $Gid");

header('location: admin-user.php');

?>