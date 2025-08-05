// script.js
async function fetchProducts() {
    const response = await fetch('fetch_products.php'); // Create this PHP file to fetch products
    const products = await response.json();
    const productDiv = document.getElementById('products');

    products.forEach(product => {
        const productElement = document.createElement('div');
        productElement.innerHTML = `
            <h3>${product.name}</h3>
            <p>Price: $${product.price}</p>
            <input type="number" id="quantity-${product.id}" value="1" min="1">
            <button onclick="addToCart(${product.id})">Add to Cart</button>
        `;
        productDiv.appendChild(productElement);
    });
}

async function addToCart(productId) {
    const quantity = document.getElementById(`quantity-${productId}`).value;
    const formData = new FormData();
    formData.append('product_id', productId);
    formData.append('quantity', quantity);

    const response = await fetch('add_to_cart.php', {
        method: 'POST',
        body: formData
    });
    const result = await response.json();
    alert(result.success ? 'Product added to cart!' : result.error);
}

window.onload = fetchProducts;
