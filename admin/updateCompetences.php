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
    <h1 class="offset-4 text-decoration-underline">Détail de l'utilisateur :</h1>
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
    <div class="container justify-content-center">
        <h2 class="offset-4 text-decoration-underline mt-5">Modification de l'utilisateur :</h2>
        <!-- gestion d'affichage des messages -->
        <?php
            if (isset($_SESSION["message"])) :
                echo '<div class="alert alert-success" role="alert">' .
                    $_SESSION["message"] . '</div>';
                // on efface la clé messege, une fois qu'elle a été afficher avec unset()
                unset($_SESSION["message"]);
            endif;
        ?>
        <form method="POST" action="../core/userControler.php" class="col-6 offset-3">

            <!-- input caché qui permet d'executer l'action de modification -->
            <input type="hidden" name="faire" value="update">

            <!-- input caché qui permet d'envoyer id pour savoir quel utilisateur nous allons modifier -->
            <input type="hidden" name="id" value="<?= $user["id_user"] ?>">

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" class="form-control" value="<?= $user["nom"] ?>">

            <label for="prenom">Prenom :</label>
            <input type="text" id="prenom" name="prenom" class="form-control" value="<?= $user["prenom"] ?>">

            <label for="eamil">Email :</label>
            <input type="email" id="eamil" name="email" class="form-control" value="<?= $user["email"] ?>">

            <label for="password">Password :</label>
            <input type="password" id="password" name="password" class="form-control">

            <label for="role" class="mt-3">Role :</label>
            <select name="role" id="role">
                <option value="2" <?php
                                    if ($user["role"] == 2) {
                                        echo "selected";
                                    } ?>>Utilisateur</option>
                <option value="1" <?php
                                    if ($user["role"] == 1) {
                                        echo "selected";
                                    } ?>>Administrateur</option>
            </select>

            <button type="submit" class="col-2 offset-3 fw-bold">Modifier</button>

        </form>
    </div>
</main>

<?php
include("../assets/inc/footerBack.php")
?>