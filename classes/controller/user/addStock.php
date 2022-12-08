<?php
session_start();
require_once "../../view/ViewTemplates.php";
require_once "../../view/ViewStocks.php";
require_once "../../model/ModelStocks.php";
ViewTemplates::head(); ?>

<title>Ajout de stocks</title>
</head>

<body>
  <?php

  if (isset($_SESSION['id']) && ($_SESSION['role'] === 'directeur')) {
    ViewTemplates::nav();

    if (isset($_POST['addStock'])) {
      $target_dir = "../../../images/";
      $target_file = $target_dir . basename($_FILES["photo"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      $check = getimagesize($_FILES["photo"]["tmp_name"]);
      if ($check !== false) {
        $uploadOk = 1;
      } else {
        ViewTemplates::alert("danger", "Oups, ce fichier n'est pas une image.", "addProduct.php");
        $uploadOk = 0;
      }

      if (file_exists($target_file)) {
        ViewTemplates::alert("danger", "Cette photo existe déjà avec ce nom de fichier. Veuillez changer le nom de la photo", "addProduct.php");
        $uploadOk = 0;
      }

      $pattern = "/^[\p{L}\w\s\-\.]{3,}$/";
      if (!preg_match($pattern, $_FILES["photo"]["name"])) {
        ViewTemplates::alert("danger", "Le nom de la photo n'est pas valide.", "addProduct.php");
      }

      if ($_FILES["photo"]["size"] > 3000000) {
        ViewTemplates::alert("danger", "La photo est trop volumineuse pour être ajouté. La taille maximale autorisée est de 3Mo", "addProduct.php");
        $uploadOk = 0;
      }

      if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        ViewTemplates::alert("danger", "Seules les extensions JPG, JPEG, et PNG sont autorisées pour les ajouts de photos dans la base.", "addProduct.php");
        $uploadOk = 0;
      }

      if ($uploadOk == 0) {
        ViewTemplates::alert("danger", "Oups, la photo n'a pas pu être téléversée, le produit ne peut donc pas être ajouté.", "addProduct.php");
      } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
          if (ModelStocks::addStock($_POST['product'], $_POST['type'], $_FILES['photo']['name'], $_POST['description'], $_POST['warehouseId'], $_POST['quantity'])) {
            ViewTemplates::alert("success", "Ajout de produit effectué avec succès", "StocksList.php");
          } else {
            ViewTemplates::alert("danger", "Échec de l'insertion", "addProduct.php");
          }
        } else {
          ViewTemplates::alert("danger", "Oups, une erreur s'est produite lors du téléversement de la photo, le produit ne peut donc pas être ajouté.", "addProduct.php");
        }
      }
    } else {
      ViewStocks::addStock();
    }
  } else {
    ViewTemplates::navConnexion();
    ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.");
  }

  ViewTemplates::footer();
