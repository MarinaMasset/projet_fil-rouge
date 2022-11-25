<?php 
session_start();
require_once "../../view/ViewTemplates.php"; 
require_once "../../view/ViewUser.php";
require_once "../../model/ModelUser.php";
ViewTemplates::head();?>

<title>Ajout d'utilisateur</title>
</head>

<body>
  <?php

  if (isset($_SESSION['id']) && ($_SESSION['role'] === 'super')) {

    ViewTemplates::navAdmin();

    if(isset($_POST['addUser'])){
      if(ModelUser::addUser( $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['pass'], $_POST['tel'], $_POST['role'])) {
        ViewTemplates::alert("success", "Ajout d'utilisateur effectué avec succès", "adminList.php");
      }
      else {
        ViewTemplates::alert("danger", "Échec de l'insertion", "addUser.php");
      }
    }
    else {
      ViewUser::addUserForm();
    }

  }
  else {
    ViewTemplates::navConnexion();
    ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.", "adminConnexion.php");
}

ViewTemplates::footer();
