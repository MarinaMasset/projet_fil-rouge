<?php 
require_once "../view/ViewUserList.php"; 
require_once "../view/ViewTemplates.php"; 
ViewTemplates::head();?>

    <title>Base d'utilisateurs</title>
    </head>
    <body>
        <?php
        ViewTemplates::nav();
        ?>
        <main style="overflow-y:auto;">
            <?php
            ViewUserList::userList();
            ?>
        </main>
        <?php
        ViewTemplates::footer();
