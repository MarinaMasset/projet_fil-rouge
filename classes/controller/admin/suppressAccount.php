<?php 
session_start();
  require_once "../../view/ViewTemplates.php";
  ViewTemplates::head();
  ?>
  <title>Suppression de compte</title>
</head>

<body>
  <?php
  require_once "../../view/ViewUser.php";
  require_once "../../model/ModelUser.php";

if (isset($_SESSION['id']) && ($_SESSION['role'] === 'super')) {
  ViewTemplates::navAdmin();
  
  if (isset($_GET['id'])) {
    if (ModelUser::getAccount($_GET['id'])) {
      ModelUser::deleteUser($_GET['id']);
      if (ModelUser::deleteUser($_GET['id'])) {
        ViewTemplates::alert("success", "Le compte a bien été supprimé.", "adminList.php");
        exit;
      } else {
        ViewTemplates::alert("danger", "Oups ! Le compte n'a pas pu être supprimé.", "adminList.php");

      }
    } else {
      ViewTemplates::alert("danger", "Oups ! Cet utilisateur n'existe pas dans la base de données.");
    }
  } else {
    ViewTemplates::alert("danger", "Oups ! Impossible de récupérer les données depuis la base.");

  }
}
else {
  ViewTemplates::navConnexion();
  ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.", "adminConnexion.php");
}

  ViewTemplates::footer();