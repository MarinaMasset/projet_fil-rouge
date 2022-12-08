<?php 
session_start();
require_once "../../view/ViewWarehouse.php"; 
require_once "../../view/ViewTemplates.php"; 
ViewTemplates::head();?>

    <title>Liste des dépôts</title>
    </head>
    <body class="warehouseList">
        <?php
        if (isset($_SESSION['id']) && ($_SESSION['role'] === 'directeur' || $_SESSION['role'] === 'magasinier')) {
        
            ViewTemplates::nav();
            ?>
            <main>
                <?php
                ViewWarehouse::warehouseList();
        }
        else {
            ViewTemplates::navConnexion();
            ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.", "connexion.php");
        }
            ?>
        </main>
        <?php
        ViewTemplates::footer();