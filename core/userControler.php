<!-- tour de controle de notre site -->
<title>Page userControler.php</title>
<?php
session_start();
// on analyse ce qu'il y a à faire :
$action = "empty";
// si la clé "faire" (voir admin/index.php) est détecté dans $_POST (avec la balise caché <input type="hidden">)
if (isset($_POST["faire"])) :
    // notre variable $action est egale à la valeur de la clé "faire"
    $action = $_POST["faire"];
endif;
// on utilise un switch pour vérifier l'action
switch ($action):
    case "log-admin":
        logAdmin(); // correspond à value="log-admin" dans l'input cahé => voir page admin/index.php
        break;
    case "log-out":
        logOut(); // correspond à value="log-admin" dans l'input cahé => voir page admin/index.php
        break;
endswitch;

// les differente fonctions de notre controler
function logAdmin()
{
    // 1. nous aurons besoin de notre connexion
    require("connexion.php");
    /* 2. - vérification de l'email de l'admin qui est unique
          - préparation des données, ensuite on procède au formatage */
    $login = trim(strtolower($_POST["login"]));
    // requete SQL (read au niveau du CRUD) avec SELECT
    // SECT = permet de lire les information dans la base de donnée
    // * on récupère tous les champs dans les données
    // FROM =  avec quelle table on interagit
    // WHERE = selectionner des données précise (un champ precis)
    $sql = "SELECT * 
            FROM user 
            WHERE email = '$login'
            ";
    // execution de la requete
    $query = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));

    // 3. traitement des données
    // a. On vérifie que l'email existe : on utilise la fonction mysqli_num_rows() qui compte le nombre de ligne
    if (mysqli_num_rows($query) > 0) :
        // on met sous forme de tableau associatif les données de l'admin récupéré !!!!
        // on récupère toute les informations de la table user de la base de donnée  
        $user = mysqli_fetch_assoc($query);
        // b. on verifie le mot de passe : le but c'est de verifier si le mot de passe saisie correspond à l'encodage stocké en BDD => on utilise la fonction password_verify() qui nous renvoi true/false pour vérifier le mot de passe
        // on compare les inforations rentré par l'utilisateur avec celle presente dans la base de dinnée
        if (password_verify(trim($_POST["password"]), ($user["password"]))) :
            // c. on verifie le role : on dit que role = 1 (true) et donc role = admin
            if ($user["role"] != 1) :
                // si la clé role != 1 , on envoi un message d'alerte 
                // le message s'affichera sur la page d'accueil !
                $_SESSION["message"] = "Vous n'êtes pas l'administrateur de ce site";
                // redirection vers la page d'accuille (on le vire)
                header("location:../admin/index.php");
                exit;
            else :
                // on crée plusieurs variables de session qui permettent un affichage personnalisé et de sécuriser l'accès au back-office (on enregistre)
                $_SESSION["prenom"] = $user["prenom"];
                $_SESSION["islog"] = true;
                $_SESSION["role"] = $user["role"];
                header("location:../admin/accueilAdmin.php");
                exit;
            endif;
        else : // sinon erreur mot de passe 
            $_SESSION["message"] = "erreur de mot de passe !!!";
            header("location:../admin/index.php");
            exit;
        endif;
    else : // sinon pas d'utilisateur identifié
        $_SESSION["message"] = "Désolé, pas d'email correspondant :-(";
        header("location:../admin/index.php");
        exit;
    endif;
}
function logOut()
{
    // pour déconnecter l'admin, il faut supprimer les variables de session
    // on détruit la session avec session_destroy()
    session_destroy();
    session_start();
    // message flash
    $_SESSION["message"] = "Vous êtes déconnecté !";
    // redirection vers page d'accueil du site
    header("Location:../index.php");
    exit;
}
