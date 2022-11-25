<?php
session_start();
require_once "../../view/ViewTemplates.php";
require_once "../../view/ViewUser.php";
require_once "../../model/UserConnexion.php";


if (isset($_SESSION['id']) && ($_SESSION['role'] !== 'super')) {
 header('Location: home.php');
  exit;
}

ViewTemplates::head(); ?>

<title>Connexion</title>
</head>

<body>
  
  <?php
  if (isset($_POST['connexion'])) { 
    $userData = UserConnexion::connexionUser($_POST['login']);

    if ($userData && password_verify($_POST['pass'], $userData['pass'])) {
      $_SESSION['id'] = $userData['id'];
      $_SESSION['nom'] = $userData['nom'];
      $_SESSION['prenom'] = $userData['prenom'];
      $_SESSION['role'] = $userData['role'];
      $_SESSION['pass'] = $userData['pass'];

      if ($_SESSION['role'] !== 'super') {
        header('Location: home.php');
      }
    } else {
      echo "Echec d'authentification";
      echo "<a href='connexion.php'> Retour </a>";
    }
  } else {
    
    ViewTemplates::navConnexion();
    ?> <main> <?php
    ViewUser::connexionForm();
    ?> </main> <?php
    ViewTemplates::footer();
  }

  ?>