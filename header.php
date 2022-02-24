<?php 

if(!isset($_SESSION))
{
    session_start();
}

require_once('alldata/database.php');

@$log = $_SESSION['logged'];

$req_user = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = '$log'");
$req_user->setFetchMode(PDO::FETCH_ASSOC);
$req_user->execute();
$res_user = $req_user->Fetchall();

$req_cat = $pdo->prepare("SELECT categories.* FROM categories");
$req_cat->setFetchMode(PDO::FETCH_ASSOC);
$req_cat->execute();
$res_cat = $req_cat->Fetchall();

$req_art_tri = $pdo->prepare("SELECT categories.*, articles.id_categorie FROM categories INNER JOIN articles WHERE categories.id = articles.id_categorie");
$req_art_tri->setFetchMode(PDO::FETCH_ASSOC);
$req_art_tri->execute();
$res_art_tri = $req_art_tri->Fetchall();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mdb.min.css" />
    <link rel="stylesheet" href="css/pages.css" type="text/css"/>
    <link rel="stylesheet" href="css/navbar.css" type="text/css"/>
    <style> @import url('https://fonts.googleapis.com/css2?family=Quicksand&display=swap');</style>
</head>

<body>

<header>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-scroll">
    
    <div class="container-fluid">
    
        <a class="navbar-brand" href="index.php">GAMA</a>
    
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i><img src="img/nav.png"/></i>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
        <ul class="navbar-nav me-auto">
    
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">accueil</a></li>
                        
        <?php if (!isset($log)) { ?>
    
            <li class="nav-item"><a class="nav-link" href="inscription.php">inscription</a></li>
    
            <li class="nav-item"><a class="nav-link" href="connexion.php">connexion</a></li>
                
        <?php } ?>
                        
        <?php if(isset($log)) { ?>
    
            <li class="nav-item"><a class="nav-link" href="articles.php?page=1">articles</a></li>
    
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                catégories
            </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    
                    <?php foreach ($res_cat as $categorie) { ?>
                        <a class="dropdown-item" href="articles.php?categorie=<?= $categorie['nom'] ?>&page=1"><?= $categorie['nom'] ?></a>
                    <?php } ?>
    
                </div>
            </li>
    
            <?php if($res_user[0]['id_droits'] == '1337') { ?>
            
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                admin
            </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="admin-user.php">users</a>
                    <a class="dropdown-item" href="admin-categorie.php">catégories</a>
                    <a class="dropdown-item" href="admin-article.php">articles</a>
                </div>
            </li>
            <?php } ?>
    
        <?php if($res_user[0]['id_droits'] == '1337' || $res_user[0]['id_droits'] == '42') { ?>
    
            <li class="nav-item"><a class="nav-link" href="creer-article.php">créer un article</a></li>
    
        <?php } ?>
    
            <li class="nav-item"><a class="nav-link" href="profil.php">profil</a></li>
    
            <li class="nav-item"><a class="nav-link" href="deconnexion.php">déconnexion</a></li>
    
        </ul>
        
        <?php } ?>
    

    
    </div> 
    </div>
    
    </nav>
    
</header>
    
    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    
</body>
    
</html>
