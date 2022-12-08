<?php 
session_start();
require_once "../../view/ViewTemplates.php"; 
ViewTemplates::head(); ?>

    <title>Accueil</title>
    </head>
    <body>
        <?php
if (isset($_SESSION['id']) && ($_SESSION['role'] !== 'super')) {
        ViewTemplates::nav();
        ?>
        <main>
            <p>Bienvenue dans votre espace utilisateur !</p>
        </main>
        <?php
        ViewTemplates::footer();
}
else {
    
    ViewTemplates::navConnexion();
    ?> <main> <?php
    ViewUser::connexionForm();
    ?> </main> <?php
    ViewTemplates::footer();
}
