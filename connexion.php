<?php

require('alldata/database.php');

if (!empty($_POST) && !empty($_POST['login']) && !empty($_POST['password']))
{
    $login = $_POST['login'];
    $password = $_POST['password'];
    $errors = array();

    $query = $pdo->prepare("SELECT * FROM `utilisateurs` WHERE `login` = '$login'");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();
    $user = $query->fetchall();

    if (password_verify($password, $user['0']['password']))
    {
        if ($user[0]['id_droits'] == 1337)
        {
            session_start();

            $_SESSION['admin'] = $user;
            $_SESSION['logged'] = $user['0']['login'];
            $_SESSION['user_pass'] = $user['0']['password'];
            $_SESSION['user_id'] = $user['0']['id'];
            $_SESSION['flash']['error'] = "Vous êtes connecté.";
            
            header('Location: index.php');
        }
        else
        {
            session_start();

            $_SESSION['logged'] = $user['0']['login'];
            $_SESSION['user_pass'] = $user['0']['password'];
            $_SESSION['user_id'] = $user['0']['id'];
            $_SESSION['flash']['error'] = "Vous êtes connecté.";
                
            header('location: index.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/form.css" type="text/css"/>
    <title>Connexion</title>
</head>
<body>

    <?php require_once('header.php'); ?>

<main class="flexbox-col">

    <?php if (!empty($errors)): ?>
        <div>
            <p>Veuillez completer correctement le formulaire de connexion.</p>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
        </div>
    <?php endif; ?>
    

<div class="form-wrapper">
  
<form id="form" method="post" action="" class="form-horizontal">
      
    <h3 class="form-title">Connexion</h3>
        
    <div class="form-input-grid">
        <div>
            <p class="form-text">Username</p>
            <div class="form-input-wrapper flexbox-left">
                <input class="form-input" id="uname" name="login" type="text" placeholder="Username" aria-label="" required>
            </div>
        </div>
          
        <div>
            <p class="form-text">Mot de passe</p>
            <div class="form-input-wrapper flexbox-left">
                <input class="form-input" id="pword" name="password" type="password" placeholder="Mot de passe" aria-label="" required>
            </div>
        </div>
    </div>

    <p class="form-undertitle">Vous n'avez pas de compte ? <a href="inscription.php"> Inscrivez-vous</a></p>
      
    <div class="form-input-max flexbox-left">
        <div class="button-wrapper">
            <button id="form-button" name="submit" type="submit" class="button btn-primary">Connexion</button>
        </div>
    </div>
</form>

</div>
  
</main>

    <?php require_once('footer.php'); ?>

</body>