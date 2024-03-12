// Fonction pour récupérer les données à partir de l'URL
function fetchData() {
  fetch('https://world.openfoodfacts.org/api/v2/product/3017624010701?fields=product_name,nutriscore_data')
      .then(response => response.json())
      .then(data => {
          // Appel de la fonction pour afficher les données
          displayData(data);
      })
      .catch(error => console.error('Error fetching data:', error));
}

// Fonction pour afficher les données dans le tableau HTML
function displayData(data) {
  const tableBody = document.getElementById('data-body');

  // Pour chaque produit, ajoute une ligne dans le tbody
  data.forEach(product => {
      // Crée une ligne HTML avec les données du produit
      const row = `
          <tr>
              <td>${product.product_name}</td>
              <td>${JSON.stringify(product.nutriscore_data)}</td>
          </tr>
      `;

      // Ajoute la ligne au tbody
      tableBody.innerHTML += row;
  });
}

// Appel de la fonction pour récupérer les données lors du chargement de la page
fetchData();