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
      <link href="../../../CSS/bootstrap.min.css" rel="stylesheet">
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
                  <a class="nav-link active" href="../../controller/user/warehouseList.php" class="btn btn-success">Gérer les dépôts</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active" href="myAccount.php?id=<?= $_SESSION['id'] ?>" class="btn btn-success">Mon espace</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="../../controller/deconnexion.php">Me déconnecter</a>
              </li>
            </ul>
            <form class="d-flex" method="post" role="search" action="search.php"> <?php //echo htmlspecialchars($_SERVER['PHP_SELF']) ?>
              <input class="form-control me-2" type="search" name="search" placeholder="Tapez votre recherche" aria-label="Search">
              <button class="btn btn-outline-light" name="submit" type="submit">Recherche</button>
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
                <a class="nav-link active" aria-current="page" href="adminList.php">Gérer les utilisateurs</a>
              </li>
              <li>
                <a class="nav-link active" href="addUser.php">Ajouter un utilisateur</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="userAccounts.php?id=<?= $_SESSION['id'] ?>">Mon espace</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="../../controller/deconnexion.php">Me déconnecter</a>
              </li>
            </ul>
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

      <script src="../../../JS/jquery-3.6.1.min.js"></script>
      <script src="../../../JS/bootstrap.bundle.min.js"></script>
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

 public static function modal($id) 
  {  ?>
   
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header alert alert-danger">
        <h1 class="modal-title fs-5 fw-bold" id="modal">Attention !</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Vous êtes sur le point de supprimer ce compte. Souhaitez-vous vraiment continuer ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="confirmation" data-bs-dismiss="modal">Supprimer</button>
        <button type="button" class="btn btn-secondary" id="cancelSupp" data-bs-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>
    <?php
  }
}
