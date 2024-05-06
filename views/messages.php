<?php

// Connexion à la base de données
include_once '../config/connectDbAdmin.php';

try {
  $pdo = new PDO($dsn, $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Récupération des messages depuis la table contact
  $stmt = $pdo->query('SELECT * FROM contact');
  $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  // En cas d'erreur de connexion ou de requête
  echo "Erreur : " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["message_id"])) {
  // Récupérer l'ID du message à supprimer
  $message_id = $_POST["message_id"];
  $stmt = $pdo->prepare('DELETE FROM contact WHERE id = :id');
  $stmt->execute(['id' => $message_id]);


  // Redirection vers la même page après la suppression
  header("Location: " . $_SERVER["PHP_SELF"]);
  exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Services Garage</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <!-- Header -->
  <?php require_once 'header.php'; ?>

  <div class="container p-3">
    <h3>Messagerie</h3>
    <?php foreach ($messages as $message) { ?>
      <div class="card">
        <div class="card-body">
          <p class="card-title">Nom : <?php echo $message['name']; ?></p>
          <p class="card-text">Prénom : <?php echo $message['firstname']; ?></p>
          <p class="card-text">Email : <?php echo $message['email']; ?></p>
          <p class="card-text">Téléphone : <?php echo $message['phone']; ?></p>
          <p class="card-text">Message : <?php echo $message['message']; ?></p>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
            <button type="submit" class="btn btn-danger">Supprimer</button>
          </form>
        </div>
      </div>
    <?php } ?>
  </div>

  <!-- footer -->
  <?php require_once 'footer.php'; ?>

</body>

</html>