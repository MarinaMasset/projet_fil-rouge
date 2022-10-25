<?php 

function connexion() 
{
    require_once "setup.php";

    try {
        $PDO = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
        return $PDO;
    } catch (PDOException $e) {
        print "La connexion au serveur a échoué : " . $e -> getMessage() . "<br/>";
        die;
    }
}