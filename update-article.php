<?php

session_start();

require('alldata/sqli-database.php');
require('alldata/database.php');

$Gid = $_GET['id'];

@$page_categorie = $_POST['categorie'];
@$title_art = $_POST['title'];
@$article = $_POST['article'];
@$new_date = $_POST['date_time'];

$logd = $_SESSION['logged'];
$Date_Time = date('Y-m-d h:i:s', time());

$sql_categori = $pdo->prepare("SELECT * FROM `categories` WHERE `nom` = '$page_categorie'");
$sql_categori->setFetchMode(PDO::FETCH_ASSOC);
$sql_categori->execute();
$result1 = $sql_categori->Fetchall();

$id_categorie = $result1[0]['id'];

$query = $pdo->query("SELECT * FROM `articles` WHERE `id`= '$Gid'");
$result = $query->fetchall(PDO::FETCH_ASSOC);

@$id_user = $result[0]['id_utilisateur'];

$queryCategories = $pdo->query("SELECT * FROM `categories`");
$queryCategories->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['submit']))
{
    $upd_article = $pdo->prepare("UPDATE `articles` SET `titre` = '$title_art', `article` = '$article', `id_utilisateur` = '$id_user', `id_categorie` = '$id_categorie', `date` = '$new_date' WHERE id = '$Gid'");
    $upd_article->execute();

    header('location: admin-article.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/upd-form.css" type="text/css"/>
    <title>administrateur</title>
</head>

<body>

    <?php require('header.php'); ?>

<main>

<form action="" method="POST" class="form-inline">

    <div class="form-outline mb-4">
        <label for="title" class="form-label">Changer le titre</label>
        <input type="text" name="title" class="form-control" id="inputName3" placeholder="Titre"></input>
    </div>

    <div class="form-outline mb-4">
        <label for="article" class="form-label">Modifier l'article</label>
        <textarea class="form-control" name="article" row="4"></textarea>
    </div>

        <select name="categorie" class="browser-default custom-select">
            <?php foreach ($queryCategories as $categorie) { ?>
                <option value="<?php echo $categorie['nom']; ?> "><?php echo $categorie['nom']; ?> </option>
            <?php } ?>
        </select></br></br>

        <input type="datetime-local" name="date_time" value="<?php $Date_Time ?>" min="<?php $Date_Time ?>" max="2030-01-14T00:00">
    
        <button name="submit" type="submit" class="btn btn-dark btn-rounded">Modifier</button>
</form>

</main>

<?php require('footer.php'); ?>

</body>
</html>