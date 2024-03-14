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
        
        const divParent = document.createElement('div');
        divParent.className = "div-product";

        const newHeading = document.createElement('h2');
        newHeading.textContent = productName;

        const newImage = document.createElement('img');
        newImage.src = productImage;

        const newCategorie = document.createElement('p');
        newCategorie.textContent = productCategorie;

        divParent.appendChild(newHeading);
        divParent.appendChild(newImage);
        divParent.appendChild(newCategorie);

        allProductContainer.appendChild(divParent);
    });
}

fetchData();
displayProducts();