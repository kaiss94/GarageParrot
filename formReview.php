<div class="container p-3 border">
  <div class="row">

    <div class="col-sm-3 bg-light rounded">
      <form action="add_review.php" method="post" enctype="multipart/form-data">
        <label for="clientName" class="form-label">Nom : </label>
        <input type="text" id="clientName" name="clientName" class="form-control" required>

        <label for="comment" class="form-label">Commentaires :</label>
        <textarea id="comment" name="comment" rows="4" class="form-control" required></textarea>

        <label for="rate" class="form-label">Notez nous :</label>
        <select class="form-select" aria-label="Default select example" id="rate" name="rate" required>
          <option selected>Choisissez</option>
          <option value="1" style="color: #FFD700;">★</option>
          <option value="2" style="color: #FFD700;">★★</option>
          <option value="3" style="color: #FFD700;">★★★</option>
          <option value="4" style="color: #FFD700;">★★★★</option>
          <option value="5" style="color: #FFD700;">★★★★★</option>
        </select><br>

        <label for="date" class="form-label">Date : </label>
        <input type="date" id="date" name="date" class="form-control" required>

        <button type="submit" class="btn btn-dark my-3">Envoyez votre avis</button>
      </form>
    </div>

    <!-- Conteneur Avis -->
    <div class="col-sm-9">
      <?php require_once 'reviews.php'; ?>
    </div>

  </div>
</div>