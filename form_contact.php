<div class="container p-3 border bg-secondary text-light">
    <h2>Contactez-nous</h2>
    <form id="contact-form" action="contact.php" method="post">
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


<script>
    //écouteur boutons de contact voitures
    const contactButtons = document.querySelectorAll('.contact-btn');

    contactButtons.forEach(button => {
        button.addEventListener('click', () => {
            const carId = "Demande de renseignement réf. voiture : #" + button.getAttribute('data-id');
            // Préremplir le formulaire avec l'ID de la voiture
            document.getElementById('carIdInput').value = carId;

            // Faire défiler la page jusqu'au formulaire
            document.getElementById('contact-form').scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    //écouteur boutons de contact services
    const contactButtonsServices = document.querySelectorAll('.contact-btn-services');

    contactButtonsServices.forEach(button => {
        button.addEventListener('click', () => {
            const serviceId = "Demande de renseignement pour le service : " + button.getAttribute('name') + ".";
            // Préremplir le formulaire avec l'ID du service
            document.getElementById('carIdInput').value = serviceId;

            // Faire défiler la page jusqu'au formulaire
            document.getElementById('contact-form').scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>