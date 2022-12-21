<title>detail d'un utilisateur</title>
<?php
// dans ce fichier on va créer la page connexion à notre back-office / avec le login : identifiant & mot de passe
include("../assets/inc/headBack.php");
?>
<?php include("../assets/inc/headerBack.php") ?>
<?php
// vérifions si l'utilisateur a le droit d'acceder à la page 
if (!isset($_SESSION["role"], $_SESSION["islog"], $_SESSION["prenom"]) || !$_SESSION["islog"] || $_SESSION["role"] != 1) {

    // l'uitilisateur n'a pas le droit : redirigons le 
    $_SESSION["message"] = "Vous n'avez pas de droit administrateur !!!";
    header("location: ../admin/index.php");
    exit;
}
// choix de l'id de l'utilisateur à afficher 
$id = $_GET["id_user"];

require("../core/connexion.php");
// ecriture de la reequete
$sql = "SELECT `id_user`, -- selection des chmaps (SELCT = lecture)
                `nom`,
                `prenom`,
                `email`, 
                `role`
        -- de la table user
        FROM user
        -- où le champs id_user = variable id
        WHERE id_user = $id 
";
// execution de la requete avec les parametres de connexion ! (query = requete)
$query = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
// formatage du retour de la requete sous forme de tableau associatif !
$user = mysqli_fetch_assoc($query);

/*
    1. afficher les informations de l'utilisateur sur la page 
    2. afficher un utilisateur en fontion de son id quand on clique dessus depuis la liste des utilisateur (listUser.php)
        #indices : paramètre GET dans l'URL 
*/
?>
<main>
    <h1 class="offset-4 text-decoration-underline">Détail de l'utilisateur :</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                <p>Le nom : <?php echo $user["nom"] ?></p>
                <p>Le prénom : <?php echo $user["prenom"] ?></p>
                <p>L'email : <?php echo $user["email"] ?></p>
                <p>Le rôle : <?php
                                if ($user["role"] == 1) :
                                    echo "Administrateur";
                                else :
                                    echo "Utilisateur";
                                endif;
                                ?>
                </p>
            </div>
        </div>
    </div>
</main>