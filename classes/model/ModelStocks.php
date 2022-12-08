<?php
require_once "db-connexion.php";

class ModelStocks
{
  private $typeId;
  private $type;
  private $productId;
  private $product;
  private $photo;
  private $description;
  private $warehouseId;
  private $quantity;
  

  public function __construct($typeId = null, $type = null, $productId=null, $product=null, $photo=null, $description=null, $warehouseId=null, $quantity=null)
  {
    $this->typeId = $typeId;
    $this->type = $type;
    $this->productId = $productId;
    $this->product = $product;
    $this->photo = $photo;
    $this->description = $description;
    $this->warehouseId = $warehouseId;
    $this->quantity = $quantity;
  }

//Types features
  public static function getTypeList()
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      SELECT id AS typeId, type FROM type_pdt
    ");
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getProductType($typeId)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      SELECT id AS typeId, type FROM type_pdt WHERE id = :typeId;
    ");
    $request->execute([
      ':typeId' => $typeId
    ]);
    return $request->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function addType($type)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      INSERT INTO type_pdt VALUES ( null, :type )
    ");
    return $request->execute([
      ':type' => $type
    ]);
  }

  public static function updateType($typeId, $type)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      UPDATE type_pdt SET id=:typeId, type = :type WHERE id = :typeId;
    ");
    return $request->execute([
      ':typeId' => $typeId,
      ':type' => $type
    ]);
  }

  public static function deleteType($typeId)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      DELETE FROM type_pdt where id= :typeId;
    ");
    return $request->execute([
      ':typeId' => $typeId
    ]);
  }

//Product features
  public static function getProductList()
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      SELECT pdt.id AS productId, nom AS product, CONCAT(`#type`,' - ',type_pdt.type) AS type, photo, description 
      FROM pdt
      INNER JOIN type_pdt ON `#type` = type_pdt.id;
    ");
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getProductById($productId)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      SELECT pdt.id AS productId, nom AS product, `#type` AS typeId, type_pdt.type AS type, photo, description
      FROM pdt 
      INNER JOIN type_pdt ON `#type` = type_pdt.id
      WHERE pdt.id = :productId;
    ");
    $request->execute([
      ':productId' => $productId
    ]);
    return $request->fetchAll(PDO::FETCH_ASSOC);
  }
  
  public static function addProduct($product, $type, $photo, $description)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      INSERT INTO pdt VALUES ( null, :product, :type, :photo, :description );
    ");
    return $request->execute([
      ':product' => $product,
      ':type' => $type,
      ':photo' => $photo,
      ':description' => $description
    ]);
  }

  public static function updateProduct($productId, $product, $typeId, $photo, $description)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      UPDATE pdt SET pdt.id = :productId, nom = :product, `#type` = :typeId, photo = :photo, description = :description WHERE id = :productId;
    ");
    return $request->execute([
      ':productId' => $productId,
      ':product' => $product,
      ':typeId' => $typeId,
      ':photo' => $photo,
      ':description' => $description
    ]);
  }

  public static function deleteProduct($productId)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      DELETE FROM pdt where id= :productId;
    ");
    return $request->execute([
      ':productId' => $productId
    ]);
  }

//Stocks features
  public static function getStocksList()
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      SELECT pdt.id AS productId, CONCAT(`#id_depot`,' - ',depot.nom) AS warehouse, `#id_depot` AS warehouseId, pdt.nom AS product, quantite, CONCAT(`#type`,' - ',type_pdt.type) AS type, photo, description 
      FROM pdt
      INNER JOIN pdt_depot ON pdt.id = `#id_pdt`
      INNER JOIN type_pdt ON `#type` = type_pdt.id
      INNER JOIN depot ON `#id_depot` = depot.id;
    ");
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getStockById($productId, $warehouseId)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      SELECT pdt.id AS productId, nom AS product, `#type` AS typeId, type_pdt.type AS type, photo, description, `#id_depot` AS warehouseId, quantite AS quantity
      FROM pdt 
      INNER JOIN type_pdt ON `#type` = type_pdt.id
      INNER JOIN pdt_depot ON `#id_pdt` = pdt.id
      WHERE pdt.id = :productId && `#id_depot` = :warehouseId;
    ");
    $request->execute([
      ':productId' => $productId,
      ':warehouseId' => $warehouseId
    ]);
    return $request->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function addStock($product, $type, $photo, $description, $warehouseId, $quantity)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
    START TRANSACTION;
    INSERT INTO pdt VALUES (null, :product, :type, :photo, :description);
    INSERT INTO pdt_depot VALUES (LAST_INSERT_ID(), :warehouseId, :quantity);
    COMMIT;
    ");
    return $request->execute([
      ':product' => $product,
      ':type' => $type,
      ':photo' => $photo,
      ':description' => $description,
      ':warehouseId' => $warehouseId,
      ':quantity' => $quantity
    ]);
  }

  public static function addExistingProductIntoStock($productId, $warehouseId, $quantity)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      INSERT INTO pdt_depot VALUES ( :productId, :warehouseId, :quantity )
    ");
    return $request->execute([
      ':productId' => $productId,
      ':warehouseId'=> $warehouseId,
      ':quantity'=> $quantity
    ]);
  }

  public static function updateStock($productId, $product, $typeId, $photo, $description, $warehouseId, $quantity)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
    UPDATE pdt 
    INNER JOIN pdt_depot ON pdt.id = `#id_pdt` AND `#id_depot`= :warehouseId
    SET pdt.id  = :productId, nom = :product, `#type` = :typeId, photo = :photo, description = :description, `#id_depot` = :warehouseId, quantite = :quantity
    WHERE pdt.id  = :productId AND `#id_pdt` = :productId AND `#id_depot`= :warehouseId;
    ");
    return $request->execute([
      ':productId' => $productId,
      ':product' => $product,
      ':typeId' => $typeId,
      ':photo' => $photo,
      ':description' => $description,
      ':warehouseId' => $warehouseId,
      ':quantity' => $quantity
    ]);
  }

  public static function deleteStock($productId, $warehouseId)
  {
    $PDO = connexion();
    $request = $PDO->prepare("
      DELETE FROM pdt_depot
      WHERE `#id_pdt` = :productId AND `#id_depot`= :warehouseId;
    ");
    return $request->execute([
      ':productId' => $productId,
      ':warehouseId' => $warehouseId
    ]);
  }


//Getters
  public function getTypeId()
  {
    return $this->typeId;
  }
  public function getType()
  {
    return $this->type;
  }
  public function getProductId()
  {
    return $this->productId;
  }
  public function getProduct()
  {
    return $this->product;
  }
  public function getPhoto()
  {
    return $this->photo;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function getWarehouseId()
  {
    return $this->warehouseId;
  }
  public function getQuantity()
  {
    return $this->quantity;
  }
  //Setters
  public function setTypeId($typeId)
  {
    $this->typeId = $typeId;
    return $this;
  }
  public function setType($type)
  {
    $this->type = $type;
    return $this;
  }
  public function setProductId($productId)
  {
    $this->productId = $productId;
    return $this;
  }
  public function setProduct($product)
  {
    $this->product = $product;
    return $this;
  }
  public function setPhoto($photo)
  {
    $this->photo = $photo;
    return $this;
  }
  public function setDescription($description)
  {
    $this->description = $description;
    return $this;
  }
  public function setWarehouseId($warehouseId)
  {
    $this->warehouseId = $warehouseId;
    return $this;
  }
  public function setQuantity($quantity)
  {
    $this->quantity = $quantity;
    return $this;
  }
}