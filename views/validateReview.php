<?php
include_once '../models/Review.php';

// Connexion à la base de données
include_once '../config/connectDbAdmin.php';
try {
  $pdo = new PDO($dsn, $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Erreur de connexion : ' . $e->getMessage();
  exit();
}

// Traitement de la validation ou suppression des avis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review_id']) && isset($_POST['action'])) {
  $review_id = $_POST['review_id'];
  $action = $_POST['action'];
  if ($action === 'validate') {
    // Mettre à jour la base de données pour marquer l'avis comme validé
    $stmt = $pdo->prepare('UPDATE reviews SET validated = 1 WHERE reviewId = :review_id');
    $stmt->execute(['review_id' => $review_id]);
  } elseif ($action === 'delete') {
    // Supprimer l'avis de la base de données
    $stmt = $pdo->prepare('DELETE FROM reviews WHERE reviewId = :review_id');
    $stmt->execute(['review_id' => $review_id]);
  }
}


// Récupérer les reviews non validés depuis la base de données
$stmt = $pdo->query('SELECT * FROM reviews WHERE validated = 0');
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

//convertir les notes en étoiles
function stars($rate)
{
  switch ($rate) {
    case 1:
      echo "★";
      break;
    case 2:
      echo "★★";
      break;
    case 3:
      echo "★★★";
      break;
    case 4:
      echo "★★★★";
      break;
    case 5:
      echo "★★★★★";
      break;
    default:
      break;
  }
}
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

  <main class="container-fluid">


    <div class="container p-3 text-center">
      <h2>Liste des avis à valider</h2>
      <div class="row">
        <?php foreach ($reviews as $review) : ?>
          <div class="col-md-4 p-2">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title text-danger"><?php echo $review['clientName']; ?></h5>
                <p class="card-text text-warning"><?php stars($review['rate']); ?></p>
                <p class="card-text"><?php echo $review['comment']; ?></p>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                  <input type="hidden" name="review_id" value="<?php echo $review['reviewId']; ?>">
                  <button type="submit" name="action" value="validate" class="btn btn-dark">Valider</button>
                  <button type="submit" name="action" value="delete" class="btn btn-danger">Supprimer</button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

  </main>

</body>

</html>