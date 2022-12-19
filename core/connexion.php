<title>connexion.php</title>
<?php
// la configuration de la connexion à la base de données 
// création d'une variable $online (en ligne) avec le type boolean à true !
$online = false;
if (!$online) : // pour les MAC le MDP c'est : root, pour les PC "sans MDP" !!!
    $host = "localhost"; // l'hote de la base données
    $user = "root"; // l'identifiant de l'hote
    $password = ""; // mot de passe de l'hote
    $bdd = "portfolio"; // nom de la base de données sur laquelle on veut se connecter
else :
    // à remplir avec les données que vous fournira votre hebergeur !!!
    // le nom du serveur
    $host = "";
    // l'utilisateur
    $user = "";
    // le mot de passe
    $password = "";
    // le nom de la BDD
    $bdd = "";
endif;
// mise en place de la connexion à la BDD (connecter le site à la base de données !!)
// le lien entre le site et a base de données !! 
$connexion = mysqli_connect($host, $user, $password, $bdd);
// passage des retours de requête au format d'encodage UTF-8
// mettre en place le utf8 pour faire un encodage de caractère
mysqli_query($connexion, "SET NAMES 'utf8'");
