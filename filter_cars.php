<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voitures d'occasion Garage Parrot</title>
    <link rel="icon" href="/assets/images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<?php

//Initiation du résultat
$carResultsHTML = '<div class="container">';
$carResultsHTML .= '<div class="row g-4 align-items-center justify-content-md-center">';

//Vérification de la méthode GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //Initiation du début de la requête sql
    $sql = 'SELECT * FROM cars WHERE 1';
    $params = array();

    //Vérification que chaque paramètre n'est pas vide et ajout du filtre si ok
    if (!empty($_GET['priceMin'])) {
        $sql .= " AND price >= :priceMin";
        $params[':priceMin'] = $_GET['priceMin'];
    }
    if (!empty($_GET['priceMax'])) {
        $sql .= " AND price <= :priceMax";
        $params[':priceMax'] = $_GET['priceMax'];
    }
    if (!empty($_GET['mileageMin'])) {
        $sql .= " AND mileage >= :mileageMin";
        $params[':mileageMin'] = $_GET['mileageMin'];
    }
    if (!empty($_GET['mileageMax'])) {
        $sql .= " AND mileage <= :mileageMax";
        $params[':mileageMax'] = $_GET['mileageMax'];
    }
    if (!empty($_GET['kilometerMin'])) {
        $sql .= " AND kilometers >= :kilometerMin";
        $params[':kilometerMin'] = $_GET['kilometerMin'];
    }
    if (!empty($_GET['kilometerMax'])) {
        $sql .= " AND kilometers <= :kilometerMax";
        $params[':kilometerMax'] = $_GET['kilometerMax'];
    }

    // Connexion à la base de données
    include_once 'config/connectDb.php';

    // Préparation et exécution de la requête SQL
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $carsFiltred = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Formattez les résultats en HTML
    foreach ($carsFiltred as $car) {
        // Formattez chaque voiture en HTML ici
        $carResultsHTML .= '<div col-md-4 style="max-width:420px;">';
        $carResultsHTML .= '<div class="card">';
        $carResultsHTML .= '<img src="' . $car['pictureLocation'] . '" class="card-img-top" style="max-width:420px; height:270px;">';
        $carResultsHTML .= '<div class="card-body">';
        $carResultsHTML .= '<h5 class="card-title">' . $car['brand'] . ' ' . $car['model'] . '</h5>';
        $carResultsHTML .= '<p class="card-text">' . $car['description'] . '<br>' . 'Année : ' . $car['mileage'] . '<br>' . $car['kilometers'] . ' km' . '<br>' . $car['engine'] . '<br>' . 'prix : ' . $car['price'] . ' €' . '<br>' . '</p>';
        $carResultsHTML .= '<button type="button" class="btn btn-dark contact-btn" data-id="' . $car['carId'] . '">Contactez-nous</button>';
        $carResultsHTML .= '</div>';
        $carResultsHTML .= '</div>';
        $carResultsHTML .= '</div>';
        
    }
    $carResultsHTML .= '</div>';
    $carResultsHTML .= '</div>';
}


echo "<h5 class='p-3'> Résultat de la recherche : ". count($carsFiltred) . " voitures correspondantes</h5>";
echo $carResultsHTML . "</br>";
