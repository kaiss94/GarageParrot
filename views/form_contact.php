<div class="container p-3 border bg-secondary text-light">
    <h2>Contactez-nous</h2>
    <form id="contact-form" action="../controllers/contact.php" method="post">
        <label for="name" class="form-label">Nom :</label>
        <input type="text" class="form-control" id="name" name="name" required><br>

        <label for="firstname" class="form-label">Prénom :</label>
        <input type="text" class="form-control" id="firstname" name="firstname" required><br>

        <label for="email" class="form-label">E-mail :</label>
        <input type="email" class="form-control" id="email" name="email" required><br>

        <label for="phone" class="form-label">Tel :</label>
        <input type="tel" class="form-control" id="phone" name="phone" required><br>

        <label for="message" class="form-label">Message :</label><br>
        <textarea id="carIdInput" name="message" class="form-control" required></textarea><br>


        <button type="submit" class="btn btn-dark">ENVOYER</button>
    </form>
</div>

  <!-- Alerte demande envoyée -->
  <?php if (isset($_GET['addedContact']) && $_GET['addedContact'] == 'true') : ?>
    <script>
      alert('Demande de renseignement envoyée !');
    </script>
  <?php endif; ?>


<script src="../scripts/contact.js"></script>