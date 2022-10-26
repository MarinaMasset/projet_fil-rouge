<?php

class ViewForms
{
    public static function connexionForm()
    {
?>
        <form class="conForm d-flex justify-content-center py-4" id="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
            <div class="card mb-3" style="max-width: 18rem; border:#580979 1px solid;">
                <div class="card-header text-center" style="border-bottom:#580979 1px solid;">Connexion à votre compte</div>
                <div class="card-body">
                    <h5 class="card-title text-center">Veuillez renseigner vos identifiants.</h5>
                        <div class="col-auto">
                            <label for="login" class="form-label">Nom d'utilisateur</label>
                            <input type="email" class="form-control" id="login" name="login" aria-describedby="nameHelp" data-type="email" data-message="Veuillez fournir votre mail professionnel." placeholder="Votre email">
                            <small id="nameHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="col-auto">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="pass" name="pass" aria-describedby="passHelp" data-type="pass" data-message="Le mot de passe doit contenir au moins 8 caractères dont une majuscule, une minuscule et un chiffre." placeholder="Votre mot de passe">
                            <small id="passHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="col-auto d-flex justify-content-center">
                            <button type="submit" name="connexion" class="btn mb-3 text-white">Connexion</button>
                        </div>
                </div>
            </div>
        </form> 
<?php
    }

    public static function addUserForm() 
    {
        ?>
    <form class="col-md-6 offset-md-3" method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <h1 class="text-center">Ajout d'utilisateur</h1>
    <div class="form-group">
        <label for="nom">Nom : </label>
        <input type="text" class="form-control" name="nom" id="nom">
      </div>
      <br>
      <div class="form-group">
        <label for="prenom">Prénom : </label>
        <input type="text" class="form-control" name="prenom" id="prenom">
      </div>
      <br>
      <div class="form-group">
        <label for="mail">Adresse mail : </label>
        <input type="email" class="form-control" name="mail" id="mail">
      </div>
      <br>
      <div class="form-group">
        <label for="pass">Mot de passe : </label>
        <input type="password" class="form-control" name="pass" id="pass">
      </div>
      <br>
      <div class="form-group">
        <label for="tel">Téléphone : </label>
        <input type="tel" class="form-control" name="tel" id="tel">
      </div>
      <br>
      <div class="form-group">
        <label for="tel">Rôle : </label>
        <input type="select" class="form-control" name="role" id="role">
      </div>
        <br>
      <button type="submit" class="btn btn-primary" name="addUser" id="addUser">Ajouter l'utilisateur</button>
      <button type="reset" class="btn btn-danger">Réinitialiser</button>
    </form>
<?php
  }
 }
