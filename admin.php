<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Garage Parrot</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <!-- Header -->
  <?php require_once 'header.php'; ?>

  <main class="container-fluid">


    <!-- Profil admin -->
    <h2> Panneau administrateur </h2>
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {  ?>
      <nav aria-label="">
        <ul>
          <a href="register.php">
            <li>Gestion des utilisateurs</li>
          </a>
          <a href="formService.php">
            <li>Ajouter des services</li>
          </a>
          <a href="services.php">
            <li>Supprimer des services</li>
          </a>
          <a href="formCar.php">
            <li>Ajouter des voitures</li>
          </a>
          <a href="cars.php">
            <li>Supprimer des voitures</li>
          </a>
          <a href="formHours.php">
            <li>Gestion des horaires</li>
          </a>
          <p> Vous êtes connecté en tant qu'<?php echo $_SESSION['role'] ?> </p>
        </ul>
      </nav>
    <?php } ?>

    <!-- Profil admin -->
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee') {  ?>
      <nav aria-label="">
        <ul>
        <a href="messages.php">
            <li>Messagerie</li>
          </a>
          <a href="formCar.php">
            <li>Ajouter des voitures</li>
          </a>
          <a href="cars.php">
            <li>Supprimer des voitures</li>
          </a>
          <a href="validateReview.php">
            <li>Gestion des avis clients</li>
          </a>
          <p> Vous êtes connecté en tant qu'<?php echo $_SESSION['role'] ?></p>
        </ul>
      </nav>
    <?php } ?>

  </main>


  <!-- Footer -->
  <?php require_once 'footer.php'; ?>

</body>

</html>