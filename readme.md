# Garage Parrot

Bienvenue dans le projet Garage Parrot !

## Installation

1. Clonez ce dépôt sur votre machine locale.
2. Importez la base de données `GarageParrot.sql` dans votre système de gestion de bases de données (par exemple, MySQL).
3. Configurez votre serveur web pour qu'il pointe vers le répertoire racine du projet.

## Configuration

Executez toutes les commandes du script `GarageParrot.sql` dans l'ordre pour créer les profils de connexions à la base de données.

## Utilisation

1. Configurez les connections à votre BDD dans le dossier "config". Attention il y a 2 fichiers car 2 niveaux d'accés. 
`connectDb.php` permet de parcourir la base de données en lecture seule.
`connectDbAdmin.php` permet de parcourir la base de données en lecture et écriture.
2. Accédez à l'application via votre navigateur en ouvrant `index.php` dans le dossier "views".
3. Parcourez les différentes sections pour consulter les voitures disponibles, les avis des clients, les services proposés, etc.
4. Connectez-vous en tant qu'utilisateur autorisé pour accéder à des fonctionnalités supplémentaires comme la modification des voitures, la validation des avis, etc.
Les 2 profils de connexion sont : 
  - Profil administrateur = Vincent Parrot : email de connexion : vincent.parrot@mongarage.com   mdp : password123
  - Profil employé = José Fereira : email de connexion : jose.fereira@mongarage.com   mdp : password123



## Auteur

MEZRANI Issam