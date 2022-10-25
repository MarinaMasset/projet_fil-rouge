<?php
require_once "db-connexion.php";

class ModelList
{
  private $id;
  private $nom;
  private $prenom;
  private $mail;
  private $pass;
  private $tel;
  private $role;

  public function __construct($id = null, $nom = null, $prenom = null, $mail = null, $pass =null, $tel = null, $role=null)
  {
    $this->id = $id;
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->mail = $mail;
    $this->pass = $pass;
    $this->tel = $tel;
    $this->role = $role;
  }

  public static function userList()
  {
    $PDO = connexion();
    $requete = $PDO->prepare("
      SELECT * FROM user
    ");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function addUser($nom, $prenom, $mail, $pass, $tel, $role)
  {
    $PDO = connexion();
    $requete = $PDO->prepare("
      INSERT INTO contact VALUES ( null, :nom, :prenom, :mail, :pass, :tel, :role )
    ");
    return $requete->execute([
      ':nom' => $nom,
      ':prenom' => $prenom,
      ':mail' => $mail,
      ':pass' => $pass,
      ':tel' => $tel,
      ':role' => $role
    ]);
  }
}