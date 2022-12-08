<?php 
session_start();
  require_once "../../view/ViewTemplates.php";
  require_once "../../model/ModelStocks.php";
  require_once "../../view/ViewStocks.php";
  ViewTemplates::head();
  ?>
  <title>Suppression de produit</title>
</head>

<body>
  <?php

if (isset($_SESSION['id']) && ($_SESSION['role'] === 'directeur')) {
  ViewTemplates::nav();
  
  if (isset($_GET['id'])) {
    if (ModelStocks::getProductList($_GET['id'])) {
      if (ModelStocks::deleteProduct($_GET['id'])) {
        ViewTemplates::alert("success", "Le produit a bien été supprimé de la base de données.", "productList.php");
        exit;
      } else {
        ViewTemplates::alert("danger", "Oups ! Le produit n'a pas pu être supprimé de la base de données.", "productList.php");
      }
    } else {
      ViewTemplates::alert("danger", "Oups ! Ce produit n'existe pas dans la base de données.", "productList.php");
    }
  } else {
    ViewTemplates::alert("danger", "Oups ! Impossible de récupérer les données depuis la base.", "productList.php");

  }
}
else {
  ViewTemplates::navConnexion();
  ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.");
}

  ViewTemplates::footer();