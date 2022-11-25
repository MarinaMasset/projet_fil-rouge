<?php 
session_start();
  require_once "../../view/ViewTemplates.php";
  require_once "../../view/ViewWarehouse.php";
require_once "../../model/ModelWarehouse.php";
  ViewTemplates::head();
  ?>
  <title>Modification de dépôt</title>
</head>

<?php

if (isset($_SESSION['id']) && ($_SESSION['role'] === 'directeur')) {
  ViewTemplates::nav();

  if (isset($_GET['id'])) {
      if (ModelWarehouse::getWarehouse($_GET['id'])) {
        ViewWarehouse::updateWarehouse($_GET['id']);
      } else {
        ViewTemplates::alert("danger", "Ce dépôt n'existe pas.", "warehouseList.php");

      }
  } else {
    if (isset($_POST['id']) && ModelWarehouse::getWarehouse($_POST['id'])) {
      if (ModelWarehouse::updateWarehouse($_POST['id'], $_POST['depot'], $_POST['ville'], $_POST['codePost'], $_POST['longitude'], $_POST['latitude'], $_POST['idDirecteur'])) {
        ViewTemplates::alert("success", "Mise à jour effectuée !", "warehouseList.php");
      } else {
        ViewTemplates::alert("danger", "Échec de la mise à jour.", "warehouseList.php");
      }
    } else {
      ViewTemplates::alert("danger", "Aucune donnée n'a été transmise");
    }
  }
}

else {
  ViewTemplates::navConnexion();
  ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.", "adminConnexion.php");
}

      ViewTemplates::footer();
      ?>