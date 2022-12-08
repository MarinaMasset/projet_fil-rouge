<?php 
session_start();
require_once "../../view/ViewTemplates.php"; 
require_once "../../view/ViewWarehouse.php";
require_once "../../model/ModelWarehouse.php";
ViewTemplates::head();?>

<title>Ajout de dépôt</title>
</head>

<body>
  <?php

  if (isset($_SESSION['id']) && ($_SESSION['role'] === 'directeur')) {

    ViewTemplates::nav();

    if(isset($_POST['addWarehouse'])){
      if(ModelWarehouse::addWarehouse( $_POST['nom'], $_POST['ville'], $_POST['codePost'], $_POST['longitude'], $_POST['latitude'], $_POST['idDirecteur'] )) {
        ViewTemplates::alert("success", "Ajout de dépôt effectué avec succès", "warehouseList.php");
      }
      else {
        ViewTemplates::alert("danger", "Échec de l'insertion", "addWarehouse.php");
      }
    }
    else {
      ViewWarehouse::addWarehouseForm();
    }

  }
  else {
    ViewTemplates::navConnexion();
    ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.");
}

ViewTemplates::footer();