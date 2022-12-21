<!-- si l'utilisateur n'est pas connecté ou n'est pas administrateur, le rediriger et lui afficher une message l'invitant à se connecter (indice: $_SESSION est votre amie !!)  -->
<title>Console d'administration</title>
<?php
include("../assets/inc/headBack.php");
// vérifions si l'utilisateur a le droit d'acceder à la page 
if (!isset($_SESSION["role"], $_SESSION["islog"], $_SESSION["prenom"]) || !$_SESSION["islog"] || $_SESSION["role"] != 1) {

    // l'uitilisateur n'a pas le droit : redirigons le 
    $_SESSION["message"] = "Vous n'avez pas de droit administrateur !!!";
    header("location: ../admin/index.php");
    exit;
}
?>

<?php
include("../assets/inc/headerBack.php");
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
?>

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4 mt-5">
                <h4>Bienvenue <?= $_SESSION["prenom"] ?></h4>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-3">
            <form action="../core/userControler.php" method="post">
                <input type="hidden" name="faire" value="log-out">
                <button class="btn-primary fw-bold" type="submit" name="soumettre ">Se deconnecter</button>
            </form>
        </div>
    </div>
</main>

<?php
include("../assets/inc/footerBack.php")
?>