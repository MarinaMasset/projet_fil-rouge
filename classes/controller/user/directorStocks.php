<?php 
session_start();
require_once "../../view/ViewTemplates.php"; 
ViewTemplates::head();?>

    <title>Gestion des stocks</title>
    </head>
    <body>
        <?php
        if (isset($_SESSION['id']) && ($_SESSION['role'] !== 'super')) {
        
            ViewTemplates::nav();
            ?>
            <main>
                <?php

            echo "<a href='adminHome.php'> Retour </a>"; }

        else {
            ViewTemplates::navConnexion();
            ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.", "adminConnexion.php");
        }

ViewTemplates::footer();