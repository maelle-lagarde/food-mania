async function fetchData() {
    const response = await fetch('https://world.openfoodfacts.org/api/v2/search?page_size=8&page=8&sort_by=popularity&sort_by=nutriscore_score&fields=code,nutrition_grades,generic_name,image_url,product_name');
    const json = await response.json();
    
    return json.products;
}

const allProductContainer = document.querySelector('#container-product');

async function displayProducts() {
    const arrayProductFood = await fetchData();
    
    arrayProductFood.forEach(product => {
    
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

function connectionToDatabase() {
    const mysql = require('mysql');

    const connection = mysql.createConnection({
        host: $_ENV['DB_HOST'],
        user: $_ENV['DB_USER'],
        password: $_ENV['DB_PASSWORD'],
        database: $_ENV['DB_NAME']
    });
    connection.connect();
}

function addProduct() {
    buttonProduct.addEventListener("click", () => {
        addProductToDatabase({
            name: productName,
            image_url: productImage,
            generic_name: productCategorie
        }); 

        const sql = 'INSERT INTO product (name, description, image) VALUES (?, ?, ?)';
        
        connection.query(sql, (error, results, fields) => {
            if (error) throw error;
            console.log(`Produit inséré avec succès : ${product.name}`);
          }); 
    });
}

connection.end();

async function initialize() {
    await displayProducts();
}

initialize();