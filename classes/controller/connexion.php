<?php
session_start();
require_once "../view/ViewTemplates.php";
require_once "../view/ViewConForm.php";
require_once "../model/UserConnexion.php";


if (isset($_SESSION['id']) && ($_SESSION['role'] !== 'super')) {
 header('Location: home.php');
  exit;
}

require_once "../view/ViewTemplates.php";
ViewTemplates::head(); ?>

<title>Connexion</title>
</head>

<body>
  

  <?php
  require_once "../view/ViewConForm.php";
  require_once "../model/UserConnexion.php";
  
  var_dump($_POST);
  if (isset($_POST['connexion'])) { 
    echo "post Ok";
    // // $userData = UserConnexion::connexionUser($_POST['login']);

    // // if ($userData && password_verify($_POST['pass'], $userData['pass'])) {
    // //   $_SESSION['id'] = $userData['id'];
    // //   $_SESSION['nom'] = $userData['nom'];
    // //   $_SESSION['prenom'] = $userData['prenom'];
    // //   $_SESSION['role'] = $userData['role'];

    // //   if (!$_SESSION['role'] !== 'super') {
    // //     header('Location: home.php');
    // //   }
    // // } else {
    // //   echo "Echec d'authentification";
    // //   echo "<a href='connexion.php'> Retour </a>";
    // }
  } else {
    
    ViewTemplates::navConnexion();
    ?> <main> <?php
    ViewConForm::connexionForm();
    ?> </main> <?php
    ViewTemplates::footer();
  }

  ?>