<?php 

function connexion() 
{
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname= 'stock' ;

    try {
        $PDO = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
        return $PDO;
    } catch (PDOException $e) {
        print "La connexion au serveur a échoué : " . $e -> getMessage() . "<br/>";
        ViewTemplates::alert("danger", "Oups ! Impossible de récupérer les données depuis la base.");
        die;
    }
}