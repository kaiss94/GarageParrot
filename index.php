<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Garage Parrot</title>
  <link rel="icon" href="/assets/images/favicon.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <!-- Header -->
  <?php require_once 'header.php'; ?>

  <main class="container-fluid">

    <!-- Conteneur présentation des services -->
    <?php require_once 'carouselServices.php'; ?>

    <!-- Conteneur présentation des voitures -->
    <?php require_once 'carouselCars.php'; ?>

    <!-- Conteneur formulaire des avis clients -->
    <?php require_once 'formReview.php'; ?>

    <!-- Conteneur formulaire de contact -->
    <?php require_once 'form_contact.php'; ?>




  </main>


  <!-- Footer -->
  <?php require_once 'footer.php'; ?>

</body>

</html>