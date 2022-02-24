<?php

session_start();

require('alldata/database.php');

$Gid = $_GET['id'];
@$login = $_POST['login'];
@$password = $_POST['password'];

$hashed_pwrd = password_hash($password, PASSWORD_DEFAULT);
$new_pass= $hashed_pwrd;

$query = $pdo->query("SELECT * FROM `utilisateurs` WHERE `id`= '$Gid'");
$result = $query->fetch(PDO::FETCH_ASSOC);

$req_con_user = $pdo->query("SELECT * FROM `utilisateurs` WHERE `login` = '$login'");
$req_confetch = $req_con_user->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['valider_droits']))
{
    if ($_POST["droits"] == 'utilisateur') 
    {
        $droits = 1;
    }
    else if ($_POST["droits"] == 'moderateur') 
    {
        $droits = 42;
    }
    else if ($_POST["droits"] == 'administrateur') 
    {
        $droits = 1337;
    }

    $updatedr = $pdo->prepare("UPDATE `utilisateurs` SET `id_droits`='$droits' WHERE `id` = '$Gid'");
    $updatedr->execute();

    header('location: admin-user.php');
}

if(isset($_POST['valider_log']))
{
    if(count($req_confetch) == 0)
    {
        $result = $_POST['login'];
        $newlog = $_POST['login'];

        $update = $pdo->prepare("UPDATE `utilisateurs` SET `login`='$login' WHERE `id` = '$Gid'");
        $update->execute();

        header('location: admin-user.php');
    } 
    elseif(count($req_confetch) != 0)
    {
        echo "Nom d'utilisateur déjà utilisé";
    }
}
            
if(isset($_POST['valider_pass']))
{
    $password = $result['password'];
            
    $update2 = $pdo->prepare("UPDATE `utilisateurs` SET `password` = '$new_pass' WHERE `id` = '$Gid'");
    $update2->execute();

    header('location: admin-user.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/admin.css" type="text/css"/>
    <link rel="stylesheet" href="css/upd-form.css" type="text/css"/>
    <title>administrateur</title>
</head>

<body>

    <?php require('header.php'); ?>

<main>
    
<h2 class="profil-of">Profil de <?php echo $result['login'] ?> </h2>

<form action="" method="post">

<div class="form-contain">
    <div class="form-outline mb-4">
        <label for="login" class="form-label">Nouveau nom d'utilisateur :</label>
        <input class="form-control" type="text" name="login" placeholder="Nom d'utilisateur" value ="<?php echo $result['login'] ?>" autocomplete="off">
    </div>
        
    <button type="submit" class="btn btn-dark btn-rounded" name="valider_log">Valider</button>  
</div>

<div class="form-contain">
    <div class="form-outline mb-4">
        <label for="password" class="form-label">Nouveau password :</label>
        <input type="password" class="form-control" name="password" placeholder="Mot de passe" autocomplete="off">
    </div>
            
    <button type="submit" name="valider_pass" class="btn btn-dark btn-rounded">Valider</button></br>
</div>

<div class="form-contain">
    <select name="droits" id="droits">
        <option value="utilisateur">utilisateur</option>
        <option value="moderateur">modérateur</option>
        <option value="administrateur">administrateur</option>
    </select></br></br>
    
    <button type="submit" name="valider_droits" class="btn btn-dark btn-rounded">Valider</button>
</div>

</form>       
        
</main>

    <?php require('footer.php'); ?>

</body>
</html>