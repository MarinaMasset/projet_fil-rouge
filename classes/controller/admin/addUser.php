<?php 
session_start();
require_once "../../view/ViewTemplates.php"; 
ViewTemplates::head();?>

<title>Ajout d'utilisateur</title>
</head>

<body>
  <?php
  require_once "../../view/ViewForms.php";
  require_once "../../model/ModelList.php";

  ViewTemplates::navAdmin();

  if(isset($_POST['addUser'])){
    if(ModelList::addUser($_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['pass'], $_POST['tel'], $_POST['role'])) {
      ViewTemplates::alert("success", "insertion faite avec succes", "userList.php");
    }
    else {
      ViewTemplates::alert("danger", "échec de l'insertion", "addUser.php");
    }
  }
  else {
    ViewForms::addUserForm();
  }
  
  ViewTemplates::footer();