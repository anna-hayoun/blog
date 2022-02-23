<?php 

require('alldata/database.php');

if (isset($_POST['submit']))
{
    if ($_POST["droits"] == 'utilisateur') 
    {
        $droits = 1;
    }
    else if ($_POST["droits"] == 'moderateur') 
    {
        $droits = 47;
    }
    else if ($_POST["droits"] == 'administrateur') 
    {
        $droits = 1337;
    }
        
    $user = $_POST['utilisateur'];
    $admin = $_POST['administrateur'];
    $modo = $_POST['moderateur'];

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
            $log_ver = $pdo->prepare("SELECT `login` FROM `utilisateurs` WHERE `login` = '$login'");
            $log_ver->setFetchMode(PDO::FETCH_ASSOC);
            $log_ver->execute();
            $res_log_ver = $log_ver->fetchall();

            if (count($res_log_ver) != 0)
            {
                $errors['login'] = "Ce nom d'utilisateur est déjà utilisé.";
            }
        }

        if (empty($_POST['email']))
        {
            $errors['email'] = "Veuillez remplir tous les champs.";
        } 
        else 
        {
            $mail_ver = $pdo->prepare("SELECT `email` FROM `utilisateurs` WHERE `login` = '$login'");
            $mail_ver->setFetchMode(PDO::FETCH_ASSOC);
            $mail_ver->execute();
            $res_mail_ver = $mail_ver->fetchall();

            if (count($res_mail_ver) != 0)
            {
                $errors['email'] = "Cet email est déjà utilisé.";                
            }
        }

        if (empty($_POST['password']))
        {
            $errors['password'] = "Veuillez remplir tous les champs.";
        }

        if ($_POST['password'] != $_POST['password_confirm'])
        {
            $errors['password_confirm'] = "Les mots de passe doivent être identiques.";
        }

        if (empty($errors))
        {
            $password = password_hash($password, PASSWORD_BCRYPT);
            
            $pass_ver = $pdo->prepare("INSERT INTO `utilisateurs`(`login`,`password`,`email`,`id_droits`) VALUES ('$login','$password','$email', $droits)");
            $pass_ver->setFetchMode(PDO::FETCH_ASSOC);
            $pass_ver->execute();
            $res_pass_ver = $pass_ver->fetchall();

            session_start();

            $_SESSION['flash']['sucess'] = "Votre compte a bien été créé, vous pouvez vous connecter.";
            header('location: admin.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajout-utilisateurs</title>
</head>

<body>

    <?php require('header.php'); ?>

<main>
    <?php if(!empty($errors)): ?>
        <div class="errors">
            </ul>
                <?php foreach($errors as $error): ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

<form action="" method="post" class="form-horizontal">
        
    <h1>Ajout d'utilisateur</h1>

    <div class="form-group">
        <label for="login" class="col-sm-4 control-label">Username</label>
        <div class="col-sm-6">
            <input type="text" name="login" class="form-control" id="login" placeholder="Nom d'utilisateur" class="">
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="col-sm-4 control-label">Email</label>
        <div class="col-sm-6">
            <input type="text" name="email" class="form-control" id="email" placeholder="Email" class="">
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="col-sm-4 control-label">Mot de passe</label>
        <div class="col-sm-6">
            <input type="password" name="password" class="form-control" id="email" placeholder="Mot de passe" class="">
        </div>
    </div>
        
    <div class="form-group">
        <label for="password_confirm" class="col-sm-4 control-label">Confirmez votre mot de passe</label>
        <div class="col-sm-6">
            <input type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="Confirmer le mot de passe" class="">
        </div>
    </div>

    <select name="droits" class="col-sm-4 form-control">
        <option value="utilisateur">utilisateur</option>
        <option value="moderateur">modérateur</option>
        <option value="administrateur">administrateur</option>
    </select>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="submit" class="btn btn-warning">Ajouter</button>
        </div>
    </div>

</form>

</main>

    <?php require_once('footer.php'); ?>

</body>
</html>