<?php

session_start();

require('alldata/database.php');

// Recuperer les informations de session:
$userLog = $_SESSION['logged'];
$userPass = $_SESSION['user_pass'];
$userId = $_SESSION['user_id'];

$upd_log = isset($_POST['login']) ? $_POST['login'] : '' ;

$password = isset($_POST['password']) ? $_POST['password'] : '';
$pass_hash = password_hash($password, PASSWORD_DEFAULT);
$upd_pass = $pass_hash;

if (isset($_SESSION['logged'])) 
{
    $req = $pdo->prepare("SELECT login, password FROM `utilisateurs` WHERE `id`= '$userId'");
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute();

    if (isset($req))
    {
        $recup = $req->fetchall(PDO::FETCH_COLUMN);
    }

    $reqy = $pdo->prepare("SELECT password FROM `utilisateurs` WHERE `id`= '$userId'");
    $reqy->setFetchMode(PDO::FETCH_ASSOC);
    $reqy->execute();

    if (isset($reqy))
    {
        $recupR = $reqy->fetchall(PDO::FETCH_COLUMN);
    }
}

$upd_query = $pdo->prepare("SELECT * FROM `utilisateurs` WHERE `login` = '$upd_log'");
$upd_query->setFetchMode(PDO::FETCH_ASSOC);
$upd_query->execute();
$upd_res = $upd_query->Fetchall();

if (isset($_POST['sub']))
{
    if (!empty($_POST['login']))
    {
        if ($upd_query->rowCount($upd_res) == 0)
        {
            $upd_log = $_POST['login'];

            $update = $pdo->prepare("UPDATE `utilisateurs` SET `login`= '$upd_log' WHERE `id` = '$userId'");
            $update->setFetchMode(PDO::FETCH_ASSOC);
            $update->execute();

            if(isset($update_req)) 
            {
                $req = $pdo->prepare("SELECT `login` FROM `utilisateurs` WHERE `id`= '$userId'");
                $req->setFetchMode(PDO::FETCH_ASSOC);
                $req->execute();
                $recup = $req->fetchall(PDO::FETCH_COLUMN);
            }
        } 
        elseif ($upd_query->rowCount($upd_res) != 0)
        {
            echo "Nom d'utilisateur déjà utilisé.";
        }
    }
    
    if (!empty($_POST['password']))
    {
        $updateP = $pdo->prepare("UPDATE `utilisateurs` SET `password`='$upd_hash' WHERE `login` = '$userLog'");
        $updateP->setFetchMode(PDO::FETCH_ASSOC);
        $updateP->execute();
        $update_pass = $updateP->fetchall();
    }

    $upd_query_re = $pdo->prepare("SELECT * FROM `utilisateurs` WHERE `id` = '$userId'");
    $upd_query_re->setFetchMode(PDO::FETCH_ASSOC);
    $upd_query_re->execute();
    $upd_res_re = $upd_query_re->Fetchall();

    header('Location: profil.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/upd-form.css" type="text/css"/>
    <title>Profil</title>
</head>

<body>

    <?php require('header.php'); ?>

<main>

    <h2 class="acc-profil"> Profil de <?php echo $recup[0] ?> </h2>

<form action="profil.php" method="post" class="form-horizontal">

    <div class="form-outline mb-4">
        <label for="login" class="form-label">Nouveau nom d'utilisateur</label><br>
        <input type="login" name="login" class="form-control" placeholder="Nom d'utilisateur" value="<?php echo $recup[0]; ?>" autocomplete="off">
    </div>

    <div class="form-outline mb-4">
        <label for="password" class="form-label">Nouveau mot de passe</label><br>
        <input type="password" name="password" class="form-control" placeholder="Mot de passe" value="*****" autocomplete="off">
    </div>

        
    <button type="submit" name="sub" class="btn btn-dark">Modifier</button>  
    
</form>
</div>
 
</main>


    <?php require_once('footer.php'); ?>

</body>

</html>
