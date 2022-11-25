<?php 
session_start();
require_once "../../view/ViewWarehouse.php"; 
require_once "../../view/ViewTemplates.php"; 
ViewTemplates::head();?>

    <title>Gestion du dépôt</title>
    </head>
    <body>
        <?php
        
        
  if (isset($_SESSION['id']) && ($_SESSION['role'] === 'directeur' || $_SESSION['role'] === 'magasinier')) {
    ViewTemplates::nav();
    if (ModelWarehouse::getStocks($_GET['id'])) {
      ViewWarehouse::seeWarehouse($_GET['id']);
    } else {
      ViewTemplates::alert("danger", "Ce dépôt n'existe pas", "warehouseList.php");
    }
  } else {
    ViewTemplates::navConnexion();
    ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.", "connexion.php");
  }


  ViewTemplates::footer();