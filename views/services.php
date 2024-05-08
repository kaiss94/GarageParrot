<?php
session_start();

include_once '../models/Service.php';

// Connexion à la base de données
include_once '../config/connectDbAdmin.php';


// Traitement de la suppression du service
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['serviceId']) && isset($_POST['action'])) {
  $serviceId = $_POST['serviceId'];
  $action = $_POST['action'];
  if ($action === 'delete') {
    // On vérifie si l'utilisateur a confirmé la suppression
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] === 'yes') {
      // Requête SQL pour récupérer le nom du fichier image associé au service
      $stmt_select_image = $pdo->prepare('SELECT location FROM services WHERE serviceId = :serviceId');
      $stmt_select_image->execute(['serviceId' => $serviceId]);
      $image_location = $stmt_select_image->fetchColumn();

      // On suprime le fichier image du serveur s'il existe
      if (file_exists($image_location)) {
        unlink($image_location); // Supprime le fichier
      }

      // Supprimer le service de la base de données pour le service
      $stmt_delete_service = $pdo->prepare('DELETE FROM services WHERE serviceId = :serviceId');
      $stmt_delete_service->execute(['serviceId' => $serviceId]);
    } else {
      // Redirection
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit;
    }
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
  <link rel="icon" href="../assets/images/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../assets/css/style.css">
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
                <button type="button" class="btn btn-dark contact-btn-services" data-id="<?php echo $service['serviceId']; ?>" name="<?php echo $service['serviceName']; ?>">Contactez-nous</button>
              <?php } else { ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                  <input type="hidden" name="serviceId" value="<?php echo $service['serviceId']; ?>">
                  <button type="button" class="btn btn-danger delete-btn" data-id="<?php echo $service['serviceId']; ?>">Supprimer</button>
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

  <!-- Script pour la confirmation de suppression -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const deleteButtons = document.querySelectorAll('.delete-btn');
      deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
          const confirmDelete = confirm('Voulez-vous vraiment supprimer ce service ?');
          if (confirmDelete) {
            // Si l'utilisateur confirme, on soummet le formulaire de suppression
            const form = button.parentElement;
            form.innerHTML += '<input type="hidden" name="action" value="delete">';
            form.innerHTML += '<input type="hidden" name="confirm_delete" value="yes">';
            form.submit();
          }
        });
      });
    });
  </script>

</body>

</html>
