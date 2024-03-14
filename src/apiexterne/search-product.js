async function fetchData() {
    const response = await fetch('https://world.openfoodfacts.org/api/v2/search?page_size=8&page=8&sort_by=popularity&sort_by=nutriscore_score&fields=code,nutrition_grades,generic_name,image_url,product_name');
    const json = await response.json();
    console.log(json.products);
    return json.products;
}


const allProductContainer = document.querySelector('#container-product');

async function displayProducts() {
    const arrayProductFood = await fetchData();
    
    arrayProductFood.forEach(product => {
        console.log(product);
        const productName = product.product_name;
        const productImage = product.image_url;
        const productCategorie = product.generic_name;
        
        const divParent = document.createElement('div');
        divParent.className = "div-product";

        const newHeading = document.createElement('h2');
        newHeading.textContent = productName;

        const newImage = document.createElement('img');
        newImage.src = productImage;

        const newCategorie = document.createElement('p');
        newCategorie.textContent = productCategorie;

        const buttonProduct = document.createElement('button');
        buttonProduct.innerHTML = 'add';

        divParent.appendChild(newHeading);
        divParent.appendChild(newImage);
        divParent.appendChild(newCategorie);
        divParent.appendChild(buttonProduct);

        allProductContainer.appendChild(divParent);
    });
}

async function initialize() {
    await displayProducts();
}

initialize();

console.log('hello baby')