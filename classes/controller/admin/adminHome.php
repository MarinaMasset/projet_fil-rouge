<?php 
session_start();
require_once "../../view/ViewUser.php"; 
require_once "../../view/ViewTemplates.php"; 
ViewTemplates::head();?>

    <title>Espace Administrateur</title>
    </head>
    <body>
        <?php
          if (isset($_SESSION['id']) && ($_SESSION['role'] === 'super')) {
            ViewTemplates::navAdmin();
            ?>
            <main>
                <p>Bienvenue dans l'espace administrateur !</p>
            </main>
            <?php 
        }
        else {
            ViewTemplates::navConnexion();
            ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.", "adminConnexion.php");
        }
        
        ViewTemplates::footer();