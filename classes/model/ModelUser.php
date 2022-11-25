<?php
require_once "db-connexion.php";

class ModelUser
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
    $request = $PDO->prepare("
      SELECT * FROM user
    ");
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getAccount($id) {
    $PDO = connexion();
    $request = $PDO->prepare("
      SELECT * FROM user where id=:id;
    ");
    $request->execute([
      ':id' => $id
    ]);
    return $request->fetch(PDO::FETCH_ASSOC);
  }

  public static function addUser($nom, $prenom, $mail, $pass, $tel, $role)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      INSERT INTO user VALUES ( null, :nom, :prenom, :mail, :pass, :tel, :role )
    ");
    return $request->execute([
      ':nom' => $nom,
      ':prenom' => $prenom,
      ':mail' => $mail,
      ':pass' => password_hash($pass, PASSWORD_DEFAULT),
      ':tel' => $tel,
      ':role' => $role
    ]);
  }

  public static function modifyUser($id, $nom, $prenom, $mail, $tel, $role)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      UPDATE user SET nom = :nom, prenom = :prenom, mail = :mail, tel = :tel, role = :role WHERE id = :id
    ");
    return $request->execute([
      ':id' => $id,
      ':nom' => $nom,
      ':prenom' => $prenom,
      ':mail' => $mail,
      ':tel' => $tel,
      ':role' => $role
    ]);
  }

  public static function modifyMyAccount($id, $nom, $prenom, $mail, $tel)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      UPDATE user SET nom = :nom, prenom = :prenom, mail = :mail, tel = :tel WHERE id = :id
    ");
    return $request->execute([
      ':id' => $id,
      ':nom' => $nom,
      ':prenom' => $prenom,
      ':mail' => $mail,
      ':tel' => $tel,
    ]);
  }

  public static function deleteUser($id)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      DELETE FROM user where id= :id;
    ");
    return $request->execute([
      ':id' => $id
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