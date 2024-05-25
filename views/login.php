<?php
session_start();
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Garage Parrot - Page de Connexion</title>
  <link rel="icon" href="../assets/images/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
  <!--Header-->
  <?php require_once 'header.php'; ?>

  <div class="container p-3">
    <h1>Connexion</h1>
    <form action="../controllers/loginPost.php" method="POST">
      <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
      <label for="email" class="form-label">Adresse email :</label>
      <input type="email" name="email" class="form-control" required /> <br><br>

      <label for="password" class="form-label">Mot de passe :</label>
      <input type="password" name="password" class="form-control" required /> <br><br>

      <input type="submit" value="Se connecter" class="btn btn-dark" />
    </form>
  </div>

  <!-- Footer -->
  <?php require_once 'footer.php'; ?>
</body>
</html>
