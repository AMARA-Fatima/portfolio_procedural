<!-- raccrocci pour trouver le lien d'une page apuyer sur la loupe et ecrire le nom de la page -->
<!-- création d'un acces au back-office -->
<?php
include("../assets/inc/headFront.php")
?>
<!--1. il faut créer un user avec le role admin dans la BDD pour avoir un administrateur du back-office(console d'adminiistration).
    2. pour cela on crée un formulaire user pour renseigner la BDD au niveau du CRUD.
    3. Nous allons faire un Create avec l'instruction SQL INSERT INTO -->
<title>createUser</title>
<?php include("../assets/inc/headerFront.php") ?>

<div class="container">
    <div class="row">
        <div class="col-4 mt-5">

            <h3>Créer une compétences :</h3>

            <form action="" method="post">

                <input type="hidden" name="faire" value="create_competence">
                
                <select name="type" id="l1" class="mb-3 form-select text-center">
                    <option value="1" selected>Front-end</option>
                    <option value="2" selected>Back-end</option>
                </select>

                <input class="form-control" type="text" name="titre" placeholder="Nom de la compétences">

                <input class="form-control mt-3" type="text" name="texte" placeholder="Ajouter une description">

                <label for="image" class="mt-2">Ajouter une image</label>
                <input class="form-control" type="file" name="image">

                <input class="form-control mt-3 mb-3" type="text" name="lien" placeholder="Ajouter un lien">

                <div>
                    <input type="checkbox" name="active" value="1">
                    <label for="active">afficher dans le Front-end</label>
                </div>

                <button type="submit" name="soumettre" class="offset-3 mt-3">Enregistrer</button>

            </form>

            <?Php
            // on récupère le fichier de connexion => connexion.php qui correspond aux paramètre de connexion de notre BDD
            require("../core/connexion.php");
            // on met en place une condition pour récupérer les données du formulaire
            if (isset($_POST["soumettre"])) :
                // on utilise des fonctions natives PHP pour formatter correctement le texte

                // 1. récupération des données et formatage :
                $nomCompetence = addslashes(trim(ucfirst($_POST["titre"])));
                /*  addslashes() = permet de garder l'apostrophe dans un nom exemple: M.l'Anglais
                    trim() = supprimer les espace avant et apres les mot de passe
                    ucfirst() = permet de mettre la    première lettre en majuscule 
                    strtolower() = permet de mettre les lettre en minuscule */
                $description = addslashes(trim(ucfirst($_POST["texte"])));

                $img = $_POST["image"];

                $lien = addslashes(trim($_POST["lien"]));

                // on dit que 1 est admin pour le role
                // $type = 1;
                var_dump($_POST);

                if (isset($_POST["type"])) {
                    // si la case "type" est cochée
                    $type = 1;
                } else {
                    // si la case "type" n'est pas cochée
                    $type = 2;
                }

                if (isset($_POST["active"])) {
                    // si la case "type" est cochée
                    $active = 1;
                } else {
                    // si la case "type" n'est pas cochée
                    $active = 2;
                }

                // 2. préparation de l'ecriture SQL :
                $sql = "INSERT INTO competences (
                                            type, 
                                            titre, 
                                            texte, 
                                            image, 
                                            lien,
                                            active
                                            )
                        VALUE (
                                $type,
                                '$nomCompetence',
                                '$description',
                                '$img',
                                '$lien',
                                $active
                            )";
                // $sql = "INSERT INTO user (nom, prenom, email, password, role)
                // VALUE ('$nom', '$prenom', '$email', '$password', '$role')";

                // 3. execution de la requete avec les paramètres de connexion :
                mysqli_query($connexion, $sql) or die(mysqli_error($connexion));

                // 4. message de confirmation d'enregistrement des données du webmaster
                $_SESSION["message"] = "la compétence  $nomCompetence est correctement ajouté à la BDD";

                // 5. redirection vers notre page d'accueil (index.php = page d'accueil)
                header("location:../admin/accueilAdmin.php");
                exit;
            endif;
            ?>
        </div>
    </div>
</div>