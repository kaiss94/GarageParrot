<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Garage Parrot</title>
  <link rel="icon" href="../assets/images/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <!-- Header -->
  <?php require_once 'header.php'; ?>

  <main>

    <div class="container p-3">
      <h2>Ajouter une voiture</h2>
      <form action="../controllers/add_car.php" method="post" enctype="multipart/form-data">
        <label for="brand" class="form-label">Marque :</label>
        <input type="text" class="form-control" id="brand" name="brand" required><br>

        <label for="model" class="form-label">Modèle :</label>
        <input type="text" class="form-control" id="model" name="model" required><br>

        <label for="mileage" class="form-label">Année :</label>
        <input type="number" class="form-control" id="mileage" name="mileage" required><br>

        <label for="kilometers" class="form-label">Kilométrage :</label>
        <input type="number" class="form-control" id="kilometers" name="kilometers" required><br>

        <label for="price" class="form-label">Prix :</label>
        <input type="number" class="form-control" id="price" name="price" required><br>

        <label for="engine" class="form-label">Moteur :</label>
        <select class="form-select" aria-label="Default select example" id="engine" name="engine" required>
          <option selected>Choisissez</option>
          <option value="DIESEL">DIESEL</option>
          <option value="ESSENCE">ESSENCE</option>
          <option value="HYBRIDE">HYBRIDE</option>
          <option value="ELECTRIQUE">ELECTRIQUE</option>
        </select><br>

        <label for="description" class="form-label">Description :</label><br>
        <textarea id="description" name="description" class="form-control" required></textarea><br>

        <label for="carImage" class="form-label">Photo de la voiture :</label>
        <input type="file" id="carImage" name="carImage" accept="image/*" class="form-control" required><br>

        <button type="submit" class="btn btn-dark">Ajouter voiture</button>
      </form>
    </div>

  </main>


  <!-- Footer -->
  <?php require_once 'footer.php'; ?>

</body>

</html>