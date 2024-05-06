<?php
include_once 'models/Hours.php';

// Récupérer les données du formulaire
$lundiAuVendredi = $_POST['lundiAuVendredi'];
$samedi = $_POST['samedi'];
$dimanche = $_POST['dimanche'];



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Créer une instance de Review avec les données
    $horaire = new Hours(null, $lundiAuVendredi, $samedi, $dimanche);

    // Enregistrer les données dans la base de données
    $horaire->saveToDatabase();

    // Redirection vers une page de confirmation ou autre
    echo "enregistrement réussi !";
    exit();
} else {
    // Gérer les erreurs
    echo 'Une erreur s\'est produite.';
}