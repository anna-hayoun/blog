<?php

require('alldata/database.php');

$queryShow = $pdo->query("SELECT * FROM `articles` ORDER BY `date` DESC LIMIT 3");
$showArticle = $queryShow->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Accueil</title>
    <link rel="stylesheet" href="css/pages.css" type="text/css"/>
</head>

<body>

    <?php require_once('header.php'); ?>

<main>

<?php if(isset($log)) { ?>

<section>
    <div id="intro" class="bg-image" style="background-image: url(img/index_gam.jpg); height: 100vh;">
        <div class="mask" style="background-color: rgba(0, 0, 0, 0.2);">
            <div class="container d-flex justify-content-center align-items-center h-100">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h1 class="mb-0 text-white display-1">Bienvenue</br></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="background">
<div class="back-cont">

<section>

    <?php foreach($showArticle as $article) { ?>

<article class="card">
    <div class="card__wrapper">
        <div class="card__box">
        <div class="card__item card__header">
            <h4 class="card__item card__item--small card__title"><?= $article['titre']; ?></h4>
                <hr class="card__item card__divider">
            <section class="card__item card__body">
                <p class="card-text"><?= $article['article']; ?></p>
            </section>
            <h6 class="card-footer text-muted"><?= $article['date']; ?></h6>

            <?php echo '<a class="btn btn-light btn-rounded" href="article.php?id=' . $article['id'] .'">Voir plus</a>'; ?>
        </div>
        </div>
    </div>
</article>    
        
    <?php } ?>
        
    </br></br></br><a class="btn btn-light btn-rounded" href="articles.php">Voir tous les articles</a>
</section>

</div>
</div>


<?php } else { ?>

<main>
<section>
    <div id="intro" class="bg-image" style="background-image: url(img/retro.jpg); height: 100vh;">
        <div class="mask" style="background-color: rgba(0, 0, 0, 0.2);">
            <div class="container d-flex justify-content-center align-items-center h-100">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h1 class="mb-0 text-white display-1">GAMA</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div id="intro" class="bg-image" style="background-image: url(img/gameboy.jpg); height: 100vh;">
        <div class="mask" style="background-color: rgba(0, 0, 0, 0.2);">
            <div class="container d-flex justify-content-center align-items-center h-100">
                <div class="row align-items-center">
                    <div class="col-12">
                    <p class="home-sub"><b>Découvrez des tas d'articles sur l'univers d'internet et du gaming</b></br> <a href="inscription.php">Rejoignez-nous !</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
<div class="container my-5 py-5"></div>


<?php } ?>

</main>

<?php require_once('footer.php'); ?>

</body>

</html>