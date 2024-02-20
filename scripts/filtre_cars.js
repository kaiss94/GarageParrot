//Gestion du filtre voiture
const boutonFilter = document.getElementById("boutonFilter");

boutonFilter.addEventListener("click", (event) => {
  event.preventDefault(); // Éviter que la page ne recharge

  // Récupérer les valeurs des champs de formulaire
  const formData = new FormData(document.querySelector("form"));

  // Créer une URL avec les paramètres de requête
  const url = 'filter_cars.php';

  // Créer une requête XMLHttpRequest
  const xhr = new XMLHttpRequest();

  xhr.open('GET', url + '?' + new URLSearchParams(formData).toString());

  // Gérer la réponse de la requête
  xhr.onload = function () {
    if (xhr.status === 200) {
      // Mettre à jour la zone d'affichage des résultats avec les nouvelles données
      document.getElementById('carResults').innerHTML = xhr.responseText;
    } else {
      // Gérer les erreurs de requête
      console.error('Erreur lors de la récupération des données : ' + xhr.status);
    }
  };

  // Envoyer la requête
  xhr.send();
});


