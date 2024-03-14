// https://world.openfoodfacts.org/api/v2/product/3017624010701?fields=product_name,nutriscore_data,image_url

async function fetchData() {
    const response = await fetch('https://world.openfoodfacts.org/api/v2/search?page_size=8&page=8&sort_by=popularity&fields=code,nutrition_grades,categories_tags_en,image_url,product_name');
    const json = await response.json();
    
    return json.products;
}

const allProductContainer = document.querySelector('#container-product');

async function displayProducts() {
    const arrayProductFood = await fetchData();
    
    arrayProductFood.forEach(product => {

        const productName = product.product_name;
        const productImage = product.image_url;
        const productCategorie = product.categories_tags_en;

        const newHeading = document.createElement('h2');
        const newImage = document.createElement('img');
        const newCategorie = document.createElement('p');

        newHeading.textContent = productName;
        newImage.src = productImage;
        newCategorie.textContent = productCategorie;

        allProductContainer.appendChild(newHeading);
        allProductContainer.appendChild(newImage);
        allProductContainer.appendChild(newCategorie);
    });
}

fetchData();
displayProducts();