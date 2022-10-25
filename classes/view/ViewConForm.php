<?php

class ViewConForm
{
    public static function connexionForm() 
    {
    ?>
<form class="conForm d-flex justify-content-center py-4" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
    <div class="card mb-3" style="max-width: 18rem; border:#580979 1px solid;">
        <div class="card-header text-center" style="border-bottom:#580979 1px solid;">Connexion à votre compte</div>
            <div class="card-body">
                <h5 class="card-title text-center">Veuillez renseigner vos identifiants.</h5>      
                <form class="row g-3">
                    <div class="col-auto">
                        <label for="login" class="form-label">Nom d'utilisateur</label>
                        <input type="email" class="form-control" id="login" name="login" placeholder="Votre email">
                    </div>
                    <div class="col-auto">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Votre mot de passe">
                    </div>
                    <div class="col-auto d-flex justify-content-center">
                        <button type="submit" name="connexion" class="btn mb-3 text-white">Connexion</button>
                    </div>
                </form>
            </div>
    </div>
</form>
        <?php
    }
}