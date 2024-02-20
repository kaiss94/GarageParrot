<?php
include_once 'Car.php';

// Récupérer les données du formulaire
$brand = $_POST['brand'];
$model = $_POST['model'];
$mileage = $_POST['mileage'];
$kilometers = $_POST['kilometers'];
$price = $_POST['price'];
$engine = $_POST['engine'];
$description = $_POST['description'];
$carImage = $_FILES['carImage'];

// Vérifier si l'image a été téléchargée avec succès
if ($carImage['error'] === UPLOAD_ERR_OK) {
  // Déplacer l'image vers le dossier d'uploads
  $uploadPath = 'uploads/cars/' . basename($carImage['name']);
  move_uploaded_file($carImage['tmp_name'], $uploadPath);

  // Créer une nouvelle instance de la classe Car avec les données du formulaire
  $car = new Car(null, $brand, $model, $mileage, $kilometers, $price, $engine, $description, $uploadPath);

  // Enregistrer la voiture dans la base de données
  $car->saveToDatabaseCars();

  // Redirection vers une page de confirmation ou autre
  header('Location: cars.php');
  exit();
} else {
  // Gérer les erreurs de téléchargement de l'image
  echo 'Une erreur s\'est produite lors du téléchargement de l\'image.';
}
