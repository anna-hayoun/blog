<?php

// Connexion à la base de donnée
$conn = mysqli_connect("localhost", "root", "", "blog");

// Vérifier la connexion
if($conn === false)
{
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}

?>