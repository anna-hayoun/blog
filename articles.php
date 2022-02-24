<?php

require('alldata/database.php');

// Compter les articles

$req_count_art = $pdo->prepare('SELECT COUNT(*) AS liste FROM `articles`');
$req_count_art->setFetchMode(PDO::FETCH_ASSOC);
$req_count_art->execute();
$res_count_art = $req_count_art->Fetchall();

// Mise en place de la pagination
$page = "";

if(isset($_GET['page']))
{
    $page = $_GET["page"];
}

if (empty($page)) 
{
    $page = 1;
}

$nbr_art_pr_page = 5;
$nbr_page = ceil($res_count_art[0]["liste"] / $nbr_art_pr_page);
$debut = ($page - 1) * $nbr_art_pr_page;


// Recuperer tous les articles

$req_articles = $pdo->prepare("SELECT * FROM `articles` ORDER BY `date` DESC LIMIT $debut , $nbr_art_pr_page");
$req_articles->setFetchMode(PDO::FETCH_ASSOC);
$req_articles->execute();
$articles = $req_articles->Fetchall();

if (count($articles) == 0) 
{
    header("location: articles.php");
}

if(isset($_GET['categorie']))
{
    $page_cat = $_GET['categorie'];
}

$req_info_cat = $pdo->prepare("SELECT categories.* FROM categories");
$req_info_cat->setFetchMode(PDO::FETCH_ASSOC);
$req_info_cat->execute();
$result_cat = $req_info_cat->Fetchall();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Articles</title>
</head>

<body>

    <?php require('header.php') ?>

<main class="marg">

<section>

<form action="" method="GET">

    <select name="categorie">
        <?php foreach ($res_cat as $categorie) { ?>
            <option value="<?php echo $categorie['nom']; ?>"><?php echo $categorie['nom']; ?></option>
        <?php } ?>
    </select>

    <input type='hidden' name='page' value='1'>
    <button type='submit' name="submit" class="btn btn-dark btn-rounded btn-sm">Valider</button>

</form>
 
<div>
    <?php
    
    if (isset($_GET['categorie'])) 
    {
        // Compter les articles par catégorie
        $req_count_art_cat = $pdo->prepare("SELECT COUNT(articles.id_categorie) AS liste_cat FROM `articles` INNER JOIN `categories` ON categories.id = articles.id_categorie WHERE categories.nom = '$page_cat'");
        $req_count_art_cat->setFetchMode(PDO::FETCH_ASSOC);
        $req_count_art_cat->execute();
        $res_count_art_cat = $req_count_art_cat->Fetchall();

        $nbr_art_pr_page_cat = 5;
        $nbr_page_cat = ceil($res_count_art_cat[0]["liste_cat"] / $nbr_art_pr_page_cat);
        $debut_cat = ($page - 1) * $nbr_art_pr_page_cat;
                
        // Recuperer tous les articles par catégorie
        $req_art_cat = $pdo->prepare("SELECT articles.id, articles.titre, articles.date, articles.article, articles.id_utilisateur, articles.id_categorie, categories.nom FROM articles INNER JOIN categories ON categories.id = articles.id_categorie WHERE categories.nom = '$page_cat' ORDER BY date DESC LIMIT $debut_cat");
        $req_art_cat->setFetchMode(PDO::FETCH_ASSOC);
        $req_art_cat->execute();
        $art_cat = $req_art_cat->Fetchall();

        for ($i = 1; $i <= $nbr_page_cat; $i++) 
        {
            if ($page != $i)
            {
                echo "<a href='?page=$i&categorie=$page_cat'>$i</a>&nbsp";
            }
            else
            {
                echo "<a>$i</a>&nbsp";
            }
        }
    } 
    else 
    {
        for ($i = 1; $i <= $nbr_page; $i++) 
        {
            if ($page != $i)
            {
                echo "<a href='?page=$i'>$i</a>&nbsp";
            }
            else
            {
                echo "<a>$i</a>&nbsp";
            }
        }
    }
?>

</div>
</section>

<section>

<?php

// Tri des articles par catégorie
if (isset($_GET['categorie'])) 
{
    if (($_GET['categorie']) == $page_cat) 
    {
        $req_categories = $pdo->prepare("SELECT articles.id, articles.titre, articles.article, articles.date,  articles.id_utilisateur, articles.id_categorie, categories.nom FROM articles INNER JOIN categories ON categories.id = articles.id_categorie WHERE categories.nom = '$page_cat'");
        $req_categories->setFetchMode(PDO::FETCH_ASSOC);
        $req_categories->execute();
        $result = $req_categories->Fetchall();
    }

    // Affichage des articles par catégorie
    if(isset($_GET['page']) && $_GET['page'] == 1)
    {
        for($i = 0; isset($result[$i]) && $i < 5; $i++) 
        { ?>
            <article class="card">
                <div class="card__wrapper">
                    <div class="card__box">
                    <div class="card__item card__header">
                        <h3 class="card__item card__item--small card__title"><?= $result[$i]['titre'] ?></h3>
                            <hr class="card__item card__divider">
                        <section class="card__item card__body">
                            <p><?= $result[$i]['article'] ?></p>
                        </section>
                        <h6 class="card-footer text-muted"><?= $result[$i]['date'] ?></h6>
                        <?php echo '<a type="button" class="btn btn-light btn-rounded" href="article.php?id=' . $result[$i]['id'] . '">Voir cet article</a>'; ?></div>
                    </div>
                    </div>
                </div>
            </article>
        <?php
        }
    }
    else
    {
        for($i = 5; isset($result[$i]) && $i < 10; $i++) 
        { ?>
            <article class="card">
                <div class="card__wrapper">
                    <div class="card__box">
                    <div class="card__item card__header">
                        <h4 class="card__item card__item--small card__title"><?= $result[$i]['titre'] ?></h4>
                            <hr class="card__item card__divider">
                        <section class="card__item card__body">
                            <p><?= $result[$i]['article'] ?></p>
                        </section>
                        <h6 class="card-footer text-muted"><?= $result[$i]['date'] ?></h6>
                    
                        <?php echo '<a type="button" class="btn btn-light btn-rounded" href="article.php?id=' . $result[$i]['id'] . '">Voir cet article</a>'; ?></div>
                    </div>
                    </div>
                </div>
            </article>
            
        <?php
        }
    }
} 
else 
{
    foreach ($articles as $article) 
    { ?>
        <article class="card">
            <div class="card__wrapper">
                <div class="card__box">
                <div class="card__item card__header">
                    <h4 class="card__item card__item--small card__title"><?= $article['titre'] ?></h4>
                        <hr class="card__item card__divider">
                    <section class="card__item card__body">
                        <p><?= $article['article'] ?></p>
                    </section>
                    <h6 class="card-footer text-muted"><?= $article['date'] ?></h6>
   
                    <?php echo '<a type="button" class="btn btn-light btn-rounded" href="article.php?id=' . $article['id'] . '">Voir cet article</a>'; ?></div>
                </div>
                </div>
            </div>
        </article>
    <?php
    }
}
?>

</section>
</div>
</main>

    <?php require('footer.php') ?>

</body>


</html>