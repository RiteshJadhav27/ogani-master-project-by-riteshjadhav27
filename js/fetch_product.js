
document.addEventListener("DOMContentLoaded", fetchProducts);

function fetchProducts() {
    fetch('./Backend/fetch_products.php') // Fetch products from backend
    .then(response => response.json())
    .then(products => {
        let productContainer = document.getElementById("product-container");
        productContainer.innerHTML = ""; // Clear previous products

        products.forEach(product => {
            let productHTML = `
                <div class="col-lg-3 col-md-4 col-sm-6 mix ${product.category.toLowerCase()}">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" style="background-image: url('${product.image ? './img/uploads/' + product.image : './img/placeholder.jpg'}');">
                            <ul class="featured__item__pic__hover">
                                <li><button><i class="fa fa-heart"></i></button></li>
                                <li><button><i class="fa fa-retweet"></i></button></li>
                                <li>
                                    <button class="add-to-cart" onclick="addToCart(${product.id}, '${product.name}', ${product.price}, '${product.image ? './img/uploads/' + product.image : './img/placeholder.jpg'}', 1)">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">${product.name}</a></h6>
                            <h5>₹${product.price.toFixed(2)}</h5>
                        </div>
                    </div>
                </div>
            `;
            productContainer.innerHTML += productHTML;
        });
    })
    .catch(error => console.error("Error fetching products:", error));
}
