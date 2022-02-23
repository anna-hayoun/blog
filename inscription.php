<?php

require('models/Users.php');

$loginRes = new User();

if (!empty($_POST))
{
    $errors = array();
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (empty($_POST['login']))
    {
        $errors['login'] = "Veuillez remplir tous les champs.";
    }
    else
    {
        $test = $loginRes->Findlog($login);

        if (count($test) != 0)
        {
            $errors['login'] = "Login déjà utilisé.";
        }
    }

    if (empty($_POST['email']))
    {
        $errors['email'] = "Veuillez remplir tous les champs.";
    }
    else
    {
        $testemail = $loginRes->Findemail($login);
    
        if (count($emailRes) != 0)
        {
            $errors['email'] = "Email déjà utilisé.";
        }
    }

    if (empty($_POST['password']))
    {
        $errors['password'] = "Veuillez remplir tous les champs.";
    }

    if ($_POST['password'] != $_POST['password_confirm'])
    {
        $errors['password_confirm'] = "Les mots de passes doivent être identiques.";
    }

    if (empty($errors))
    {
        $password = password_hash($password, PASSWORD_BCRYPT);

        $testpass = $loginRes->INSERTuser($login, $password, $email);

        session_start();
        $_SESSION['flash']['sucess'] = "Votre compte a bien été créer, vous pouvez vous connecter.";

        header('location: connexion.php');
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="css/form.css" type="text/css"/>
    <title>Inscription</title>
</head>

<body>

    <?php require('header.php'); ?>

<main class="flexbox-col">
     
<?php if(!empty($errors)): ?>
    <div class="error">
        <p>Le formulaire est incomplet.</p>
            
        <ul>
            <?php foreach($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>

    </div>
<?php endif; ?>

<div class="form-wrapper">

<form id="form" method="post" action="">

    <h3 class="form-title">Inscription</br></h3>

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

    <div class="form-input-max">
        <p class="form-text">Email</p>
        <div class="form-input-wrapper flexbox-left">
            <input class="form-input" id="email" name="email" type="email" placeholder="Email" aria-label="" required>
        </div>
    </div>

    <div>
        <p class="form-text">Confirmer le mot de passe</p>
        <div class="form-input-wrapper flexbox-left">
            <input class="form-input" id="pword" name="password_confirm" type="password"  aria-label="" required>
        </div>
        </div>
    </div></br>

    <p class="form-undertitle">Vous avez déjà un compte ? <a href="connexion.php"> Connectez-vous</a></p>
    
    
     <div class="form-input-max flexbox-left">
        <div class="button-wrapper">
            <button id="form-button" name="submit" type="submit" class="button btn-primary"> S'inscrire</button>
        </div>
    </div>

</form>

</div>

</main>

<?php require_once('footer.php'); ?>

</body>
</html>