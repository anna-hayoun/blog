<?php 

session_start();

require('alldata/database.php');

$id = $_GET['id'];

$req_arts = $pdo->prepare("SELECT * FROM `articles` WHERE id = '$id'");
$req_arts->setFetchMode(PDO::FETCH_ASSOC);
$req_arts->execute();
$res_arts = $req_arts->Fetchall();

$query = $pdo->prepare("SELECT utilisateurs.login, commentaires.commentaire, commentaires.date, commentaires.id_article FROM utilisateurs INNER JOIN commentaires WHERE utilisateurs.id = commentaires.id_utilisateur");
$query->setFetchMode(PDO::FETCH_ASSOC);
$query->execute();
$res_log = $query->Fetchall();

if(isset($_POST['submit']))
{
    $date_time = date('Y-m-d h:i:s', time());
    $id_sess = $_SESSION['user_id'];
    $comm = $_POST['commentaire'];

    $res = $pdo->prepare("INSERT INTO commentaires (commentaire, id_article, id_utilisateur, date) VALUES ('$comm','$id','$id_sess','$date_time')");
    $res->execute();

    if(isset($res))
    {
        $query = $pdo->prepare("SELECT utilisateurs.login, commentaires.commentaire, commentaires.date, commentaires.id_article FROM utilisateurs INNER JOIN commentaires WHERE utilisateurs.id = commentaires.id_utilisateur");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute();
        $res_log = $query->Fetchall();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/form.css" type="text/css"/>
    <title>Article</title>
</head>

<body>

    <?php require('header.php'); ?>

<main class="marg">

<article>
    <div class="card__box">
        <div class="card__item card__header">
                <h4 class="card__item card__item--small card__title"><?= $res_arts[0]['titre'] ?></h4>
                    <hr class="card__item card__divider">
                <section class="card__item card__body">
                    <h2><?= $res_arts[0]['article'] ?></h2>
                </section> 
                <h6 class="card-footer text-muted"><?= $res_arts[0]['date'] ?></h6>
        </div>
    </div>
</article>

<table class="table table-hover">
    <tbody>
        <tr>
            <th>Commentaire :</th>
            <th>par :</th>
    <?php foreach($res_log as $log)
    {
        if($log['id_article'] == $id) 
        { ?>
        <tr>
            <td><?= $log['commentaire']?></td>
            <td><?= $log['login']?></td><br>
    <?php }
    } ?> 
        </tr>
        </tr>
    </tbody>
</table>

<div class="form-wrapper">

<form action="" method="POST" class="form-horizontal">

    <div class="form-group">
        <textarea name="commentaire" class="form-control" rows="3" placeholder="Ecrivez votre commentaire"></textarea>
    </div></br></br>
    
        <button id="form-button" name="submit" type="submit" class="btn btn-dark">Envoyer</button>

</form>

</div>

</main>

    <?php require_once('footer.php'); ?>

</body>
</html>
