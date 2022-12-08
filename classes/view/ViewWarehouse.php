<?php
require_once "../../model/ModelWarehouse.php";
require_once "../../model/ModelUser.php";

class ViewWarehouse
{

    //Can see and modify all accounts
    public static function warehouseList() {
        $list = ModelWarehouse::warehouseList();
?>
        <div class="container">
            <?php
            if ($list) {
            ?>
            <h2 class="text-center">Liste des dépôts</h2>
            <?php if ($_SESSION['role'] === 'directeur') { ?>
              <div class="d-flex justify-content-end">
                  <a class="btn btn-gradient text-white m-2" href="addWarehouse.php">Ajouter un nouveau dépôt</a>
              </div>
            <?php } ?>

                <table class="table text-center mt-5">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Ville</th>
                            <th scope="col">Code postal</th>
                            <th scope="col">Directeur</th>
                            <th scope="col">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($list  as $column => $value) {
                        ?> 
                            <tr>
                                <th scope="row"><?= $value['warehouseId'] ?></th>
                                <td><?= $value['nom'] ?></td>
                                <td><?= $value['ville'] ?></td>
                                <td><?= $value['codePost'] ?></td>
                                <td><?= $value['directeur'] ?></td>
                                <td><?= $value['idDirecteur'] ?></td>
                                <td>
                                    <a href="warehouse.php?id=<?= $value['warehouseId'] ?>" class="btn btn-success me-1">Accès au dépôt</a>
                                    <?php if ($_SESSION['role'] === 'directeur') { ?>
                                    <a href="updateWarehouse.php?id=<?= $value['warehouseId'] ?>" class="btn btn-secondary text-white me-1">Modifier</a>
                                    <a href="deleteWarehouse.php?id=<?= $value['warehouseId'] ?>" type="button" class="btn btn-danger" data-id="<?= $value['warehouseId']?>">Supprimer</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo "Aucun dépôt n'a été trouvé dans la liste.";
            }
            ?> 
        </div>
<?php
    }

    public static function searchResults()
    {
    $list = ModelWarehouse::search($_POST['search']);
    ?>
        <div class="container">
            <?php
            if ($list) {
            ?>
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Ville</th>
                            <th scope="col">Code postal</th>
                            <th scope="col">Directeur</th>
                            <th scope="col">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($list  as $column => $value) {
                        ?> 
                            <tr>
                                <th scope="row"><?= $value['warehouseId'] ?></th>
                                <td><?= $value['depot'] ?></td>
                                <td><?= $value['ville'] ?></td>
                                <td><?= $value['codePost'] ?></td>
                                <td><?= $value['directeur'] ?></td>
                                <td><?= $value['idDirecteur'] ?></td>
                                <td>
                                    <a href="warehouse.php?id=<?= $value['id'] ?>" class="btn btn-success me-1">Accès au dépôt</a>
                                    <?php if ($_SESSION['role'] === 'directeur') { ?>
                                    <a href="updateWarehouse.php?id=<?= $value['warehouseId'] ?>" class="btn btn-secondary text-white me-1">Modifier</a>
                                    <a href="deleteWarehouse.php?id=<?= $value['warehouseId'] ?>" type="button" class="btn btn-danger" data-id="<?= $value['id']?>">Supprimer</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo "Aucun dépôt n'a été trouvé dans la liste.";
            }
            ?> 
        </div>
<?php
    }

    //Function to access the warehouse
    public static function seeWarehouse($warehouseId)
    {
    $stocks =  ModelWarehouse::getStocks($warehouseId);
    $warehouse =  ModelWarehouse::getWarehouse($warehouseId);
            if ($stocks) {
            ?>
                <h1 class="text-center"> Dépôt n°<?= $warehouseId ?> : <?= $warehouse[0]['depot']; ?></h1>
                <h2 class="text-center h6"> 
                    directeur responsable : <?= $warehouse[0]['directeur'] ?> <br>
                    contacter : <a href="mailto:<?= $warehouse[0]['mail'] ?>"> <?= $warehouse[0]['mail'] ?> </a> 
                </h2>
                <br/>
                <table class="table text-center mx-2">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Produit</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Type</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Description</th>
                            

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($stocks  as $column => $value) {
                            if ($_GET['id'] === $value['warehouseId']) {
                        ?> 
                            <tr>
                                <th scope="row"> <?= $value['idProduit'] ?> </th>  
                                <td> <?= $value['produit'] ?> </td> 
                                <td> <?= $value['quantite'] ?> </td> 
                                <td> <?= $value['type'] ?> </td> 
                                <td> <img src="../../../images/<?= $value['photo'] ?>" width= "150px" alt="<?= $value['description'] ?>"> </td> 
                                <td> <?= $value['description'] ?> </td> 
                                <td>
                                    <?php if ($_SESSION['role'] === 'directeur') { ?>
                                    <a href="updateStock.php?id=<?= $value['idProduit'] ?>&warehouseId=<?=$value['warehouseId']?>" class="btn btn-secondary text-white me-1">Modifier</a>
                                    <a href="deleteStock.php?id=<?= $value['idProduit'] ?>&warehouseId=<?=$value['warehouseId']?>" type="button" class="btn btn-danger" data-id="<?= $warehouseId ?>">Supprimer</a>
                                    <?php } 
                            }
                            ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            } else {
                ViewTemplates::alert("danger", "Aucun produit n'a été trouvé dans ce dépôt", "warehouseList.php");
            }
            ?> 
        </div>

    <?php
    }

    public static function addWarehouseForm()
    {
        $user = ModelUser::userList();

        ?><h1 class="text-center">Ajout de dépôt</h1>
    <form class="col-md-6 offset-md-3" method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="p-2">
          <div class="form-group">
          <label for="nom">Nom : </label>
          <input type="text" class="form-control" name="nom" id="nom" aria-describedby="nameHelp" data-message="Veuillez ne taper que des lettres et des chiffres" placeholder="Ex : dépôtLille">
          <small id="nameHelp" class="form-text text-muted"></small>
        </div>
        <br>
        <div class="form-group">
          <label for="ville">Ville : </label>
          <input type="text" class="form-control" name="ville" id="ville" aria-describedby="villeHelp" data-message="Veuillez taper la première lettre en majuscule puis le reste en minuscules."  placeholder="Ex : Lille">
          <small id="villeHelp" class="form-text text-muted"></small>
        </div>
        <br>
        <div class="form-group">
          <label for="codePost">Code postal : </label>
          <input type="text" class="form-control" name="codePost" id="codePost" aria-describedby="codePostHelp" data-message="Veuillez ne taper que des chiffres"  placeholder="Ex : 59160">
          <small id="codePostHelp" class="form-text text-muted"></small>
        </div>
        <br>
        <div class="form-group">
          <label for="postCode">Longitude : </label>
          <input type="text" class="form-control" name="longitude" id="longitude" aria-describedby="longitudeHelp" data-message="Veuillez ne taper que des chiffres"  placeholder="Ex : 1.8678299">
          <small id="longitudeHelp" class="form-text text-muted"></small>
        </div>
        <br>
        <div class="form-group">
          <label for="postCode">Latitude : </label>
          <input type="text" class="form-control" name="latitude" id="latitude" aria-describedby="latitudeHelp" data-message="Veuillez ne taper que des chiffres"  placeholder="Ex : 50.9388418">
          <small id="latitudeHelp" class="form-text text-muted"></small>
        </div>
        <br>
        <div class="form-group">
          <label for="idDirecteur">Directeur :</label>
          <select class="form-select"  name="idDirecteur" id="idDirecteur" aria-describedby="idDirecteurHelp" data-message="Veuillez sélectionner l'une des options du menu déroulant.">
            <option selected value="">Cliquez pour choisir une option</option>
            <?php 
            foreach ($user as $column => $value) { 
                if ($value['role'] === 'directeur') {
                ?>
                <option value="<?=$value['id']?>"><?=$value['nom']?> <?=$value['prenom']?></option>
                <?php }
            } ?>
          </select>
          <small id="directeurHelp" class="form-text text-muted"></small>
        </div>
        <br>
        <div class="text-center">
          <button type="submit" class="btn btn-primary me-2" name="addWarehouse" id="addWarehouse">Ajouter le dépôt</button>
          <button type="reset" class="btn btn-danger">Réinitialiser</button>
        </div>
      </div>  
    </form>
<?php
  }

  public static function updateWarehouse($id)
  {
    $warehouse = ModelWarehouse::getWarehouse($id);
    $warehouse = $warehouse[0];

    ?>
    <form class="col-md-6 offset-md-3" method="post" action="updateWarehouse.php">
      <input type="hidden" class="form-control" name="id" id="id" value="<?= $warehouse['warehouseId'] ?>">
      <div class="form-group">
        <label for="depot">Nom du dépôt : </label>
        <input type="text" class="form-control" name="depot" id="depot" value="<?= $warehouse['depot'] ?>">
      </div>
      <br/>
      <div class="form-group">
        <label for="ville">Ville : </label>
        <input type="text" class="form-control" name="ville" id="ville" value="<?= $warehouse['ville'] ?>">
      </div>
      <br/>
      <div class="form-group">
        <label for="ville">Code Postal : </label>
        <input type="text" class="form-control" name="codePost" id="codePost" value="<?= $warehouse['codePost'] ?>">
      </div>
      <br/>
      <div class="form-group">
        <label for="longitude">Longitude : </label>
        <input type="text" class="form-control" name="longitude" id="longitude" value="<?= $warehouse['longitude'] ?>">
      </div>
      <br/>
      <div class="form-group">
        <label for="latitude">Latitude : </label>
        <input type="text" class="form-control" name="latitude" id="latitude" value="<?= $warehouse['latitude'] ?>">
      </div>
      <br/>
      <div class="form-group">
        <label for="idDirecteur">IdDirecteur : </label>
        <input type="number" class="form-control" name="idDirecteur" id="idDirecteur" value="<?= $warehouse['idDirecteur'] ?>">
      </div>
      <br/>
      <?php 
        ?>
        <br/>
        <div class="text-center">
          <button type="submit" class="btn btn-secondary me-2 text-white" name="update" id="update">Modifier</button>
          <button type="reset" class="btn btn-danger">Réinitialiser</button>
        </div>
      </form>
    <?php
  }
}