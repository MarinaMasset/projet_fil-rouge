<?php 
session_start();
require_once "../../view/ViewTemplates.php"; 
require_once "../../view/ViewStocks.php";
require_once "../../model/ModelStocks.php";
ViewTemplates::head();?>

<title>Ajout de produit</title>
</head>

<body>
  <?php

  if (isset($_SESSION['id']) && ($_SESSION['role'] === 'directeur')) {

    ViewTemplates::nav();

    if(isset($_POST['addExistingStock'])){
      if(ModelStocks::addExistingProductIntoStock($_POST['productId'], $_POST['warehouseId'], $_POST['quantity'])) {
        ViewTemplates::alert("success", "Ajout de produit effectué avec succès dans le dépôt n°".$_POST['warehouseId'], "stocksList.php");
      }
      else {
        ViewTemplates::alert("danger", "Échec de l'insertion", "addType.php");
      }
    }
    else {
      ViewStocks::addExistingProductIntoStock();
    }

  }
  else {
    ViewTemplates::navConnexion();
    ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.");
}

ViewTemplates::footer();