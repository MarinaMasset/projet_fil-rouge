<?php 
session_start();
require_once "../../view/ViewUserList.php"; 
require_once "../../view/ViewTemplates.php"; 
ViewTemplates::head();?>

    <title>Espace administrateur</title>
    </head>
    <body>
        <?php
        ViewTemplates::navAdmin();
        ?>
        <main>
            <?php
            ViewUserList::adminList();
            ?>
        </main>
        <?php
        ViewTemplates::footer();