<?php

session_start();

require('alldata/database.php');
require('alldata/sqli-database.php');

$user_log = $_SESSION['logged'];

// Recuperer la bonne catégorie: 
@$page_cat = $_GET['categorie'];

$query_cat = $pdo->query("SELECT * FROM `categories` WHERE `nom` = '$page_cat'");
$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);

// Recuperer toutes les infos utilisateur:
$query_user = $pdo->query("SELECT * FROM `utilisateurs` where login = '$user_log'");
$res_user = $query_user->fetch(PDO::FETCH_ASSOC);

// Recuperer toutes les catégories:
$query_categories = $pdo->query("SELECT * FROM `categories`");
$res_categories = $query_categories->fetchAll(PDO::FETCH_ASSOC);

// Lier id (utilisateur) et id_utilisateur (articles)
$query_join_id = $pdo->query("SELECT * FROM `utilisateurs` INNER JOIN `articles` WHERE utilisateurs.id = articles.id_utilisateur");
$res_join_id = $query_join_id->fetchAll(PDO::FETCH_ASSOC);

// Lier id (catégories) et id_categorie (articles)
$query_join_cat = $pdo->query("SELECT * FROM `categories` INNER JOIN `articles` WHERE categories.id = articles.id_categorie");
$res_join_cat = $query_join_cat->fetchAll();


if(isset($_GET['submit']))
{
    if (($_GET['categorie']) == $page_cat) 
    {
        $id_cat = $res_cat[0]['id'];
        $categories = $id_cat;
    }

    $title_art = $_GET['title'];
    $user_article = $_GET['create_article'];
    $user_id = $res_user['id'];
    $date = date("Y/m/d H:i:s");

    if(empty($user_article))
    {
        echo "Veuillez rédiger un article.";
    }

    $query_article = $pdo->prepare("INSERT INTO `articles` (`titre`, `article`, `id_utilisateur`, `id_categorie`, `date`) VALUES ('$title_art', '$user_article', '$user_id', '$categories', '$date')");
    $query_article->execute();


    if(isset($query_article))
    {
        header('Location: articles.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/form.css" type="text/css"/>
    <title>nouvel-article</title>
</head>

<body>

    <?php require('header.php'); ?>

<div class="frm-marg"></div>

<main class="flexbox-col">

<div class="form-wrapper">

<form id="form" action="" method="GET">

    <h4 class="form-title">Nouvel article </br></br></h4>

<div class="form-input-grid">
    <div>
        <div id="title" class="form-input-wrapper flexbox-left">
            <input type="text" name="title" class="form-input" id="uname" placeholder="Titre"></input>
        </div>
    </div>
</div>

<div class="form-input-max">
      <div id="textarea" class="form-input-wrapper flexbox-left-start">
        <textarea class="form-input" id="message" name="create_article" placeholder="article" maxlength="500" aria-label="" required></textarea>
      </div>
     </div>

    <div>
        <select name="categorie">
            <?php foreach ($res_cat as $categorie) { ?>
                <option value="<?php echo $categorie['nom']; ?>"><?php echo $categorie['nom']; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="butn">
        <button id="form-button" type="submit" name="submit" class="btn btn-dark btn-rounded"> Creer</button>
    </div>
</form>

</div>

</main>

    <?php require_once('footer.php') ?>

</body>

</html>