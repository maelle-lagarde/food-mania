// https://world.openfoodfacts.org/api/v2/product/3017624010701?fields=product_name,nutriscore_data,image_url

async function fetchData() {
    const response = await fetch('https://world.openfoodfacts.org/api/v2/search?page_size=8&page=8&sort_by=popularity&fields=code,nutrition_grades,categories_tags_en,image_url,product_name');
    const json = await response.json();
    
    return json.products;
}

const allProduct = document.querySelector('#all-product');
console.log(allProduct);

async function displayProducts() {
    const arrayProductFood = await fetchData();
    
    arrayProductFood.forEach(product => {
        console.log(product);
    });
}

displayProducts();


// function displayData(data) {
    
//     const dataName = document.getElementById('data-name');
//     const dataInfo = document.getElementById('data-info');

//     data.forEach(product => {
//         dataName.innerText = product.product_name;
//         dataInfo.innerText = product.nutriscore_name;

//     });
// }

// let allProduct = fetchData();

// if(allProduct != undefined)
// {
//     showData(allProduct);
// }

// function showData(toto){

//     /// cibler la bonne div
   



// }
fetchData();