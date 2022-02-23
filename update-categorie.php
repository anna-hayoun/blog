<?php

session_start();

require('alldata/database.php');

$Gid = $_GET['id'];

// $query = $pdo->query("SELECT * FROM `categories` WHERE `id`= '$Gid'");
// $result = $query->fetchAll(PDO::FETCH_ASSOC);
$query = $pdo->prepare("SELECT * FROM `categories` WHERE `id`= '$Gid'");
$query->setFetchMode(PDO::FETCH_ASSOC);
$query->execute();
$result = $query->Fetchall();

@$cat = $_POST['categorie'];

if(isset($_POST['submit']))
{
    // $upd_categorie = $pdo->query("UPDATE `categories` SET `nom`='$cat' WHERE id = '$Gid'");
    $upd_categorie = $pdo->prepare("UPDATE `categories` SET `nom`='$cat' WHERE id = '$Gid'");
    $upd_categorie->execute();

    header('location: admin-categorie.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="css/admin.css" type="text/css"/>
    <title>Categorie</title>
</head>

<body>

    <?php require('header.php'); ?>

<main>

<form action="" method="POST" class="form-horizontal">

    <div class="form-outline mb-4">
        <label for="categorie" class="form-label">Modifier cette categorie:</label><br>
        <input type="text" class="form-control" name="categorie" value ="<?php echo $result[0]['nom'] ?>" autocomplete="off">
    </div>
        
        <button name="submit" type="submit" class="btn btn-dark btn-rounded">Valider</button>
</form>

</main>

    <?php require('footer.php'); ?>

</body>
</html>
