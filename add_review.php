<?php
include_once 'Review.php';

// Récupérer les données du formulaire
$clientName = $_POST['clientName'];
$comment = $_POST['comment'];
$rate = $_POST['rate'];
$date = $_POST['date'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Créer une instance de Review avec les données
    $review = new Review(null, $clientName, $comment, $rate, $date);

    // Enregistrer les données dans la base de données
    $review->saveToDatabase();

    // Redirection vers une page de confirmation ou autre
    header('Location: reviews.php');
    exit();
} else {
    // Gérer les erreurs
    echo 'Une erreur s\'est produite.';
}
