<?php
include_once 'models/Service.php';
include_once 'config/connectDb.php';


// Récupérer les services depuis la base de données
$stmt = $pdo->query('SELECT * FROM services');
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


  <div class="container p-3 text-center border">
    <h2>Découvrez nos prestations</h2>
    <div id="carouselServicesControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php foreach ($services as $index => $service): ?>
          <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
            <div class="row justify-content-md-center">
              <div class="col-md-4">
                <div class="card" style="height: 28rem;">
                  <img src="<?php echo $service['location']; ?>" class="card-img-top" alt="">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $service['serviceName']; ?></h5>
                    <p class="card-text"><?php echo $service['description']; ?></p>
                    <button type="button" class="btn btn-dark contact-btn-services" data-id="<?php echo $service['serviceId']; ?>" name="<?php echo $service['serviceName']; ?>">Contactez-nous</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselServicesControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselServicesControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>