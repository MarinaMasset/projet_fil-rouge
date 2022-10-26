<?php

class ViewTemplates
{
  public static function head()
  { ?>
  <!DOCTYPE html>
      <html lang="fr">
      <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
          <link href="../../../CSS/main.css" rel="stylesheet">
<?php    
  }

  public static function navConnexion()
  { ?>
    <nav class="navbar navbar-dark text-light mb-5">
      
        <h1 class="mx-auto">Bienvenue sur le SGDS !</h1>
     
    </nav>
  <?php
  }


  public static function nav()
  { ?>
    <nav class="navbar navbar-expand-lg navbar-dark text-light mb-5">
      <div class="container">
      <div class="navbar-brand">SGDS</div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../../controller/user/userStocks.php">Vérifier les stocks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../../controller/user/userList.php">Voir les utilisateurs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="../../controller/user/account.php">Mon compte</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="../../controller/deconnexion.php">Me déconnecter</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  <?php
  }

  public static function navAdmin()
  { ?>
    <nav class="navbar navbar-expand-lg navbar-dark text-light mb-5">
      <div class="container">
        <div class="navbar-brand">SGDS</div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../../controller/admin/adminStocks">Vérifier les stocks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../../controller/admin/adminList.php">Gérer les utilisateurs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="../../controller/admin/addUser.php">Ajouter un utilisateur</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="../../controller/deconnexion.php">Me déconnecter</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  <?php
  }

  public static function footer()
  { ?>
      <footer class="text-center text-light py-4 h3 mt-5 mb-0">
        <div class="container">
          Masset Marina &copy; <?= date("Y") ?>
        </div>
  </footer>

  <script
			src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
			integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
			crossorigin="anonymous">
  </script>
	<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
			crossorigin="anonymous">
  </script>
  <script 
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
      crossorigin="anonymous">
  </script>
  <script src="../../../JS/main.js"></script>
  </body>
</html>
  <?php
  }

  public static function alert($type, $message, $lien = null)
  {
  ?>
    <div class="container alert alert-<?= $type; ?>" role="alert">
      <?= $message . "<br />";
      if ($lien) {
        echo "<a href='$lien' class='alert-link'>Cliquez ici</a>. Pour continuer la navigation.";
      }
      ?>
    </div>
<?php
  }
}


