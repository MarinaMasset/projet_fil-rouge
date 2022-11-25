<?php 
session_start();
if (isset($_SESSION['id']) && ($_SESSION['role'] !== 'super')) {
require_once "../../view/ViewUser.php"; 
require_once "../../view/ViewTemplates.php"; 
ViewTemplates::head();?>

    <title>Base d'utilisateurs</title>
    </head>
    <body>
        <?php
        ViewTemplates::nav();
        ?>
        <main">
            <?php
            ViewUser::userList();
            ?>
        </main>
        <?php
        ViewTemplates::footer();
}
else {
    ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.", "adminConnexion.php");
}
