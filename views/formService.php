<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Garage Parrot</title>
  <link rel="icon" href="../assets/images/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
  
  <!-- Header -->
  <?php require_once 'header.php'; ?>

  <main>

    <div class="container p-3">
      <form action="../controllers/add_service.php" method="post" enctype="multipart/form-data">
        <label for="serviceName" class="form-label">Nom du service :</label>
        <input type="text" id="serviceName" name="serviceName" class="form-control" required>

        <label for="serviceDescription" class="form-label">Description du service :</label>
        <textarea id="serviceDescription" name="serviceDescription" rows="4" class="form-control" required></textarea>

        <label for="serviceImage" class="form-label">Image du service :</label>
        <input type="file" id="serviceImage" name="serviceImage" accept="image/*" required>

        <button type="submit" class="btn btn-dark">Ajouter Service</button>
      </form>
    </div>


  </main>


  <!-- Footer -->
  <?php require_once 'footer.php'; ?>

</body>

</html>