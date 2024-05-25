function addContactButtonListenersCars() {
  // écouteur boutons de contact voitures
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
}

function addContactButtonListenersServices() {
  // écouteur boutons de contact services
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
}
addContactButtonListenersCars();
addContactButtonListenersServices();
