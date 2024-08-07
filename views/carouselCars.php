<?php
include_once (dirname(__FILE__).'/../models/Car.php');

include_once (dirname(__FILE__).'/../config/connectDb.php');

// Récupérer les cars depuis la base de données
$stmt = $pdo->query('SELECT * FROM cars');
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


  <div class="container p-3 text-center border bg-secondary" id="carouselCars">
    <h2 class="text-light"><a class="link-light link-offset-2 link-underline link-underline-opacity-0" href="../views/cars.php">Nos occasions</a></h2>
    <div id="carouselCarsControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php foreach ($cars as $index => $car): ?>
          <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>"data-bs-interval="20000">
            <div class="row justify-content-md-center">
              <div class="col-md-4">
                <div class="card">
                  <img src="<?php echo $car['pictureLocation']; ?>" class="card-img-top" alt="..." style="height:auto;">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $car['brand']." ".$car['model']; ?></h5>
                    <p class="card-text">
                      <?php echo $car['description']."<br>"."Année : ".$car['mileage']."<br>".$car['kilometers']." km"."<br>".$car['engine']."<br>"."prix : ".$car['price']." €"."<br>"; ?>
                    </p>
                    <button type="button" class="btn btn-dark contact-btn" data-id="<?php echo $car['carId']; ?>">Contactez-nous</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselCarsControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselCarsControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
 