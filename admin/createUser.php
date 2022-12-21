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
            <h3>Admin :</h3>
            <form action="" method="post">
                <input class="form-control" type="text" name="nom" placeholder="Votre nom">
                <input class="form-control mt-3" type="text" name="prenom" placeholder="Votre prenom">
                <input class="form-control mt-3" type="email" name="email" placeholder="Votre email">
                <input class="form-control mt-3 mb-3" type="password" name="password" placeholder="Votre mot de passe">
                <div>
                    <input type="checkbox" id="isAdmin" name="is_admin">
                    <label for="isAdmin">Administrateur</label>
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
                $nom = addslashes(trim(ucfirst($_POST["nom"])));
                /*  addslashes() = permet de garder l'apostrophe dans un nom exemple: M.l'Anglais
                    trim() = supprimer les espace avant et apres les mot de passe
                    ucfirst() = permet de mettre la    première lettre en majuscule 
                    strtolower() = permet de mettre les lettre en minuscule */
                $prenom = addslashes(trim(ucfirst($_POST["prenom"])));
                $email = trim(strtolower($_POST["email"]));
                // la gestion de l'encodage (sécurisation) du mot de passe (il faut utiliser les [] au lieux des ())
                // cost = l'option d'encodage 12 = c'est niveau d'encodage
                $option = ['cost' => 12];
                $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT, $option);
                // on dit que 1 est admin pour le role
                // $role = 1;
                var_dump($_POST);
                if (isset($_POST["is_admin"])) {
                    // si la case "isAdmin" est cochée
                    $role = 1;
                } else {
                    // si la case "isAdmin" n'est pas cochée
                    $role = 2;
                }

                // 2. préparation de l'ecriture SQL :
                $sql = "INSERT INTO user (
                                            nom, 
                                            prenom, 
                                            email, 
                                            password, 
                                            role
                                            )
                        VALUE (
                                '$nom',
                                '$prenom',
                                '$email',
                                '$password',
                                '$role'
                            )";
                // $sql = "INSERT INTO user (nom, prenom, email, password, role)
                // VALUE ('$nom', '$prenom', '$email', '$password', '$role')";

                // 3. execution de la requete avec les paramètres de connexion :
                mysqli_query($connexion, $sql) or die(mysqli_error($connexion));

                // 4. message de confirmation d'enregistrement des données du webmaster
                $_SESSION["message"] = "Administrateur $nom $prenom est correctement ajouté à la BDD";

                // 5. redirection vers notre page d'accueil (index.php = page d'accueil)
                header("location: http://localhost/exercice_et_cours_POEC/sitePhpProcedurale/index.php");
                exit;
            endif;
            ?>
        </div>
    </div>
</div>