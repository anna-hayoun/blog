<?php

require('alldata/database.php');
    
$Gid = $_GET['id'];

$req = $pdo->prepare("SELECT * FROM utilisateurs where id = '$Gid'");
$req->setFetchMode(PDO::FETCH_ASSOC);
$req->execute();
$result = $req->Fetchall();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>administrateur</title>
</head>
<body>

    <?php require('header.php'); ?>

<main>

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
        <?php foreach ($result as $st) {  ?>
            <tr>
                <td> <?= $st['id']; ;?> </td>
                <td> <?= $st['login']; ?> </td>
                <td> <?= $st['password']; ?> </td>
                <td> <?= $st['email']; ?> </td>
                <td> <?= $st['id_droits']; ?> </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</main>

    <?php require_once('footer.php'); ?>

</body>
</html>