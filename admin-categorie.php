<?php

require('alldata/database.php');

$req_adm_cat = $pdo->prepare("SELECT * FROM categories");
$req_adm_cat->setFetchMode(PDO::FETCH_ASSOC);
$req_adm_cat->execute();
$res_adm_cat = $req_adm_cat->Fetchall();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>administrateur</title>
</head>

<body>

    <?php require_once('header.php'); ?>

<main class="marg">

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">nom</th>
        </tr>
    </thead>
    <tbody>
        <a href="add-categorie.php">Ajouter une nouvelle catégorie</a>

        <?php foreach ($res_adm_cat as $st) { ?>
        
        <tr>
            <td> <?= $st['id']; ?> </td>
            <td> <?= $st['nom']; ?> </td>
            <td> <?php echo '<a href="show-categorie.php?id='.$st['id'] . '">Voir plus</a>'; ?></td>
            <td> <?php echo '<a href="update-categorie.php?id='.$st['id'] . '">Modifier</a>'; ?></td>
            <td> <?php echo '<a href="delete-categorie.php?id='.$st['id'] . '">SUPPRIMER</a>'; ?></td>
        </tr>

        <?php }; ?>
    </tbody>
</table>


</main>

    <?php require_once('footer.php'); ?>

</body>
</html>