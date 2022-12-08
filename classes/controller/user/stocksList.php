<?php
session_start();
require_once "../../view/ViewStocks.php"; 
require_once "../../view/ViewTemplates.php";

if (isset($_SESSION['id']) && ($_SESSION['role'] !== 'super')) {
ViewTemplates::head();?>

    <title>Produits en stock</title>
    </head>
    <body>
        <?php
        ViewTemplates::nav();
        ?>
        <main">
            <?php
            ViewStocks::productTypeList();
            ViewStocks::stocksList();
            ?>
        </main>
        <?php
        ViewTemplates::footer();
}
else {
    ViewTemplates::alert("danger", "Vous n'avez pas accès à cette section du site ou votre session a expiré. <br/> Veuillez vous authentifier.", "adminConnexion.php");
}