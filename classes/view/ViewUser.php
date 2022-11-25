<?php
require_once "../../model/ModelUser.php";

class ViewUser
{

  public static function connexionForm()
    {
?>
        <form class="conForm d-flex justify-content-center py-4 m-2" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
            <div class="card mb-3" style="max-width: 18rem; border:#580979 1px solid;">
                <div class="card-header text-center" style="border-bottom:#580979 1px solid;">Connexion à votre compte</div>
                <div class="card-body">
                    <h5 class="card-title text-center">Veuillez renseigner vos identifiants.</h5>
                        <div class="col-auto">
                            <label for="login" class="form-label">Nom d'utilisateur</label>
                            <input type="email" class="form-control" id="login" name="login" aria-describedby="emailHelp" data-type="email" data-message="Veuillez fournir votre mail professionnel." placeholder="Votre email">
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="col-auto">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="pass" name="pass" aria-describedby="passHelp" data-type="pass" data-message="Le mot de passe est incorrect." placeholder="Votre mot de passe">
                            <small id="passHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="col-auto d-flex justify-content-around mx-2">
                            <button type="submit" name="connexion" class="btn mb-3 text-white">Connexion</button>
                            <button type="reset" class="btn mb-3 text-white">Réinitialiser</button>
                        </div>
                </div>
            </div>
        </form> 
<?php
    }

  //Can only see a list of users and their own accounts.
    public static function userList()
    {
        $list = ModelUser::UserList();
?>
        <div class="container">
            <?php
            if ($list) {
            ?>
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Mail</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">Rôle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($list  as $column => $value) {
                        ?> 
                            <tr>
                                <th scope="row"><?= $value['id'] ?></th>
                                <td><?= $value['nom'] ?></td>
                                <td><?= $value['prenom'] ?></td>
                                <td><?= $value['mail'] ?></td>
                                <td><?= $value['tel'] ?></td>
                                <td><?= $value['role'] ?></td>
                                <td>
                                <?php 
                                    if (($_SESSION['id'])===$value['id'])
                                    { ?>
                                    <a href="myAccount.php?id=<?= $value['id'] ?>" class="btn btn-success me-1">Mon espace</a>
                                    <a href="updateAccount.php?id=<?= $value['id'] ?>" class="btn btn-secondary text-white">Modifier mon compte</a>
                                  <?php } ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo "Aucun utilisateur n'a été trouvé dans la liste.";
            }
            ?> 
        </div>
<?php
    }

    //Can see and modify all accounts
    public static function adminList() {
        $list = ModelUser::UserList();
?>
        <div class="container">
            <?php
            if ($list) {
            ?>
            
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Mail</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">Rôle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($list  as $column => $value) {
                        ?> 
                            <tr>
                                <th scope="row"><?= $value['id'] ?></th>
                                <td><?= $value['nom'] ?></td>
                                <td><?= $value['prenom'] ?></td>
                                <td><?= $value['mail'] ?></td>
                                <td><?= $value['tel'] ?></td>
                                <td><?= $value['role'] ?></td>
                                <td>
                                    <a href="userAccounts.php?id=<?= $value['id'] ?>" class="btn btn-success me-1">Accès au compte</a>
                                    <a href="updateUsers.php?id=<?= $value['id'] ?>" class="btn btn-info text-white me-1">Modifier</a>
                                    <?php 
                                      if ($value['id'] !== $_SESSION['id']) {
                                    ?>
                                      <a href="suppressAccount.php?id=<?= $value['id'] ?>" <?php if ($value['role'] === 'super'){ ?> disabled <?php   } ?> type="button" class="btn btn-danger" data-id="<?= $value['id']?>">Supprimer</a> <?php 
                                      }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo "Aucun utilisateur n'a été trouvé dans la liste.";
            }
            ?> 
        </div>
<?php
    }

    //Function to access users accounts from the admin session
    public static function seeAccount($id)
  {
    $user =  ModelUser::getAccount($id);
    if ($user) {
    ?>
      <div class="container d-flex flex-column align-items-center" style="width: 21.5rem;">
      <a href="adminList.php" class="btn align-self-stretch text-white btn-gradient">↺ Retourner à la liste</a> 
        <div class="card" style="width: 20rem;">
          <div class="card-header text-center">
          <h5 class="card-title"> ID : <?= $user['id']?> </h5> 
          </div>
          <div class="card-body">
            <p class="card-text" style="line-height: 2.5;">
              Nom : <?= $user['nom'] ?>
              <br/>
              Prénom : <?= $user['prenom'] ?>
              <br/>
              Email : 
              <a href="mailto:<?= $user['mail'] ?>" target="_blank"><?= $user['mail'] ?></a>
              <br/>
              Téléphone : <a href="tel:<?= $user['tel'] ?>" target="_blank"><?= $user['tel'] ?></a>
              <br/>
              Rôle : <?= $user['role'] ?>
            </p>
            <div class="text-center">
            <a href="updateUsers.php?id=<?= $user['id'] ?>" class="btn btn-success text-white me-2">Modifier</a>
            <?php 
            if ($user['id']!== $_SESSION['id']) {
              ?>
              <a type="button" href="suppressAccount.php?id=<?= $user['id'] ?>" class="btn btn-danger">Supprimer</a>
            <?php 
            }
            ?>
            </div>
          </div>
        </div>
      </div>

    <?php
    }
    else {
    ?>
      <h1>aucun contact trouvé</h1>
    <?php
    }
  }

  //Function to navigate through one's own account
  public static function seeMyAccount($id)
  {
    $user =  ModelUser::getAccount($id);
    if ($user) {
    ?>
      <div class="container d-flex flex-column align-items-center" style="width: 21.5rem;">
      <a href="userList.php" class="btn align-self-stretch text-white btn-gradient">↺ Retourner à la liste</a> 
        <div class="card" style="width: 20rem;">
          <div class="card-header text-center">
          <h5 class="card-title"> ID : <?= $user['id']?> </h5> 
          </div>
          <div class="card-body">
            <p class="card-text" style="line-height: 2.5;">
              Nom : <?= $user['nom'] ?>
              <br/>
              Prénom : <?= $user['prenom'] ?>
              <br/>
              Email : 
              <a href="mailto:<?= $user['mail'] ?>" target="_blank"><?= $user['mail'] ?></a>
              <br/>
              Téléphone : <a href="tel:<?= $user['tel'] ?>" target="_blank"><?= $user['tel'] ?></a>
              <br/>
              Rôle : <?= $user['role'] ?>
            </p>
            <div class="text-center">
            <a href="updateAccount.php?id=<?= $user['id'] ?>" class="btn btn-success text-white me-2">Modifier</a>
            </div>         
          </div>
        </div>
      </div>
    <?php
    }
    else {
    ?>
      <h1>aucun contact trouvé</h1>
    <?php
    }
  }

  public static function addUserForm() 
    {
        ?><h1 class="text-center">Ajout d'utilisateur</h1>
    <form class="col-md-6 offset-md-3" method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="p-2">
          <div class="form-group">
          <label for="nom">Nom : </label>
          <input type="text" class="form-control" name="nom" id="nom" aria-describedby="surnameHelp" data-message="Veuillez taper la première lettre en majuscules puis le reste en minuscules." placeholder="Ex : Masset">
          <small id="surnameHelp" class="form-text text-muted"></small>
        </div>
        <br>
        <div class="form-group">
          <label for="prenom">Prénom : </label>
          <input type="text" class="form-control" name="prenom" id="prenom" aria-describedby="nameHelp" data-message="Veuillez taper la première lettre en majuscule puis le reste en minuscules. <br/> Le tiret est accepté pour les prénoms composés."  placeholder="Ex : Marina">
          <small id="nameHelp" class="form-text text-muted"></small>
        </div>
        <br>
        <div class="form-group">
          <label for="mail">Adresse mail : </label>
          <input type="email" class="form-control" name="mail" id="mail" aria-describedby="emailHelp" data-message="Veuillez fournir le mail professionnel de l'employé."  placeholder="Ex : nom.prenom@domaine.com">
          <small id="emailHelp" class="form-text text-muted"></small>
        </div>
        <br>
        <div class="form-group">
          <label for="pass">Mot de passe : </label>
          <input type="password" class="form-control" name="pass" id="pass" data-type="pass" aria-describedby="passHelp" data-message="Le mot de passe doit contenir au moins 8 caractères dont une majuscule, une minuscule et un chiffre." placeholder="Ex : Marina.62">
          <small id="passHelp" class="form-text text-muted"></small>
        </div>
        <br>
        <div class="form-group">
          <label for="tel">Téléphone : </label>
          <input type="tel" class="form-control" name="tel" id="tel" aria-describedby="telHelp" data-message="Veuillez entrer un format de téléphone français." placeholder="Ex : 0600000000">
          <small id="telHelp" class="form-text text-muted"></small>
        </div>
        <br>
        <div class="form-group">
          <label for="role">Rôle :</label>
          <select class="form-select"  name="role" id="role" aria-describedby="roleHelp" data-message="Veuillez sélectionner l'un des rôles proposés dans la liste déroulante.">
            <option selected value="">Cliquez pour dérouler</option>
            <option value="directeur">Directeur</option>
            <option value="magasinier">Magasinier</option>
          </select>
          <small id="roleHelp" class="form-text text-muted"></small>
        </div>
        <br>
        <div class="text-center">
          <button type="submit" class="btn btn-primary me-2" name="addUser" id="addUser">Ajouter l'utilisateur</button>
          <button type="reset" class="btn btn-danger">Réinitialiser</button>
        </div>
      </div>  
    </form>
<?php
  }

  public static function modifyUser($id)
  {
    $user = ModelUser::getAccount($id);
    ?>
    <form class="col-md-6 offset-md-3" method="post" 
    <?php 
    if ($_SESSION['role'] === 'super') { ?>
      action="updateUsers.php"
      <?php
    } 
    else { ?>
      action="updateAccount.php"
      <?php
    } ?>
    >
      <input type="hidden" class="form-control" name="id" id="id" value="<?= $user['id'] ?>">
      <div class="form-group">
        <label for="nom">Nom : </label>
        <input type="text" class="form-control" name="nom" id="nom" value="<?= $user['nom'] ?>">
      </div>
      <br/>
      <div class="form-group">
        <label for="prenom">Prenom : </label>
        <input type="text" class="form-control" name="prenom" id="prenom" value="<?= $user['prenom'] ?>">
      </div>
      <br/>
      <div class="form-group">
        <label for="mail">Adresse mail : </label>
        <input type="email" class="form-control" name="mail" id="mail" value="<?= $user['mail'] ?>">
      </div>
      <br/>
      <div class="form-group">
        <label for="tel">Téléphone : </label>
        <input type="tel" class="form-control" name="tel" id="tel" value="<?= $user['tel'] ?>">
      </div>
      <br/>
      <?php 
      if ($_SESSION['role']=== 'super') {
        if ($user['id']!== $_SESSION['id'])
          { ?>
            <div class="form-group">
                <label for="role">Rôle :</label>
                <select class="form-select"  name="role" id="role" aria-describedby="roleHelp" data-message="Veuillez sélectionner l'un des rôles proposés dans la liste déroulante." value="<?= $user['role'] ?>">
                  <option selected value="">Cliquez pour dérouler</option>
                  <option value="directeur">Directeur</option>
                  <option value="magasinier">Magasinier</option>
                </select>
                <small id="roleHelp" class="form-text text-muted"></small>
            </div>
            <br/>
          <?php }
        else {
          ?>
            <div class="form-group" hidden>
                <label for="role">Rôle :</label>
                <select class="form-select"  name="role" id="role" aria-describedby="roleHelp" data-message="Veuillez sélectionner l'un des rôles proposés dans la liste déroulante." value="<?= $user['role'] ?>">
                  <option value="super">Administrateur</option>
                </select>
                <small id="roleHelp" class="form-text text-muted"></small>
            </div>
            <br/>
          <?php
        }
      }
        ?>
        <br/>
        <div class="text-center">
          <button type="submit" class="btn btn-info me-2 text-white" name="modify" id="modify">Modifier</button>
          <button type="reset" class="btn btn-danger">Réinitialiser</button>
        </div>
      </form>
    <?php
  }
}
