<?php
require_once "db-connexion.php";

class ModelWarehouse
{
  private $id;
  private $nom;
  private $ville;
  private $codePost;
  private $directeur;
  private $idDirecteur;
  private $mail;
  private $longitude;
  private $latitude;
  private $depot;
  private $idDepot;
  private $idProduit;
  private $produit;
  private $quantite;
  private $type;
  private $photo;
  private $description;
  private $search;

  public function __construct($id= null, $nom = null, $ville = null, $codePost = null, $directeur=null, $idDirecteur=null, $mail=null, $longitude=null, $latitude=null, $depot=null, $idDepot=null, $idProduit=null, $produit=null, $quantite=null, $type=null, $photo=null, $description=null, $search=null)
  {
    $this->id= $id;
    $this->nom = $nom;
    $this->ville = $ville;
    $this->codePost = $codePost;
    $this->directeur = $directeur;
    $this->idDirecteur = $idDirecteur;
    $this->mail = $mail;
    $this->longitude = $longitude;
    $this->latitude = $latitude;
    $this->depot = $depot;
    $this->idDepot = $idDepot;
    $this->idProduit = $idProduit;
    $this->produit = $produit;
    $this->quantite = $quantite;
    $this->type = $type;
    $this->photo = $photo;
    $this->description = $description;
    $this->search = $search;
  }

  public static function warehouseList()
  {
    $PDO = connexion();
    $request = $PDO->prepare("
    SELECT depot.id, depot.nom, ville, code_post as `codePost`, CONCAT(user.nom,' ',user.prenom) AS `directeur`, `#directeur` AS `idDirecteur` 
    FROM depot 
    INNER JOIN user WHERE user.id = `#directeur`; 
    ");
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getStocks($idDepot) {
    $PDO = connexion();
    $request = $PDO->prepare("
    SELECT `#id_depot` AS idDepot, `#id_pdt` AS idProduit, pdt.nom AS produit, quantite, CONCAT(`#type`,' - ',type_pdt.type) AS type, photo, description
    FROM pdt_depot 
    INNER JOIN pdt ON `#id_pdt` = pdt.id
    INNER JOIN type_pdt ON `#type` = type_pdt.id
    INNER JOIN depot ON `#id_depot` = depot.id;
    ");
    $request->execute([
      ':idDepot' => $idDepot
    ]);
    return $request->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getWarehouse($idDepot) {
    $PDO = connexion();
    $request = $PDO->prepare("
    SELECT depot.id AS idDepot, depot.nom AS depot, ville, code_post AS codePost, longitude, latitude, `#directeur` AS idDirecteur, CONCAT(user.nom,' ',user.prenom) AS directeur, mail
    FROM depot
    INNER JOIN user ON `#directeur`=user.id
    WHERE depot.id = :idDepot;
    ");
    $request->execute([
      ':idDepot' => $idDepot
    ]);
    return $request->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function addWarehouse($nom, $ville, $codePost, $longitude, $latitude, $idDirecteur)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      INSERT INTO depot VALUES ( null, :nom, :ville, :codePost, :longitude, :latitude, :idDirecteur )
    ");
    return $request->execute([
      ':nom' => $nom,
      ':ville' => $ville,
      ':codePost' => $codePost,
      ':longitude' => $longitude,
      ':latitude' => $latitude,
      ':idDirecteur' => $idDirecteur
    ]);
  }

  public static function updateWarehouse($id, $depot, $ville, $codePost, $longitude, $latitude, $idDirecteur)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      UPDATE depot SET nom = :depot, ville = :ville, `code_post` = :codePost, longitude = :longitude, latitude = :latitude, `#directeur` = :idDirecteur WHERE id = :id
    ");
    return $request->execute([
      ':id' => $id,
      ':depot' => $depot,
      ':ville' => $ville,
      ':codePost' => $codePost,
      ':longitude' => $longitude,
      ':latitude' => $latitude,
      ':idDirecteur' => $idDirecteur
    ]);
  }

  public static function deleteWarehouse($id)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      DELETE FROM depot where id= :id;
    ");
    return $request->execute([
      ':id' => $id
    ]);
  }

  public static function search($search)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
    SELECT depot.id AS idDepot, depot.nom AS depot, ville, code_post AS codePost, longitude, latitude, CONCAT(user.nom, ' ', user.prenom ) AS directeur, `#directeur` as idDirecteur 
    FROM depot
    INNER JOIN user
    ON `#directeur` = user.id
    WHERE idDepot LIKE CONCAT('%', :search , '%') OR depot LIKE CONCAT('%', :search , '%') OR ville LIKE CONCAT('%', :search , '%') OR codePost LIKE CONCAT('%', :search , '%') OR directeur LIKE CONCAT('%', :search , '%') OR idDirecteur LIKE CONCAT('%', :search , '%');
  ");

  $request->execute([":search" => $search]);
  return $request->fetchAll(PDO::FETCH_ASSOC);
  }


//getters
public function getId()
{
  return $this->id;
}
  public function getNom()
  {
    return $this->nom;
  }
  public function getVille()
  {
    return $this->ville;
  }
  public function getCodePost()
  {
    return $this->codePost;
  }
  public function getDirecteur()
  {
    return $this->directeur;
  }
  public function getIdDirecteur()
  {
    return $this->idDirecteur;
  }
  public function getMail()
  {
    return $this->mail;
  }
  public function getLongitude()
  {
    return $this->longitude;
  }
  public function getLatitude()
  {
    return $this->latitude;
  }
  public function getDepot()
  {
    return $this->depot;
  }
  public function getIdDepot()
  {
    return $this->idDepot;
  }
  public function getIdProduit()
  {
    return $this->idProduit;
  }
  public function getProduit()
  {
    return $this->produit;
  }
  public function getQuantite()
  {
    return $this->quantite;
  }
  public function getType()
  {
    return $this->type;
  }
  public function getPhoto()
  {
    return $this->photo;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function getSearch()
  {
    return $this->search;
  }
//setters
public function setId($id)
{
  $this->id= $id;
  return $this;
}
  public function setNom($nom)
  {
    $this->nom= $nom;
    return $this;
  }
  public function setVille($ville)
  {
    $this->ville= $ville;
    return $this;
  }
  public function setCodePost($codePost)
  {
    $this->codePost= $codePost;
    return $this;
  }
  public function setDirecteur($directeur)
  {
    $this->directeur= $directeur;
    return $this;
  }
  public function setIdDirecteur($idDirecteur)
  {
    $this->idDirecteur= $idDirecteur;
    return $this;
  }
  public function setMail($mail)
  {
    $this->mail= $mail;
    return $this;
  }
  public function setLongitude($longitude)
  {
    $this->longitude= $longitude;
    return $this;
  }
  public function setLatitude($latitude)
  {
    $this->latitude= $latitude;
    return $this;
  }
  public function setDepot($depot)
  {
    $this->depot= $depot;
    return $this;
  }
  public function setIdDepot($idDepot)
  {
    $this->idDepot= $idDepot;
    return $this;
  }
  public function setIdProduit($idProduit)
  {
    $this->idProduit= $idProduit;
    return $this;
  }
  public function setProduit($produit)
  {
    $this->produit= $produit;
    return $this;
  }
  public function setQuantite($quantite)
  {
    $this->quantite= $quantite;
    return $this;
  }
  public function setType($type)
  {
    $this->type= $type;
    return $this;
  }
  public function setPhoto($photo)
  {
    $this->photo= $photo;
    return $this;
  }
  public function setDescription($description)
  {
    $this->description= $description;
    return $this;
  }
  public function setSearch($search)
  {
    $this->search= $search;
    return $this;
  }
}