<?php 
session_start();
  require_once "../../view/ViewTemplates.php";
  require_once "../../model/ModelWarehouse.php";
  ViewTemplates::head();
  ?>
  <title>Suppression de compte</title>
</head>

<body>
  <?php
  require_once "../../view/ViewUser.php";
  require_once "../../model/ModelUser.php";

if (isset($_SESSION['id']) && ($_SESSION['role'] === 'directeur')) {
  ViewTemplates::nav();
  
  if (isset($_GET['id'])) {
    if (ModelWarehouse::getWarehouse($_GET['id'])) {
      var_dump(ModelWarehouse::deleteWarehouse($_GET['id']));
      if (ModelWarehouse::deleteWarehouse($_GET['id'])) {
        ViewTemplates::alert("success", "Le dépôt a bien été supprimé.", "warehouseList.php");
        exit;
      } else {
        ViewTemplates::alert("danger", "Oups ! Le dépôt n'a pas pu être supprimé.", "warehouseList.php");

      }
    } else {
      ViewTemplates::alert("danger", "Oups ! Ce dépôt n'existe pas dans la base de données.");
    }
  } else {
    ViewTemplates::alert("danger", "Oups ! Impossible de récupérer les données depuis la base.");

  }
}
else {
  ViewTemplates::navConnexion();
  ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.", "connexion.php");
}

  ViewTemplates::footer();