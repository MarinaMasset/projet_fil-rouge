<?php 
session_start();
require_once "../../view/ViewUserList.php"; 
require_once "../../view/ViewTemplates.php"; 
ViewTemplates::head();?>

    <title>Espace Administrateur</title>
    </head>
    <body>
        <?php
        ViewTemplates::navAdmin();
        ?>
        <main>
            <p>Bienvenue dans l'espace administrateur !</p>
        </main>
        <?php
        ViewTemplates::footer();