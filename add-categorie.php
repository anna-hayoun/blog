<?php

require('alldata/database.php');

@$categorie = $_POST['categorie'];

if(isset($_POST['submit']))
{
    $req_add_cat = $pdo->prepare("INSERT INTO `categories`(`nom`) VALUES ('$categorie')");
    $req_add_cat->setFetchMode(PDO::FETCH_ASSOC);
    $req_add_cat->execute();
    
    header('location: admin-categorie.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>ajout-categorie</title>
</head>
<body>

    <?php require_once('header.php'); ?>

<main class="marg">

<form action="" method="post" class="form-horizontal">

    <div class="form-outline mb-4">
        <label for="categorie" class="form-label">Créer une nouvelle catégorie</label>
        <input type="text" name="categorie" class="form-control" id="categorie" placeholder="Catégorie">
    </div>
            
            <button type="submit" name="submit" class="btn btn-dark btn-rounded">Ajouter</button>

</form>

</main>

    <?php require_once('footer.php'); ?>

</body>
</html>