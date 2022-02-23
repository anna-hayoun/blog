<?php 

if (!isset($_SESSION))
{
    session_start();
}

require('alldata/database.php');

if (isset($_SESSION['admin']))
{
    // $req_admin = $pdo->query("SELECT * FROM utilisateurs");
    // $res_admin = $req_admin->fetchAll(PDO::FETCH_ASSOC);
    $req_admin = $pdo->prepare("SELECT * FROM utilisateurs");
    $req_admin->setFetchMode(PDO::FETCH_ASSOC);
    $req_admin->execute();
    $res_admin = $req_admin->Fetchall();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/admin.css" type="text/css"/>
    <title>page-administrateur</title>
</head>

<body>

<?php require_once('header.php'); ?>

<main>
    
<?php if (isset($_SESSION['admin'])) 
        { ?>
            </br></br></br></br></br></br><a class="newser" href="add-users.php">Ajouter un nouvel utilisateur</a>
        <?php } ?>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">login</th>
            <th scope="col">password</th>
            <th scope="col">email</th>
            <th scope="col">id_droits</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($res_admin as $infos) { ?>
            <tr>
                <td> <?= $infos['id']; ;?> </td>
                <td> <?= $infos['login']; ?> </td>
                <td> <?= $infos['password']; ?> </td>
                <td> <?= $infos['email']; ?> </td>
                <td> <?= $infos['id_droits']; ?> </td>
            </tr>

            <tr>
                <td></td>
                <td> <?php echo '<a href="show-user.php?id='.$infos['id'] . '">Voir</a>';?></td>
                <td> <?php echo '<a href="update-user.php?id='.$infos['id'] . '">Modifier</a>';?></td>  
                <td> <?php echo '<a href="delete-user.php?id='.$infos['id'] . '">Supprimer</a>';?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</main>

<?php require_once('footer.php'); ?>

</body>
</html>