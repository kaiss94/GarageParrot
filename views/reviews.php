<?php
include_once '../models/Review.php';

// Connexion à la base de données
include_once '../config/connectDb.php';

// Récupérer les reviews validés depuis la base de données
$stmt = $pdo->query('SELECT * FROM reviews WHERE validated=1');
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


<div class="container p-3 text-center">
  <h2>Vos appréciations</h2>
  <div class="row">
    <?php foreach ($reviews as $review) : ?>
      <div class="col-md-4 p-2">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-danger"><?php echo $review['clientName']; ?></h5>
            <p class="card-text text-warning"><?php stars($review['rate']); ?></p>
            <p class="card-text"><?php echo $review['comment']; ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>