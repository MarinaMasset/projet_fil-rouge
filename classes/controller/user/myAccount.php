<?php 
session_start();
require_once "../../view/ViewUser.php"; 
require_once "../../view/ViewTemplates.php"; 
ViewTemplates::head();?>

    <title>Espace compte</title>
    </head>
    <body>
        <?php
if (isset($_SESSION['id']) && ($_SESSION['role'] !== 'super')) {
        ViewTemplates::nav();
        
  if (isset($_GET['id'])) {
    if (ModelUser::getAccount($_GET['id'])) {
      ViewUser::seeMyAccount($_GET['id']);
    } else {
      ViewTemplates::alert("danger", "Cet utilisateur n'existe pas", "userList.php");
    }
  } else {
    ViewTemplates::alert("danger", "aucune donnée n'a été transmise");
  }


  ViewTemplates::footer();
}
else {
    
  ViewTemplates::navConnexion();
  ?> <main> <?php
  ViewUser::connexionForm();
  ?> </main> <?php
  ViewTemplates::footer();
}