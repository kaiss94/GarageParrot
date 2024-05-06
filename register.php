<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Garage Parrot</title>
  <link rel="icon" href="/assets/images/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
  <!-- Header -->
  <?php require_once 'header.php'; ?>


  <div class="container p-3">
    <h2>Ajouter un utilisateur</h2>
    <form action="controllers/registerPost.php" method="POST">
      <label for="name">Nom :</label>
      <input type="text" name="name" required><br><br>

      <label for="firstname">Prénom :</label>
      <input type="text" name="firstname" required><br><br>

      <label for="email">Adresse email :</label>
      <input type="email" name="email" required><br><br>

      <label for="password">Mot de passe :</label>
      <input type="password" name="password" required><br><br>

      <input type="submit" value="Ajouter utilisateur">
    </form>
  </div>

  <!-- footer -->
  <?php require_once 'footer.php'; ?>
</body>

</html>