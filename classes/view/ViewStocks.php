<?php 
require_once "../../model/ModelStocks.php";
require_once "../../model/ModelWarehouse.php";

class ViewStocks 
{
//Features for product types  (list, add, update product types)
    public static function productTypeList() {
    $list = ModelStocks::getTypeList();
?>  
    <div class="d-flex justify-content-end">            
      <a href="productList.php" class="btn btn-light me-5 border-light">Liste des produits dans la base</a>
    </div>
    <h2 class="text-center me-2 mb-2">Les types de produits</h2>
    <div class="container">
      <?php if ($list) { ?>
        <div class="d-flex justify-content-center" >
          <table class="table text-center" style="width:500px;">
            <thead>
              <tr>
                <th scope="col" class="pb-3">#</th>
                <th scope="col" class="pb-3">Type de produit</th>
                <?php if ($_SESSION['role'] === 'directeur') { ?>
                  <th scope="col"> <a href="addType.php" class="btn btn-success btn-gradient me-1">Ajouter un type</a> </th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list  as $column => $value) { ?> 
                <tr>
                  <th scope="row"><?= $value['typeId'] ?></th>
                  <td><?= $value['type'] ?></td>
                  <td>
                    <?php if ($_SESSION['role'] === 'directeur') { ?>
                      <a href="updateType.php?id=<?= $value['typeId'] ?>" class="btn btn-secondary me-1">Modifier</a>
                      <a href="deleteType.php?id=<?= $value['typeId'] ?>" type="button" class="btn btn-danger" data-id="<?= $value['typeId']?>">Supprimer</a>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      <?php } else {
        ViewTemplates::alert("danger", "Aucun type de produit n'a été trouvé dans la base");
      } ?> 
    </div>
  <?php }

  public static function addType() { ?>
    <form class="d-flex justify-content-center py-4 m-2" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
      <div class="card mb-3" style="max-width: 18rem; border:#580979 1px solid;">
        <div class="card-header text-center" style="border-bottom:#580979 1px solid;">Ajout de produit</div>
        <div class="card-body">
          <h5 class="card-title text-center py-2">Veuillez renseigner la catégorie de produit à ajouter :</h5>
          <div class="col-auto">
            <label for="type" class="form-label">Type :</label>
            <input type="text" class="form-control" id="type" name="type" aria-describedby="typeHelp" data-type="type" data-message="Veuillez fournir le type de produit à ajouter à la base de données." placeholder="Ex: semi-fini">
            <small id="typeHelp" class="form-text text-muted"></small>
          </div>
          <br/>
          <div class="col-auto d-flex justify-content-around mx-2">
            <button type="submit" name="addType" class="btn btn-success my-3">Ajouter</button>
            <button type="reset" class="btn btn-danger my-3">Réinitialiser</button>
          </div>
        </div>
      </div>
    </form> 
  <?php }

  public static function updateType($typeId) {
    $type = ModelStocks::getProductType($typeId);
    $type = $type[0];
  ?>
    <form class="d-flex justify-content-center py-4 m-2" method="post" action="updateType.php" enctype="multipart/form-data">
      <div class="card mb-3" style="max-width: 18rem; border:#580979 1px solid;">
        <div class="card-header text-center" style="border-bottom:#580979 1px solid;">Modification de produit</div>
        <div class="card-body">
          <h5 class="card-title text-center py-2">Veuillez renseigner les informations à modifier pour le type de produit :</h5>
          <input type="hidden" class="form-control" name="id" id="id" value="<?= $type['typeId'] ?>">
          <div class="col-auto">
            <label for="type" class="form-label">Type :</label>
            <input type="text" class="form-control" id="type" name="type" value="<?= $type['type'] ?>" aria-describedby="typeHelp" data-type="type" data-message="Veuillez fournir le type de produit à ajouter à la base de données." placeholder="Ex: semi-fini">
            <small id="typeHelp" class="form-text text-muted"></small>
          </div>
          <br/>
          <div class="text-center">
            <button type="submit" class="btn btn-secondary me-2" name="updateType" id="updateType">Modifier</button>
            <button type="reset" class="btn btn-danger my-3">Réinitialiser</button>
          </div>
        </div>
      </div>
    </form> 
  <?php }

//Features for products (list, add, update products in the database cf table called "pdt")
  public static function productList() {
    $list = ModelStocks::getProductList();
  ?>
    <div class="container">
      <?php if ($list) { ?>
        <br/>
        <h2 class="text-center">Produits existant dans la base de données</h2>
        <br/>
        <?php if ($_SESSION['role'] === 'directeur') { ?>
          <div class="text-center">
            <a href="addProduct.php" class="btn btn-success btn-gradient mt-0 me-1">Ajouter un produit dans la base de données</a> 
          </div> 
          <br/>
        <?php } ?>
        <div class="d-flex justify-content-center" >
          <table class="table text-center">
            <thead>
              <tr>
                <th scope="col" class="pb-3">#</th>
                <th scope="col" class="pb-3">produit</th>
                <th scope="col" class="pb-3">type</th>
                <th scope="col" class="pb-3">photo</th>
                <th scope="col" class="pb-3">description</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list  as $column => $value) { ?> 
                <tr>
                  <th scope="row"><?= $value['productId'] ?></th>
                  <td class="maxWidth"><?= $value['product'] ?></td>
                  <td><?= $value['type'] ?></td>
                  <td><img src="../../../images/<?= $value['photo'] ?>"  width= "150px" alt="photo du produit"></td>
                  <td class="maxWidth"><?= $value['description'] ?></td>
                  <?php if ($_SESSION['role']=== 'directeur') { ?>
                    <td>
                      <a href="updateProduct.php?id=<?= $value['productId'] ?>" class="btn btn-secondary text-white me-1">Modifier</a>
                      <a href="deleteProduct.php?id=<?= $value['productId'] ?>" type="button" class="btn btn-danger" data-id="<?= $value['productId']?>">Supprimer</a> 
                    </td>
                  <?php } ?>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      <?php } else {
        ViewTemplates::alert("danger", "Aucun produit n'a été trouvé dans aucun dépôt");
      } ?> 
    </div>
  <?php }

  public static function addProduct() {
    $typeList = ModelStocks::getTypeList();
  ?>
    <form class="d-flex justify-content-center py-4 m-2" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
      <div class="card mb-3" style="max-width: 30rem; border:#580979 1px solid;">
        <div class="card-header text-center" style="border-bottom:#580979 1px solid;">Ajout de produit dans la base de données</div>
        <div class="card-body">
          <h5 class="card-title text-center py-2">Veuillez renseigner les informations du produit :</h5>
          <div class="col-auto my-2">
            <label for="product" class="form-label">Produit :</label>
            <input type="text" class="form-control" id="product" name="product" aria-describedby="productHelp" data-type="produit" data-message="Veuillez fournir le nom du produit à ajouter à la base de données." placeholder="Ex: cacahuètes">
            <small id="productHelp" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label for="type">Type :</label>
            <select class="form-select"  name="type" id="type" aria-describedby="typeHelp" data-message="Veuillez sélectionner l'un des types proposés dans la liste déroulante.">
              <option selected value="">Cliquez pour choisir une option</option>
              <?php foreach ($typeList as $column => $value) { ?>
                <option value="<?=$value['typeId']?>"><?=$value['typeId']?> <?=$value['type']?></option>
              <?php } ?>
            </select>
            <small id="typeHelp" class="form-text text-muted"></small>
          </div>
          <div class="col-auto my-2">
            <label for="description" class="form-label">Description :</label>
            <textarea class="form-control" id="description" name="description" aria-describedby="descriptionHelp" data-type="description" data-message="Veuillez fournir la description du produit." placeholder="Ex: Cacahuètes avec cosse, paquet de 500g."></textarea>
            <small id="descriptionHelp" class="form-text text-muted"></small>
          </div>
          <div class="custom-file">
            <label for="photo">Photo du produit :</label>
            <br>
            <input type="file" name="photo" id="photo" aria-describedby="photoHelp" data-type="photo" data-message="Veuillez ajouter une photo en format jpeg, jpg ou png.">
            <br>
            <br>
          </div>
          <div class="col-auto d-flex justify-content-center">
            <button type="submit" name="addProduct" class="btn btn-success m-2">Ajouter</button>
            <button type="reset" class="btn btn-danger m-2">Réinitialiser</button>
          </div>
        </div>
      </div>
    </form> 
  <?php }

  public static function updateProduct($productId) {
    $product = ModelStocks::getProductById($productId);
    $product = $product[0];
    $typeList = ModelStocks::getTypeList();
  ?>  
    <form class="d-flex justify-content-center" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">  <!-- d-flex justify-content-center -->
      <div class="card mb-3" style="max-width: 30rem; border:#580979 1px solid;">
        <div class="card-header text-center" style="border-bottom:#580979 1px solid;">Modification de produit</div>
        <div class="card-body">
          <h5 class="card-title text-center py-2">Veuillez renseigner les informations à modifier pour le type de produit :</h5>
          <input type="hidden" class="form-control" name="id" id="id" value="<?= $product['productId'] ?>">
          <div class="col-auto">
            <label for="product" class="form-label">Produit :</label>
            <input type="text" class="form-control" id="product" name="product" value="<?= $product['product'] ?>" aria-describedby="productHelp" data-type="product" data-message="Veuillez fournir le nom du produit à ajouter à la base de données.">
            <small id="typeHelp" class="form-text text-muted"></small>
          </div>
          <div class="form-group my-2"> 
            <label for="typeId" class="form-label">Type : </label>
            <select class="form-select" name="typeId" id="typeId" aria-describedby="typeIdHelp" data-message="Veuillez sélectionner l'une des options proposées dans la liste déroulante.">
              <option selected value="<?= $product['typeId'] ?>">Type actuel : <?= $product['typeId'] ?> - <?= $product['type'] ?></option>
              <?php foreach ($typeList as $column => $value) { ?>
                <option value="<?=$value['typeId']?>"><?=$value['typeId']?> - <?=$value['type']?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="description" class="form-label">Description :</label>
            <textarea class="form-control" id="description" name="description" aria-describedby="descriptionHelp" data-type="description" data-message="Veuillez fournir la description du produit." value="<?= $product['description'] ?>"><?= $product['description'] ?></textarea>
            <small id="descriptionHelp" class="form-text text-muted"></small>
          </div>
          <div class="custom-file my-2">
            <label for="photo">Photo du produit :</label>
            <br>
            <input type="file" name="photo" id="photo" aria-describedby="photoHelp" data-type="photo" data-message="Veuillez ajouter une photo en format jpeg, jpg ou png."  value="<?= $product['photo'] ?>">
            <br>
            <input hidden type="text" name="previousPhoto" id="previousPhoto" value="<?= $product['photo'] ?>">
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-secondary me-2" name="updateProduct" id="updateProduct">Modifier</button>
            <button type="reset" class="btn btn-danger my-3">Réinitialiser</button>
          </div>
        </div>
      </div>
    </form> 
  <?php }

//Features for stocks (list, add, update stocks. Cf "pdt" inner join "pdt_depot" to get the quantities)
  public static function stocksList() {
    $list = ModelStocks::getStocksList();
  ?>
    <div class="container">
      <?php if ($list) { ?>
        <br>
        <h2 class="text-center">Liste des stocks</h2>
        <br>
        <?php if ($_SESSION['role'] === 'directeur') { ?>
          <div class="text-center">
            <a href="addStock.php" class="btn btn-success mt-0 me-1">Créer un nouveau produit</a> 
            <a href="addExistingStock.php" class="btn btn-success btn-gradient mt-0 me-1">Ajouter un produit existant dans un dépôt</a> 
          </div> 
          <br/>
          <?php } ?>
          
        <div class="d-flex justify-content-center" >
          <table class="table text-center">
            <thead>
              <tr>
                <th scope="col" class="pb-3">#</th>
                <th scope="col" class="pb-3">produit</th>
                <th scope="col" class="pb-3">dépôt</th>
                <th scope="col" class="pb-3">quantité</th>
                <th scope="col" class="pb-3">type</th>
                <th scope="col" class="pb-3">photo</th>
                <th scope="col" class="pb-3">description</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list  as $column => $value) { ?> 
                <tr>
                  <th scope="row"><?= $value['productId'] ?></th>
                  <td><?= $value['product'] ?></td>
                  <td><?= $value['warehouse'] ?></td>
                  <td><?= $value['quantite'] ?></td>
                  <td><?= $value['type'] ?></td>
                  <td><img src="../../../images/<?= $value['photo'] ?>"  width= "150px" alt="photo du produit"></td>
                  <td><?= $value['description'] ?></td>
                  <?php if ($_SESSION['role'] === 'directeur') { ?>
                    <td>
                      <a href="updateStock.php?id=<?= $value['productId']?>&warehouseId=<?=$value['warehouseId']?>" class="btn btn-secondary text-white me-1">Modifier</a>
                      <a href="deleteStock.php?id=<?= $value['productId']?>&warehouseId=<?=$value['warehouseId']?>" type="button" class="btn btn-danger" data-id="<?= $value['productId']?>">Supprimer</a> 
                    </td>
                  <?php } ?>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      <?php } else {
        ViewTemplates::alert("danger", "Aucun produit n'a été trouvé dans aucun dépôt");
      } ?> 
    </div>
  <?php }

public static function addStock() {
  $typeList = ModelStocks::getTypeList();
  $warehouseList = ModelWarehouse::warehouseList();
?>
  <form class="d-flex justify-content-center py-4 m-2" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
    <div class="card mb-3" style="max-width: 30rem; border:#580979 1px solid;">
      <div class="card-header text-center" style="border-bottom:#580979 1px solid;">Ajout de produit dans un dépôt</div>
      <div class="card-body">
        <h5 class="card-title text-center py-2">Veuillez renseigner les informations du produit :</h5>
        <div class="col-auto my-2">
          <label for="product" class="form-label">Produit :</label>
          <input type="text" class="form-control" id="product" name="product" aria-describedby="productHelp" data-type="product" data-message="Veuillez fournir le nom du produit à ajouter à la base de données." placeholder="Ex: cacahuètes">
          <small id="productHelp" class="form-text text-muted"></small>
        </div>
        <div class="form-group">
          <label for="type">Type :</label>
          <select class="form-select"  name="type" id="type" aria-describedby="typeHelp" data-message="Veuillez sélectionner l'un des types proposés dans la liste déroulante.">
            <option selected value="">Cliquez pour choisir une option</option>
            <?php foreach ($typeList as $column => $value) { ?>
              <option value="<?=$value['typeId']?>"><?=$value['typeId']?> <?=$value['type']?></option>
            <?php } ?>
          </select>
          <small id="typeHelp" class="form-text text-muted"></small>
        </div>
        <div class="col-auto my-2">
          <label for="description" class="form-label">Description :</label>
          <textarea class="form-control" id="description" name="description" aria-describedby="descriptionHelp" data-type="description" data-message="Veuillez fournir la description du produit." placeholder="Ex: Cacahuètes avec cosse, paquet de 500g."></textarea>
          <small id="descriptionHelp" class="form-text text-muted"></small>
        </div>
        <div class="col-auto my-2">
          <label for="warehouseId" class="form-label">Dépôt :</label>
          <select class="form-select" name="warehouseId" id="warehouseId" aria-describedby="warehouseIdHelp" data-message="Veuillez sélectionner l'un des dépôts proposés dans la liste déroulante.">
            <option selected value="">Cliquez pour choisir une option</option>
            <?php foreach ($warehouseList as $column => $value) { ?>
              <option value="<?=$value['warehouseId']?>"><?=$value['warehouseId']?> <?=$value['nom']?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-auto my-2">
          <label for="quantity" class="form-label">Quantité :</label>
          <input type="number" class="form-control" id="quantity" name="quantity" aria-describedby="quantityHelp" data-type="quantity" data-message="Veuillez fournir la quantité à ajouter dans le dépôt.">
          <small id="descriptionHelp" class="form-text text-muted"></small>
        </div>
        <div class="custom-file">
          <label for="photo">Photo du produit :</label>
          <br>
          <input type="file" name="photo" id="photo" aria-describedby="photoHelp" data-type="photo" data-message="Veuillez ajouter une photo en format jpeg, jpg ou png.">
          <br>
          <br>
        </div>
        <div class="col-auto d-flex justify-content-center">
          <button type="submit" name="addStock" class="btn btn-success m-2">Ajouter</button>
          <button type="reset" class="btn btn-danger m-2">Réinitialiser</button>
        </div>
      </div>
    </div>
  </form> 
<?php }

public static function addExistingProductIntoStock() {
  $warehouseList = ModelWarehouse::warehouseList();
  $productList = ModelStocks::getProductList();
?>
  <form class="d-flex justify-content-center py-4 m-2" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
    <div class="card mb-3" style="max-width: 30rem; border:#580979 1px solid;">
      <div class="card-header text-center" style="border-bottom:#580979 1px solid;">Ajout de produit dans un dépôt</div>
      <div class="card-body">
        <h5 class="card-title text-center py-2">Veuillez renseigner les informations du produit :</h5>
        <div class="col-auto my-2">
          <label for="product" class="form-label">Produit :</label>
          <select class="form-select" name="productId" id="productId" aria-describedby="productHelp" data-message="Veuillez sélectionner l'un des produits proposés dans la liste déroulante.">
            <option selected value="">Cliquez pour choisir une option</option>
            <?php foreach ($productList as $column => $value) { ?>
              <option value="<?=$value['productId']?>"><?=$value['productId']?> <?=$value['product']?></option>
            <?php } ?>
          </select>
          <small id="productHelp" class="form-text text-muted"></small>
        </div>
        <div class="col-auto my-2">
          <label for="warehouseId" class="form-label">Dépôt :</label>
          <select class="form-select" name="warehouseId" id="warehouseId" aria-describedby="warehouseIdHelp" data-message="Veuillez sélectionner l'un des dépôts proposés dans la liste déroulante.">
            <option selected value="">Cliquez pour choisir une option</option>
            <?php foreach ($warehouseList as $column => $value) { ?>
              <option value="<?=$value['warehouseId']?>"><?=$value['warehouseId']?> <?=$value['nom']?></option>
            <?php } ?>
          </select>
          <small id="warehouseIdHelp" class="form-text text-muted"></small>
        </div>
        <div class="col-auto my-2">
          <label for="quantity" class="form-label">Quantité :</label>
          <input type="number" class="form-control" id="quantity" name="quantity" aria-describedby="quantityHelp" data-type="quantity" data-message="Veuillez fournir la quantité à ajouter dans le dépôt.">
          <small id="descriptionHelp" class="form-text text-muted"></small>
        </div>
        <div class="col-auto d-flex justify-content-center">
          <button type="submit" name="addExistingStock" class="btn btn-success m-2">Ajouter</button>
          <button type="reset" class="btn btn-danger m-2">Réinitialiser</button>
        </div>
      </div>
    </div>
  </form> 
<?php }

public static function updateStock($productId, $warehouseId) {
  $product = ModelStocks::getStockById($productId, $warehouseId);
  $product = $product[0];
  $typeList = ModelStocks::getTypeList();
?>  
  <form class="d-flex justify-content-center" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">  <!-- d-flex justify-content-center -->
    <div class="card mb-3" style="max-width: 30rem; border:#580979 1px solid;">
      <div class="card-header text-center" style="border-bottom:#580979 1px solid;">Modification de produit dans le dépôt n°<?= $product['warehouseId'] ?></div>
      <div class="card-body">
        <h5 class="card-title text-center py-2">Veuillez renseigner les informations à modifier pour le type de produit :</h5>
        <input type="hidden" class="form-control" name="id" id="id" value="<?= $product['productId'] ?>">
        <input type="hidden" class="form-control" name="warehouseId" id="warehouseId" value="<?= $product['warehouseId'] ?>">
        <div class="col-auto">
          <label for="product" class="form-label">Produit :</label>
          <input type="text" class="form-control" id="product" name="product" value="<?= $product['product'] ?>" aria-describedby="productHelp" data-type="product" data-message="Veuillez fournir le nom du produit à ajouter à la base de données.">
          <small id="productHelp" class="form-text text-muted"></small>
        </div>
        <div class="form-group my-2"> 
          <label for="typeId" class="form-label">Type : </label>
          <select class="form-select" name="typeId" id="typeId" aria-describedby="typeIdHelp" data-message="Veuillez sélectionner l'une des options proposées dans la liste déroulante.">
            <option selected value="<?= $product['typeId'] ?>">Type actuel : <?= $product['typeId'] ?> - <?= $product['type'] ?></option>
            <?php foreach ($typeList as $column => $value) { ?>
              <option value="<?=$value['typeId']?>"><?=$value['typeId']?> - <?=$value['type']?></option>
            <?php } ?>
          </select>
          <small id="typeIdHelp" class="form-text text-muted"></small>
        </div>
        <div class="form-group">
          <label for="description" class="form-label">Description :</label>
          <textarea class="form-control" id="description" name="description" aria-describedby="descriptionHelp" data-type="description" data-message="Veuillez fournir la description du produit." value="<?= $product['description'] ?>"><?= $product['description'] ?></textarea>
          <small id="descriptionHelp" class="form-text text-muted"></small>
        </div>
        <div class="col-auto my-2">
          <label for="quantity" class="form-label">Quantité :</label>
          <input type="number" class="form-control" id="quantity" name="quantity" value="<?= $product['quantity'] ?>" aria-describedby="quantityHelp" data-type="quantity" data-message="Veuillez fournir la quantité à ajouter dans le dépôt.">
          <small id="descriptionHelp" class="form-text text-muted"></small>
        </div>
        <div class="custom-file my-2">
          <label for="photo">Photo du produit :</label>
          <br>
          <input type="file" name="photo" id="photo" aria-describedby="photoHelp" data-type="photo" data-message="Veuillez ajouter une photo en format jpeg, jpg ou png."  value="<?= $product['photo'] ?>">
          <br>
          <input hidden type="text" name="previousPhoto" id="previousPhoto" value="<?= $product['photo'] ?>">
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-secondary me-2" name="updateProduct" id="updateProduct">Modifier</button>
          <button type="reset" class="btn btn-danger my-3">Réinitialiser</button>
        </div>
      </div>
    </div>
  </form> 
<?php }
}