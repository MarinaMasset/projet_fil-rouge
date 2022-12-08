<?php 
session_start();
  require_once "../../view/ViewTemplates.php";
  ViewTemplates::head();
  ?>
  <title>Modification de compte</title>
</head>

<?php
require_once "../../view/ViewUser.php";
require_once "../../model/ModelUser.php";

if (isset($_SESSION['id']) && ($_SESSION['role'] === 'super')) {
  ViewTemplates::navAdmin();

  if (isset($_GET['id'])) {
      if (ModelUser::getAccount($_GET['id'])) {
        ViewUser::updateUser($_GET['id']);
      } else {
        ViewTemplates::alert("danger", "Cet utilisateur n'existe pas.", "adminList.php");

      }
  } else {
    if (isset($_POST['id']) && ModelUser::getAccount($_POST['id'])) {
      if (ModelUser::updateUser($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['tel'], $_POST['role'])) {
        ViewTemplates::alert("success", "Mise à jour effectuée !", "adminList.php");
      } else {
        ViewTemplates::alert("danger", "Échec de la mise à jour.", "adminList.php");
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