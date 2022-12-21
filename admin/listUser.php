<!-- si l'utilisateur n'est pas connecté ou n'est pas administrateur, le rediriger et lui afficher une message l'invitant à se connecter (indice: $_SESSION est votre amie !!)  -->
<title>liste d'utilisateurs</title>
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
require("../core/connexion.php");

$sql = "SELECT `id_user`, `nom`, `prenom`, `email`, `role`
        FROM `user`
";

$query = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));

$users = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4 mt-5">
                <h1 class="d-flex">Liste des utilisateurs</h1>
            </div>
        </div>
        <table class="table text-white mb-5">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($users as $user) {
                // TODO : pour chaque utilisateur, créer une nouvelle ligne (tr) et afficher ses informations dans des cellules (td)
            ?>
                <tr>
                    <td>
                        <a href="../admin/updateUser.php?id_user=<?= $user["id_user"]; ?>"><?= $user["id_user"]; ?></a>
                    </td>
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
            <?php
            }
            ?>
        </table>
        <a href="../admin/createUser.php" class="offset-5">Ajouet un nouvel utilisateur</a>
    </div>
</main>

<?php
include("../assets/inc/footerBack.php")
?>