<?php
include_once 'Service.php';

// Connexion à la base de données
include_once 'connectDbAdmin.php';

try {
  $pdo = new PDO($dsn, $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Erreur de connexion : ' . $e->getMessage();
  exit();
}

// Traitement de la suppression du service
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['serviceId']) && isset($_POST['action'])) {
  $serviceId = $_POST['serviceId'];
  $action = $_POST['action'];
  if ($action === 'delete') {
    $stmt = $pdo->prepare('DELETE FROM services WHERE serviceId = :serviceId');
    $stmt->execute(['serviceId' => $serviceId]);
  }
}

// Récupérer les services depuis la base de données
$stmt = $pdo->query('SELECT * FROM services');
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Services Garage</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
  <!-- Header -->
  <?php require_once 'header.php'; ?>

  <!-- Container Services -->
  <div class="container">
    <h1>Nos prestations</h1>
    <div class="row">
      <?php foreach ($services as $service) : ?>
        <div class="col-md-4 p-2">
          <div class="card" style="height: 28rem;">
            <img src="<?php echo $service['location']; ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $service['serviceName']; ?></h5>
              <p class="card-text"><?php echo $service['description']; ?></p>
              <?php if (!isset($_SESSION['role'])) {  ?>
              <button type="button" class="btn btn-dark contact-btn-services" data-id="<?php echo $service['serviceId']; ?>">Contactez-nous</button>
              <?php } else { ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                  <input type="hidden" name="service_id" value="<?php echo $service['serviceId']; ?>">
                  <button type="submit" name="action" value="delete" class="btn btn-danger">Supprimer</button>
                </form>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Conteneur formulaire de contact -->
  <?php require_once 'form_contact.php'; ?>

  <!-- Footer -->
  <?php require_once 'footer.php'; ?>

</body>

</html>