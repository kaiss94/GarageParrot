<?php
session_start();

include_once 'models/Car.php';


// Connexion à la base de données
include_once 'connectDbAdmin.php';

// Traitement de la suppression de la voiture
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['carId']) && isset($_POST['action'])) {
  $carId = $_POST['carId'];
  $action = $_POST['action'];
  if ($action === 'delete') {
    $stmt = $pdo->prepare('DELETE FROM cars WHERE carId = :carId');
    $stmt->execute(['carId' => $carId]);
  }
}

// Récupérer les cars depuis la base de données
$stmt = $pdo->query('SELECT * FROM cars');
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

// On détermine sur quelle page on se trouve
if (isset($_GET['page']) && !empty($_GET['page'])) {
  $currentPage = (int) strip_tags($_GET['page']); //on évite les injection de scripts
} else {
  $currentPage = 1;
}

// nombre total de voitures
$totalCars = (int) count($cars);

// nombre de voitures par page
$carsPerPage = 6;

// nombre de pages total
$pages = ceil($totalCars / $carsPerPage); //on arrondit au supérieur

//calcul de chaque première voiture affichée par page
$firstCarPage = ($currentPage * $carsPerPage) - $carsPerPage;

//on prépare la requête 
$sql = 'SELECT * FROM `cars` LIMIT :firstCarPage, :carsPerPage;';

$query = $pdo->prepare($sql);
$query->bindValue(':firstCarPage', $firstCarPage, PDO::PARAM_INT);
$query->bindValue(':carsPerPage', $carsPerPage, PDO::PARAM_INT);
$query->execute();

$carsToShow = $query->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Voitures d'occasion Garage Parrot</title>
  <link rel="icon" href="/assets/images/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <!-- Header -->
  <?php require_once 'header.php'; ?>

  <!-- Container de la page-->
  <div class="container p-3">

    <!-- Formulaire de filtre -->
    <div class="row m-auto">
      <div class="container p-3">
        <h1>Nos Occasions</h1>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="row g-3 align-items-center p-2">
            <div class="col-sm-2">
              <label for="kilometerMin" class="col-form-label">km min :</label>
            </div>
            <div class="col-sm-2">
              <input type="text" id="kilometerMin" name="kilometerMin" class="form-control">
            </div>
            <div class="col-sm-2">
              <label for="kilometerMax" class="col-form-label">km max :</label>
            </div>
            <div class="col-sm-2">
              <input type="text" id="kilometerMax" name="kilometerMax" class="form-control">
            </div>
          </div>

          <div class="row g-3 align-items-center p-2">
            <div class="col-sm-2">
              <label for="priceMin" class="col-form-label">prix min :</label>
            </div>
            <div class="col-sm-2">
              <input type="text" id="priceMin" name="priceMin" class="form-control">
            </div>
            <div class="col-sm-2">
              <label for="priceMax" class="col-form-label">prix max :</label>
            </div>
            <div class="col-sm-2">
              <input type="text" id="priceMax" name="priceMax" class="form-control">
            </div>
          </div>

          <div class="row g-3 align-items-center p-2">
            <div class="col-sm-2">
              <label for="mileageMin" class="col-form-label">Année min :</label>
            </div>
            <div class="col-sm-2">
              <input type="text" id="mileageMin" name="mileageMin" class="form-control">
            </div>
            <div class="col-sm-2">
              <label for="mileageMax" class="col-form-label">Année max :</label>
            </div>
            <div class="col-sm-2">
              <input type="text" id="mileageMax" name="mileageMax" class="form-control">
            </div>
          </div>

          <button type="submit" class="btn btn-dark" id="boutonFilter">Rechercher</button>

        </form>
      </div>
    </div>

    <!-- Résultat de la recherche-->
    <div class="row bg-danger text-white">
      <div class="container">
        <div class="row">
          <div id="carResults"></div>
        </div>
      </div>
    </div>

    <!-- Container cars -->
    <div class="row py-3">
      <h4>Toutes nos voitures</h4>
      <div class="container">
        <div class="row g-3 align-items-center">
          <?php foreach ($carsToShow as $car) : ?>
            <div class="col-md-4 p-2">
              <div class="card">
                <img src="<?php echo $car['pictureLocation']; ?>" class="card-img-top" alt="..." style="height:270px;">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $car['brand'] . " " . $car['model']; ?></h5>
                  <p class="card-text">
                    <?php echo $car['description'] . "<br>" . "Année : " . $car['mileage'] . "<br>" . $car['kilometers'] . " km" . "<br>" . $car['engine'] . "<br>" . "prix : " . $car['price'] . " €" . "<br>"; ?>
                  </p>
                  <?php if (!isset($_SESSION['role'])) {  ?>
                    <button type="button" class="btn btn-dark contact-btn" data-id="<?php echo $car['carId']; ?>">Contactez-nous</button>
                  <?php } else { ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                      <input type="hidden" name="carId" value="<?php echo $car['carId']; ?>">
                      <button type="submit" name="action" value="delete" class="btn btn-danger">Supprimer</button>
                    </form>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <!-- Pagination Bootstrap -->
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
            <a class="page-link" href="?page=<?= $currentPage - 1 ?>">Précédent</a>
          </li>
          <?php for ($page = 1; $page <= $pages; $page++) : ?>
            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
              <a class="page-link" href="?page=<?= $page ?>"><?= $page ?></a>
            </li>
          <?php endfor ?>
          <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
            <a class="page-link" href="?page=<?= $currentPage + 1 ?>">Suivant</a>
          </li>
        </ul>
      </nav>


    </div>
  </div>



  <!-- Conteneur formulaire de contact -->
  <?php require_once 'form_contact.php'; ?>

  <script src="scripts/filtre_cars.js"></script>

  <!-- Footer -->
  <?php require_once 'footer.php'; ?>




</body>

</html>