<?php 
require_once "db-connexion.php";

class UserConnexion {

public static function connexionUser($login){
    $PDO = connexion();
    $requete = $PDO->prepare("
      SELECT * FROM user WHERE mail=:mail
    ");

    $requete->execute([
      ':mail' => $login,
    ]);
    return $requete->fetch(PDO::FETCH_ASSOC);
  }
}