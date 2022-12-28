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

$sql = "SELECT `id_competence`, `type`, `titre`, `texte`, `image`, `lien`, `active`
        FROM `competences`
";

$query = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));

$competences = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<main>
    <div class="container">
        <div class="row justify-content-center">
            <!-- gestion d'affichage des messages -->
            <?php
            if (isset($_SESSION["message"])) :
                echo '<div class="alert alert-success" role="alert">' .
                    $_SESSION["message"] . '</div>';
                // on efface la clé messege, une fois qu'elle a été afficher avec unset()
                unset($_SESSION["message"]);
            endif;
            ?>
            <div class="col-4 mt-5">
                <h1 class="d-flex">Liste des utilisateurs</h1>
            </div>
        </div>
        <table class="table text-white mb-5">
            <tr class="text-center">
                <th>id</th>
                <th>Type</th>
                <th>Titre</th>
                <th>Texte</th>
                <th>Image</th>
                <th>Lien</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($competences as $competence) {
            ?>
                <tr class="text-center">
                    <td><?= $competence["id_competence"]; ?></td>
                    <td>
                        <?php
                        if ($competence["type"] == 1) {
                            echo "Front-end";
                        } else {
                            echo "Back-end";
                        }
                        ?>
                    </td>
                    <td><?= $competence["titre"]; ?></td>
                    <td><?= $competence["texte"]; ?></td>
                    <td><?= $competence["image"]; ?></td>
                    <td><?= $competence["lien"]; ?></td>
                    <td>
                        <?php
                        if ($competence["active"] == 1) {
                            echo "afficher";
                        } else {
                            echo "masquer";
                        }
                        ?>
                    </td>
                    <td class="d-flex">
                        <a type="button" class="btn bg-primary text-white me-1" href="../admin/updateCompetence.php?id_competence=<?= $competence["id_competence"]; ?>">Modifier</a>
                        <a type="button" class="btn bg-success text-white me-1" href="../admin/readCompetence.php?id_competence=<?= $competence["id_competence"]; ?>">Détail</a>
                        <a type="button" class="btn bg-danger text-white" href="../admin/deleteCompetence.php?id_competence=<?= $competence["id_competence"]; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
        <a href="../admin/createCompetence.php" class="btn bg-primary text-white offset-5">Ajouet une nouvelle compétence</a>
    </div>
</main>

<?php
include("../assets/inc/footerBack.php")
?>