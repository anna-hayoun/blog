<?php

class User
{
    public $connexion;

    public function __construct()
    {
        $user = 'root'; 
        $pass = '';

        try
        {
            $pdo = new PDO('mysql:host=localhost;dbname=blog', $user, $pass);
            $this->connexion = $pdo;
            
        }

        // Vérifier la connexion

        catch(PDOException $error)
        {
            echo "Erreur :" . $error->getMessage();
            die();
        }
    }

    public function Findlog($login)
    {
        $loginVer = $this->connexion->prepare("SELECT `login` FROM `utilisateurs` WHERE `login` = '$login'");
        $loginVer->setFetchMode(PDO::FETCH_ASSOC);
        $loginVer->execute();
        $loginRes = $loginVer->fetchall();

        return $loginRes;
    }

    public function Findemail($login)
    {
        $emailVer = $this->connexion->prepare("SELECT `email` FROM `utilisateurs` WHERE `login` = '$login'");
        $emailVer->setFetchMode(PDO::FETCH_ASSOC);
        $emailVer->execute();
        $emailRes = $emailVer->fetchall();

        return $emailRes;
    }

    public function INSERTuser($login, $password, $email)
    {
        $passwordVer = $this->connexion->prepare("INSERT INTO `utilisateurs`(`login`,`password`,`email`,`id_droits`) VALUES ('$login','$password','$email',1)");
        $passwordVer->setFetchMode(PDO::FETCH_ASSOC);
        $passwordVer->execute();
    }

}

?>