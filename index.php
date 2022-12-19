<!-- inclusion de la page headFront.php -->
<?php include("assets/inc/headFront.php") ?> 
<!-- include =  liens facultatif qui fonctionne quand meme et affiche le reste du code -->
<!-- require = obligatoire le lien ne fonctionne pas et bloque tout le reste du code -->
<title>Portfolio</title>
<?php include("assets/inc/headerFront.php") ?>

<main>
    <!-- gestion d'affichage des messages -->
    <?php
    if (isset($_SESSION ["message"])) :
        echo '<div class="alert alert-success" role="alert">' . 
        $_SESSION["message"] . '</div>';
        // on efface la clé messege, une fois qu'elle a été afficher avec unset()
        unset($_SESSION["message"]);
    endif;
    ?>
</main>

<?php include("assets/inc/footerFront.php") ?>