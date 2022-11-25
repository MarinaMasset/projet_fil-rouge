<?php 
session_start();
require_once "../../view/ViewUser.php"; 
require_once "../../view/ViewTemplates.php"; 
ViewTemplates::head();?>

    <title>Espace administrateur</title>
    </head>
    <body>
        <?php

if (isset($_SESSION['id']) && ($_SESSION['role'] === 'super')) {
        ViewTemplates::navAdmin();


  if (isset($_GET['id'])) {
    if (ModelUser::getAccount($_GET['id'])) {
      ViewUser::seeAccount($_GET['id']);
    } else {
      ViewTemplates::alert("danger", "Cet utilisateur n'existe pas", "adminList.php");
    }
  } else {
    ViewTemplates::alert("danger", "aucune donnée n'a été transmise");
  }
}
else {
  ViewTemplates::navConnexion();
  ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.", "adminConnexion.php");
}


  ViewTemplates::footer();