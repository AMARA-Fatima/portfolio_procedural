<title>connexion back-office</title>
<?php
// dans ce fichier on va créer la page connexion à notre back-office / avec le login : identifiant & mot de passe
include("../assets/inc/headFront.php");
?>
<?php include("../assets/inc/headerFront.php") ?>
<main>
    <div class="container">
        <!-- gestion d'affichage des messages -->
        <div class="row">
            <?php
                if(isset($_SESSION["message"])) :
                echo '<div class="alert alert-danger" role="alert">' . $_SESSION["message"] . '</div>';
                // on efface la clé message, une fois qu'elle a été affichée avec unset() (initialise le message dans la variable)
                unset($_SESSION["message"]);
                endif;
            ?>
        </div>
        <div class="row justify-contente-center">
            <div class="col-4 offset-4 mt-5">
                <form class="form-group" action="../core/userControler.php" method="POST">
                    <!-- transmettre des données d'ordre technique caché dans un formulaire et à l'utilisateur-->
                    <input type="hidden" name="faire" value="log-admin">
                    <input class="form-control mt-5" type="eamil" name="login" placeholder="Votre email : ">
                    <input class="form-control mt-3" type="password" name="password" placeholder="Votre mot de passe : ">
                    <button class="mt-3 offset-3 fw-bold" type="submit" name="soumettre">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</main>

