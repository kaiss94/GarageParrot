<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>


<header class="container bg-danger p-3">
  <div id="logo" class="d-flex flex-column m-3 text-center">
    <a href="#"><img src="assets/images/logoSVG.svg" alt="logo" width="200" height="150"></a>
  </div>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <button id="boutonMenu" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-light active" aria-current="page" href="index.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="services.php">Prestations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="cars.php">Voitures d'occasion</a>
          </li>
          <?php if (!isset($_SESSION['role'])) {  ?>
            <li class="nav-item">
              <a class="nav-link text-light" href="login.php">Connexion</a>
            </li>
          <?php } else { ?>
            <li class="nav-item">
              <a class="nav-link text-light" href="admin.php">Administration</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="logout.php">Déconnexion</a>
            </li>
          <?php } ?>

        </ul>
      </div>
    </div>
  </nav>
</header>