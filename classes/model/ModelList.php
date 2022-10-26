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



//Getters & Setters
public function getId()
  {
    return $this->id;
  }

  public function getNom()
  {
    return $this->nom;
  }

  public function getPrenom()
  {
    return $this->prenom;
  }

  public function getMail()
  {
    return $this->mail;
  }

  public function getPass()
  {
    return $this->pass;
  }

  public function getTel()
  {
    return $this->tel;
  }

  public function getRole()
  {
    return $this->role;
  }

  public function setId($id)
  {
    $this->id = $id;
    return $this;
  }

  public function setNom($nom)
  {
    $this->nom = $nom;
    return $this;
  }

  public function setPrenom($prenom)
  {
    $this->prenom = $prenom;
    return $this;
  }

  public function setMail($mail)
  {
    $this->mail = $mail;
    return $this;
  }

  public function setPass($pass)
  {
    $this->pass = $pass;
    return $this;
  }

  public function setTel($tel)
  {
    $this->tel = $tel;
    return $this;
  }

  public function setRole($role)
  {
    $this->role = $role;
    return $this;
  }

}