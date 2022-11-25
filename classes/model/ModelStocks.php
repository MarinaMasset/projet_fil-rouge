<?php
// require_once "db-connexion.php";

// class ModelStocks
// {
//   private $productId;
//   private $productName;
//   private $quantity;
//   private $type;
//   private $photo;
//   private $description;
//   private $warehouseID;
//   private $warehouseName;
//   private $city;
  
 

//   public function __construct($productId = null, $productName = null, $quantity = null, $type = null, $photo =null, $description = null, $warehouseID=null, $warehouseName=null,$city)
//   {
//     $this->id = $productId;
//     $this->nom = $productName;
//     $this-> $quantity;
//     $this->prenom = $type;
//     $this->mail = $photo;
//     $this->pass = $description;
//     $this->pass = $warehouseID;
//     $this->pass = $warehouseName;
//     $this->pass = $city;

//   public static function userList()
//   {
//     $PDO = connexion();
//     $request = $PDO->prepare("
//       SELECT * FROM user
//     ");
//     $request->execute();
//     return $request->fetchAll(PDO::FETCH_ASSOC);
//   }