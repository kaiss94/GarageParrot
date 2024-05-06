<?php
include_once 'models/Hours.php';

// Connexion à la base de données avec les droits admin
include_once 'connectDbAdmin.php';

// Récupérer les cars depuis la base de données
$stmt = $pdo->query('SELECT * FROM openinghours');
$horaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($horaires as $horaire) {
  $lundiAuVendredi = $horaire['lundiAuVendredi'];
  $samedi = $horaire['samedi'];
  $dimanche = $horaire['dimanche'];
}


?>

<footer class="container bg-danger p-3">

  <div class="row align-items-center text-light">

    <div class="col-md-4 col-sm-12 mb-3">
      <h4 class="text-center">Nos horaires :</h4>
      <div class="row">
        <div class="col-12">
          <p>Du Lundi au Vendredi : <?php echo $lundiAuVendredi ?></p>
          <p>Samedi : <?php echo $samedi ?></p>
          <p>Dimanche : <?php echo $dimanche ?></p>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-12 mb-3 text-center">
      <h4>Adresse :</h4>
      <p>5 rue de la ferme</p>
      <p>31000 Toulouse</p>
      <p>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
          <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"></path>
        </svg><a href="tel:0401020304" class="link-light">04 01 02 03 04</a>
      </p>
      <p>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
          <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"></path>
        </svg><a href="mailto:contact@mongarage.com" class="link-light">contact@mongarage.com</a>
      </p>
    </div>

    <div class="col-md-4 col-sm-12 text-center">
      <a href="index.php" class="d-inline-flex">
        <img src="assets/images/logoSVG.svg" class="img-fluid" alt="logo">
      </a>
    </div>

  </div>
</footer>