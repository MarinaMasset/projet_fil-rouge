<?php 
session_start();
  require_once "../../view/ViewTemplates.php";
  require_once "../../view/ViewStocks.php";
  require_once "../../model/ModelStocks.php";
  ViewTemplates::head();
  ?>
  <title>Modification des types</title>
</head>

<?php
if (isset($_SESSION['id']) && ($_SESSION['role'] === 'directeur')) {
  ViewTemplates::nav();

  if (isset($_GET['id'])) {
      if (ModelStocks::getTypeList($_GET['id'])) {
        ViewStocks::updateType($_GET['id']);
      } else {
        ViewTemplates::alert("danger", "Ce type de produit n'existe pas.", "stocksList.php");

      }
  } else {
    if (isset($_POST['id']) && ModelStocks::getTypeList($_POST['id'])) {
      if (ModelStocks::updateType($_POST['id'], $_POST['type'])) {
        ViewTemplates::alert("success", "Mise à jour effectuée !", "stocksList.php");
      } else {
        ViewTemplates::alert("danger", "Échec de la mise à jour.", "stocksList.php");
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