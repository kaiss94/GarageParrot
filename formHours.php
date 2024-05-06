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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <!-- Header -->
  <?php require_once 'header.php'; ?>

  <div class="container p-3 border">
    <div class="row">

      <div class="col-3">
        <form action="openingHours.php" method="post" enctype="multipart/form-data">
          <label for="lundiAuVendredi" class="form-label">Du lundi au vendredi : </label>
          <input type="text" id="lundiAuVendredi" name="lundiAuVendredi" class="form-control" required>

          <label for="samedi" class="form-label">Samedi : </label>
          <input type="text" id="samedi" name="samedi" class="form-control" required>

          <label for="dimanche" class="form-label">Dimanche : </label>
          <input type="text" id="dimanche" name="dimanche" class="form-control" required>

          <button type="submit" class="btn btn-dark">Modifier les horaires</button>
        </form>
      </div>


    </div>
  </div>
</body>