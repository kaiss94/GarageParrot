<?php
include_once '../models/Service.php';

// Récupérer les données du formulaire
$serviceName = $_POST['serviceName'];
$serviceDescription = $_POST['serviceDescription'];
$serviceImage = $_FILES['serviceImage'];

// Vérifier si l'image a été téléchargée avec succès
if ($serviceImage['error'] === UPLOAD_ERR_OK) {
    // Déplacer l'image vers le dossier d'uploads
    $uploadPath = '../uploads/services/' . basename($serviceImage['name']);
    move_uploaded_file($serviceImage['tmp_name'], $uploadPath);

    // Créer une instance de Service avec les données
    $service = new Service(null, $serviceName, $serviceDescription, $uploadPath);

    // Enregistrer les données dans la base de données
    $service->saveToDatabase();

    // Redirection vers une page de confirmation ou autre
    header('Location: ../views/services.php');
    exit();
} else {
    // Gérer les erreurs de téléchargement de l'image
    echo 'Une erreur s\'est produite lors du téléchargement de l\'image.';
}
