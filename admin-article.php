<?php

session_start();

require('alldata/database.php');

if (isset($_SESSION['admin']))
{
    $req_art = $pdo->prepare("SELECT * FROM articles");
    $req_art->setFetchMode(PDO::FETCH_ASSOC);
    $req_art->execute();
    $res_art = $req_art->Fetchall();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>administrateur</title>
</head>

<body>

<?php require_once('header.php') ?>

<main class="marg">
  
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">titre</th>
            <th scope="col">article</th>
            <th scope="col">id_utilisateur</th>
            <th scope="col">id_categorie</th>
            <th scope="col">date</th>
        </tr>
    </thead>
    <tbody>
        <a href="creer-article.php">Ecrire un nouvel article</a>
        
        <?php foreach ($res_art as $st) { ?>
            <tr>
                <td> <?= $st['id']; ;?> </td>
                <td> <?= $st['titre']; ;?> </td>
                <td> <?= $st['article']; ?> </td>
                <td> <?= $st['id_utilisateur']; ?> </td>
                <td> <?= $st['id_categorie']; ?> </td>
                <td> <?= $st['date']; ?> </td>
            </tr>
            <tr>
                <td></td>
                <td> <?php echo '<a href="show-article.php?id='.$st['id'] . '">voir  </a>';?></td>
                <td> <?php echo '<a href="update-article.php?id='.$st['id'] . '">modifier  </a>';?></td>
                <td> <?php echo '<a href="delete-article.php?id='.$st['id'] . '">SUPPRIMER   </a>';?></td>
            </tr>
        <?php }; ?>
    </tbody>
</table>

</main>

    <?php require_once('footer.php'); ?>

</body>

</html>