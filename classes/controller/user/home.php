<?php 
session_start();
require_once "../../view/ViewTemplates.php"; 
require_once "../../view/ViewForms.php"; 
ViewTemplates::head(); ?>

    <title>Accueil</title>
    </head>
    <body>
        <?php
        ViewTemplates::nav();
        ?>
         <main>
            <p>Bienvenue dans votre espace utilisateur !</p>
        </main>
        <?php
        ViewTemplates::footer();

