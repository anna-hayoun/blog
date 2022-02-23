<?php

// Connexion à la base de donnée en PDO

$user = 'root'; 
$pass = '';

try
{
    $pdo = new PDO('mysql:host=localhost;dbname=blog', $user, $pass);
}

// Vérifier la connexion

catch(PDOException $error)
{
    echo "Erreur :" . $error->getMessage();
    die();
}

?>