Nous allons créer un site portfolio :
1. partie front
2. partie back-office (admin) qui permettera au webmaster (vous) de configurer le site ou récupérer des informations
3. au niveau de la BDD 
    - l'accès au back-office :
        - une table user (avec plusieurs champs ou colonnes)
            - nom
            - prenom
            - email
            - password
            - role 

    - l'accès à la messagerie :
        - une table message
            - id_message (A.I. Auto Incrémentation primary key) 
            - nom (VARCHAR 255) : non null
            - prenom (VARCHAR 255) : non null
            - société (VARCHAR 255) : null
            - email (VARCHAR 255) : non null (clé unique)
            - telephone (VARCHAR 255) : null
            - le message (description) : non null

    - l'acces aux compétences : (une table back_end et front_end )
        - une table competences :
            - id_competence (A.I. Auto Incrémentation primary key)
            - type (int 2) (1= front-end, 2= back-end) : non null
            - titre (VARCHAR 255) : non null
            - texte (VARCHAR 255) : null
            - image (VARCHAR 255) : null
            - lien  (VARCHAR 255) : null
            - active (boolean)    : non null


4. création de l'architecture (arborescence des dossiers et fichiers)
5. création de la table user dans la bdd portfolio
6. création du dossier et fichier aide/creerUnAdminDuSite.php
    - ce fichier va nous permettre de créer un formulaire pour enregistrer un administrateur qui aura accès au back-office (console d'administration) de notre site (pour le portfolio vous-même)
7. création d'une barre de navigation dans le fichier assets/inc/headerFront.php
