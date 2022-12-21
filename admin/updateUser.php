<!-- si l'utilisateur n'est pas connecté ou n'est pas administrateur, le rediriger et lui afficher une message l'invitant à se connecter (indice: $_SESSION est votre amie !!)  -->
<title>modification de l'utilisateur</title>
<?php
include("../assets/inc/headBack.php");
?>
<?php
include("../assets/inc/headerBack.php");
?>
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

$sql = "SELECT `id_user`, `nom`, `prenom`, `email`, `role`
        FROM user
        WHERE id_user = $id 
";

$query = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));

$user = mysqli_fetch_assoc($query);

/* todo : 
    1. afficher les informations de l'utilisateur sur la page 
    2. afficher un utilisateur en fontion de son id quand on clique dessus depuis la liste des utilisateur (listUser.php)
        #indices : paramètre GET dans l'URL 
*/
?>

<main>
    <h1 class="offset-4">Détail de l'utilisateur</h1>
    <table class="table text-white mt-5">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <tr>
            <td><?= $user["id_user"]; ?></td>
            <td><?= $user["nom"]; ?></td>
            <td><?= $user["prenom"]; ?></td>
            <td><?= $user["email"]; ?></td>
            <td>
                <?php
                if ($user["role"] == 1) {
                    echo "Administrateur";
                } else {
                    echo "Utilisateur";
                }
                ?>
            </td>
            <td>[suppression]</td>
        </tr>
    </table>
</main>

<?php
include("../assets/inc/footerBack.php")
?>