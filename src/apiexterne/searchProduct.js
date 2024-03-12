function fetchData() {
  fetch('https://world.openfoodfacts.org/api/v2/product/3017624010701?fields=product_name,nutriscore_data')
      .then(response => response.json())
      .then(data => {

        displayData(data);
      })
      .catch(error => console.error('Error fetching data:', error));
}

function displayData(data) {
  const tableBody = document.getElementById('data-body');

  data.forEach(product => {

    const row = `
          <tr>
              <td>${product.product_name}</td>
              <td>${JSON.stringify(product.nutriscore_data)}</td>
          </tr>
      `;

      tableBody.innerHTML += row;
  });
}

fetchData();