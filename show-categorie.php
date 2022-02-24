<?php

session_start();

require('alldata/database.php');

$Gid = $_GET['id'];

if(isset($_SESSION['admin']))
{
    $req = $pdo->prepare("SELECT * FROM articles WHERE id = '$Gid'");
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute();
    $result = $req->Fetchall();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>administrateur</title>
</head>

<body>

    <?php require('header.php') ?>

<main>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Article</th>
            <th scope="col">id_utilisateur</th>
            <th scope="col">id_categorie</th>
            <th scope="col">date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $st) {  ?>
            <tr>
                <td> <?= $st['id']; ;?> </td>
                <td> <?= $st['article']; ?> </td>
                <td> <?= $st['id_utilisateur']; ?> </td>
                <td> <?= $st['id_categorie']; ?> </td>
                <td> <?= $st['date']; ?> </td>
            </tr>
        <?php }; ?>
    </tbody>
</table>

</main>

    <?php require('footer.php'); ?>

</body>
</html>