<?php

class ViewConForm
{
    public static function connexionForm()
    {
?>
        <!-- <form class="conForm d-flex justify-content-center py-4" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
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
                            <input type="submit" name="connexion" class="btn mb-3 text-white">Connexion</input>
                        </div>
                </div>
            </div>
        </form> -->
        <form method="post" action="connexion.php">
            <input type="text" name="nom">
            <input type="text" name="prenom">
            <input type="submit" name="connexion" value="connexion">
        </form>
<?php
    }
}
