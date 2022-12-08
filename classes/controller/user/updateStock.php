<?php 
session_start();
  require_once "../../view/ViewTemplates.php";
  require_once "../../view/ViewStocks.php";
  require_once "../../model/ModelStocks.php";
  ViewTemplates::head();

  ?>
  <title>Modification de stock</title>
</head>

<?php
if (isset($_SESSION['id']) && ($_SESSION['role'] === 'directeur')) {
  ViewTemplates::nav();

  if (isset($_GET['id'])) {
      if (ModelStocks::getStocksList($_GET['id'])) {
        ViewStocks::updateStock($_GET['id'], $_GET['warehouseId']);
      } else {
        ViewTemplates::alert("danger", "Ce produit n'existe pas dans la base.", "stocksList.php");

      }
  } else {
    if (isset($_POST['id']) && ModelStocks::getStocksList($_POST['id'])) {

      if ($_FILES["photo"]["name"] !== "") {
//upload validation
        $target_dir = "../../../images/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if($check !== false) {
          $uploadOk = 1;
        } else {
          ViewTemplates::alert("danger", "Oups, ce fichier n'est pas une image.", "updateStock.php");
          $uploadOk = 0;
        }
        
        if (file_exists($target_file)) {
          ViewTemplates::alert("danger", "Cette photo existe déjà avec ce nom de fichier. Veuillez changer le nom de la photo", "updateStock.php");
          $uploadOk = 0;
        }
        
        $pattern = "/^[\p{L}\w\s\-\.]{3,}$/";
        if (!preg_match($pattern, $_FILES["photo"]["name"])) {
          ViewTemplates::alert("danger", "Le nom de la photo n'est pas valide.", "updateStock.php");
        }

        if ($_FILES["photo"]["size"] > 3000000) {
          ViewTemplates::alert("danger", "La photo est trop volumineuse pour être ajouté. La taille maximale autorisée est de 3Mo", "updateStock.php");
          $uploadOk = 0;
        }
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
          ViewTemplates::alert("danger", "Seules les extensions JPG, JPEG, et PNG sont autorisées pour les ajouts de photos dans la base.", "updateStock.php");
          $uploadOk = 0;
        }
//End of upload validation
//if pb => error message
        if ($uploadOk == 0) {
          ViewTemplates::alert("danger", "Oups, la photo n'a pas pu être téléversée, le produit ne peut donc pas être modifié.", "updateStock.php");
        } 
//else it means there is no pb, so if the image is moved to images folder => if post data then update the product
        elseif (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
          if (ModelStocks::updateStock($_POST['id'], $_POST['product'], $_POST['typeId'], $_FILES['photo']['name'], $_POST['description'], $_POST['warehouseId'], $_POST['quantity'])) {
            ViewTemplates::alert("success", "Mise à jour du produit effectuée !", "stocksList.php");
          }
          else { 
            ViewTemplates::alert("danger", "Échec de la requête : les données du produit n'ont pas pu être mises à jour.", "updateStock.php");
            var_dump($_POST['id'], $_POST['product'], $_POST['typeId'], $_FILES['photo']['name'], $_POST['description']);
          }
        }
        else {
          ViewTemplates::alert("danger", "La photo n'a pas pu être téléversée. Veuillez vérifier que vous n'avez aucun fichier avec le même nom dans ce dossier, que la taille est en dessous de 3Mo et que l'extension est bien jpg, jpeg ou png.", "updateStock.php");
        }
      }
//if file name is empty there is no new upload so skip validation, check $_POST['photo'] and update product
      elseif (ModelStocks::updateStock($_POST['id'], $_POST['product'], $_POST['typeId'], $_POST['previousPhoto'], $_POST['description'], $_POST['warehouseId'], $_POST['quantity'])) {
        ViewTemplates::alert("success", "Mise à jour du produit effectuée !", "stocksList.php");
      }
      else {
        ViewTemplates::alert("danger", "Échec de la mise à jour du produit.", "updateStock.php");
      }
    } else {
      ViewTemplates::alert("danger", "Aucune donnée n'a été transmise");
    }
  }
}

else {
  ViewTemplates::navConnexion();
  ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.");
}

      ViewTemplates::footer();
      ?>