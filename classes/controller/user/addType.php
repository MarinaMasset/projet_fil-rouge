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

    if(isset($_POST['addType'])){
      if(ModelStocks::addType( $_POST['type'] )) {
        ViewTemplates::alert("success", "Ajout de type effectué avec succès", "stocksList.php");
      }
      else {
        ViewTemplates::alert("danger", "Échec de l'insertion", "addType.php");
      }
    }
    else {
      ViewStocks::addType();
    }

  }
  else {
    ViewTemplates::navConnexion();
    ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.");
}

ViewTemplates::footer();