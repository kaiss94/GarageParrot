<?php
session_start();
include_once '../models/Car.php';

// Fonction pour valider et nettoyer les données d'entrée
function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Vérifier le jeton CSRF
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Invalid CSRF token.");
}

// Récupérer les données du formulaire en les nettoyant
$brand = clean_input($_POST['brand']);
$model = clean_input($_POST['model']);
$mileage = clean_input($_POST['mileage']);
$kilometers = clean_input($_POST['kilometers']);
$price = clean_input($_POST['price']);
$engine = clean_input($_POST['engine']);
$description = clean_input($_POST['description']);
$carImage = $_FILES['carImage'];

// Vérifier si l'image a été téléchargée avec succès
if ($carImage['error'] === UPLOAD_ERR_OK) {
    // Vérifier l'extension et le type MIME du fichier
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileExtension = pathinfo($carImage['name'], PATHINFO_EXTENSION);
    $fileMimeType = mime_content_type($carImage['tmp_name']);

    if (!in_array($fileExtension, $allowedExtensions) || !in_array($fileMimeType, $allowedMimeTypes)) {
        die('Type de fichier non autorisé.');
    }

    // Générer un nom de fichier unique pour éviter les collisions
    $uniqueFileName = uniqid('', true) . '.' . $fileExtension;
    $uploadPath = '../uploads/cars/' . $uniqueFileName;
    move_uploaded_file($carImage['tmp_name'], $uploadPath);

    // Créer une nouvelle instance de la classe Car avec les données du formulaire
    $car = new Car(null, $brand, $model, $mileage, $kilometers, $price, $engine, $description, $uploadPath);

    // Enregistrer la voiture dans la base de données
    $car->saveToDatabaseCars();

    // Redirection vers une page de confirmation ou autre
    header('Location: ../views/cars.php');
    exit();
} else {
    // Gérer les erreurs de téléchargement de l'image
    echo 'Une erreur s\'est produite lors du téléchargement de l\'image.';
}
