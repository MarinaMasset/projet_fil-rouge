<?php 
session_start();
require_once "../../view/ViewTemplates.php"; 
require_once "../../view/ViewWarehouse.php"; 
ViewTemplates::head();?>

    <title>Votre recherche</title>
    </head>
    <body>
        <?php

if (isset($_SESSION['id']) && ($_SESSION['role'] !== 'super')) {
        ViewTemplates::nav();

        if (isset($_POST['search'])) { 
            include_once "../../view/ViewWarehouse.php" ?>
            <?php    
            header('Location: search.php');
            ViewWarehouse::searchResults();
            }
            else { echo "coucou!";}

    }
    else {
      ViewTemplates::navConnexion();
      ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.", "connexion.php");
  }
  
  ViewTemplates::footer();