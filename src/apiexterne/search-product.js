async function fetchData() {
    const response = await fetch('https://world.openfoodfacts.org/api/v2/search?page_size=24&sort_by=popularity&fields=generic_name,image_url,product_name');
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
        buttonProduct.className = 'add-product-btn';

        divParent.appendChild(newHeading);
        divParent.appendChild(newImage);
        divParent.appendChild(newCategorie);
        divParent.appendChild(buttonProduct);

        allProductContainer.appendChild(divParent);

    });
}


async function initialize() {
    await displayProducts();

    let allProduct = document.getElementsByClassName('div-product')
    
    for (const button of allProduct) {
        console.log(button.childNodes[3])
        // let test = button.chil
        button.childNodes[3].addEventListener('click', () => {

            let name = button.childNodes[0].textContent;
            let image = button.childNodes[1].src;
            let description = button.childNodes[2].textContent;

            postProduct(name,image,description)
        }
        )
    }
}

async function postProduct(name,image,description){
    let formData = new FormData()

            formData.append('name', name)
            formData.append('image', image)
            formData.append('description', description)

            let result = await fetch('http://localhost:8888/food-mania/my-products',{
                method:"POST",
                body: formData
            })

            let response = await result.text()
}

initialize();