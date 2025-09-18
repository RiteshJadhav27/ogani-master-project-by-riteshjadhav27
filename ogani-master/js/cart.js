// document.addEventListener('DOMContentLoaded', () => {
//     displayCartItems();

//     // Checkout button event listener
//     const checkoutBtn = document.getElementById('checkout-btn');
//     if (checkoutBtn) {
//         checkoutBtn.addEventListener('click', proceedToCheckout);
//     }
// });

// // Function to add an item to the cart
// function addToCart(productId, productName, productPrice, productImage, quantity) {
//     let cart = JSON.parse(localStorage.getItem('cart')) || [];

//     // Convert productId to string for consistent comparison
//     productId = String(productId);

//     // Check if the product already exists in the cart
//     const existingProduct = cart.find(item => item.productId === productId);
//     if (existingProduct) {
//         existingProduct.quantity += quantity;
//     } else {
//         cart.push({
//             productId,
//             productName,
//             productPrice,
//             productImage,
//             quantity
//         });
//     }

//     localStorage.setItem('cart', JSON.stringify(cart)); // Save updated cart to localStorage
//     alert(`${productName} has been added to your cart.`);
//     displayCartItems(); // Update UI
// }

// // Function to display cart items in a table format
// function displayCartItems() {
//     const cartTableBody = document.getElementById('cart-items');
//     const subtotalElement = document.querySelector('.shoping__checkout ul li:nth-child(1) span');
//     const totalElement = document.querySelector('.shoping__checkout ul li:nth-child(2) span');

//     if (!cartTableBody) {
//         console.error("Error: Element with id 'cart-items' not found!");
//         return;
//     }

//     let cart = JSON.parse(localStorage.getItem('cart')) || [];

//     if (!cart.length) {
//         cartTableBody.innerHTML = '<tr><td colspan="5" class="text-center text-warning">Your cart is empty.</td></tr>';
//         subtotalElement.textContent = "₹0.00";
//         totalElement.textContent = "₹0.00";
//         return;
//     }

//     let subtotal = 0;

//     cartTableBody.innerHTML = cart.map(item => {
//         let itemTotal = item.productPrice * item.quantity;
//         subtotal += itemTotal;
    
//         return `
//             <tr>
//                 <td><img src="${item.productImage}" alt="${item.productName}" width="50" height="50"></td>
//                 <td>${item.productName || 'Unnamed Product'}</td>
//                 <td>₹${item.productPrice || '0'}</td>
//                 <td>
//                     <button class="decrease-qty btn btn-sm btn-outline-danger" data-id="${item.productId}">-</button>
//                     ${item.quantity || 1}
//                     <button class="increase-qty btn btn-sm btn-outline-success" data-id="${item.productId}">+</button>
//                 </td>
//                 <td>₹${itemTotal.toFixed(2)}</td>
//                 <td><button class="remove-item-btn btn btn-danger btn-sm" data-id="${item.productId}">❌</button></td>
//             </tr>
//         `;
//     }).join('');
    

//     // Update Subtotal and Total
//     subtotalElement.textContent = `₹${subtotal.toFixed(2)}`;
//     totalElement.textContent = `₹${subtotal.toFixed(2)}`;

//     // Attach event listeners
//     document.querySelectorAll('.remove-item-btn').forEach(button => {
//         button.addEventListener('click', removeCartItem);
//     });

//     document.querySelectorAll('.increase-qty').forEach(button => {
//         button.addEventListener('click', increaseQuantity);
//     });

//     document.querySelectorAll('.decrease-qty').forEach(button => {
//         button.addEventListener('click', decreaseQuantity);
//     });
// }

// // Add event listener for Proceed to Checkout button
// // document.querySelector('.primary-btn').addEventListener('click', () => {
// //     window.location.href = "./checkout.html"; // Redirect to checkout page
// // });
// document.addEventListener('DOMContentLoaded', () => {
//     displayCartItems();

//     // Checkout button event listener (Fixed)
//     document.body.addEventListener('click', (event) => {
//         if (event.target.classList.contains('primary-btn')) {
//             window.location.href = "./checkout.html"; // Redirect to checkout page
//         }
//     });
// });



// // Function to increase quantity
// function increaseQuantity(event) {
//     let productId = String(event.target.dataset.id);
//     let cart = JSON.parse(localStorage.getItem('cart')) || [];

//     cart = cart.map(item => {
//         if (item.productId === productId) {
//             item.quantity += 1;
//         }
//         return item;
//     });

//     localStorage.setItem('cart', JSON.stringify(cart));
//     displayCartItems(); // Update UI
// }

// // Function to decrease quantity
// function decreaseQuantity(event) {
//     let productId = String(event.target.dataset.id);
//     let cart = JSON.parse(localStorage.getItem('cart')) || [];

//     cart = cart.map(item => {
//         if (item.productId === productId && item.quantity > 1) {
//             item.quantity -= 1;
//         }
//         return item;
//     });

//     localStorage.setItem('cart', JSON.stringify(cart));
//     displayCartItems(); // Update UI
// }

// // Function to remove an item from the cart
// function removeCartItem(event) {
//     let productId = String(event.target.dataset.id);
//     let cart = JSON.parse(localStorage.getItem('cart')) || [];

//     cart = cart.filter(item => item.productId !== productId); // Remove item

//     localStorage.setItem('cart', JSON.stringify(cart));
//     displayCartItems(); // Update UI
// }


document.addEventListener('DOMContentLoaded', () => {
    displayCartItems();

    // Checkout button event listener
    const checkoutBtn = document.getElementById('checkout-btn');
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', proceedToCheckout);
    }
});

// Function to safely get cart data from localStorage
function getCart() {
    let cart = [];
    try {
        let cartData = localStorage.getItem('cart');
        if (cartData) {
            cart = JSON.parse(cartData);
            if (!Array.isArray(cart)) {
                console.warn("Warning: Cart data is not an array. Resetting cart.");
                cart = [];
            }
        }
    } catch (error) {
        console.error("Error parsing cart data:", error);
        cart = [];
    }
    return cart;
}

// Function to update cart in localStorage
function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Function to add an item to the cart
function addToCart(productId, productName, productPrice, productImage, quantity) {
    let cart = getCart();
    
    productId = String(productId); // Ensure consistent ID format

    // Check if product already exists in the cart
    const existingProduct = cart.find(item => item.productId === productId);
    if (existingProduct) {
        existingProduct.quantity += quantity;
    } else {
        cart.push({ productId, productName, productPrice, productImage, quantity });
    }

    saveCart(cart);
    alert(`${productName} has been added to your cart.`);
    displayCartItems(); // Update UI
}

// Function to display cart items in a table format
function displayCartItems() {
    const cartTableBody = document.getElementById('cart-items');
    const subtotalElement = document.querySelector('.shoping__checkout ul li:nth-child(1) span');
    const totalElement = document.querySelector('.shoping__checkout ul li:nth-child(2) span');

    if (!cartTableBody) {
        console.error("Error: Element with id 'cart-items' not found!");
        return;
    }

    let cart = getCart();

    if (cart.length === 0) {
        cartTableBody.innerHTML = '<tr><td colspan="5" class="text-center text-warning">Your cart is empty.</td></tr>';
        subtotalElement.textContent = "₹0.00";
        totalElement.textContent = "₹0.00";
        return;
    }

    let subtotal = 0;

    cartTableBody.innerHTML = cart.map(item => {
        let itemTotal = item.productPrice * item.quantity;
        subtotal += itemTotal;
    
        return `
            <tr>
                <td><img src="${item.productImage}" alt="${item.productName}" width="50" height="50"></td>
                <td>${item.productName || 'Unnamed Product'}</td>
                <td>₹${item.productPrice || '0'}</td>
                <td>
                    <button class="decrease-qty btn btn-sm btn-outline-danger" data-id="${item.productId}">-</button>
                    ${item.quantity || 1}
                    <button class="increase-qty btn btn-sm btn-outline-success" data-id="${item.productId}">+</button>
                </td>
                <td>₹${itemTotal.toFixed(2)}</td>
                <td><button class="remove-item-btn btn btn-danger btn-sm" data-id="${item.productId}">❌</button></td>
            </tr>
        `;
    }).join('');
    
    // Update Subtotal and Total
    subtotalElement.textContent = `₹${subtotal.toFixed(2)}`;
    totalElement.textContent = `₹${subtotal.toFixed(2)}`;

    // Attach event listeners
    document.querySelectorAll('.remove-item-btn').forEach(button => {
        button.addEventListener('click', removeCartItem);
    });

    document.querySelectorAll('.increase-qty').forEach(button => {
        button.addEventListener('click', increaseQuantity);
    });

    document.querySelectorAll('.decrease-qty').forEach(button => {
        button.addEventListener('click', decreaseQuantity);
    });
}

// Function to increase quantity
function increaseQuantity(event) {
    let productId = String(event.target.dataset.id);
    let cart = getCart();

    cart = cart.map(item => {
        if (item.productId === productId) {
            item.quantity += 1;
        }
        return item;
    });

    saveCart(cart);
    displayCartItems(); // Update UI
}

// Function to decrease quantity
function decreaseQuantity(event) {
    let productId = String(event.target.dataset.id);
    let cart = getCart();

    cart = cart.map(item => {
        if (item.productId === productId && item.quantity > 1) {
            item.quantity -= 1;
        }
        return item;
    });

    saveCart(cart);
    displayCartItems(); // Update UI
}

// Function to remove an item from the cart
function removeCartItem(event) {
    let productId = String(event.target.dataset.id);
    let cart = getCart();

    cart = cart.filter(item => item.productId !== productId); // Remove item

    saveCart(cart);
    displayCartItems(); // Update UI
}

// Proceed to checkout event listener
document.addEventListener('DOMContentLoaded', () => {
    displayCartItems();

    document.body.addEventListener('click', (event) => {
        if (event.target.classList.contains('primary-btn')) {
            window.location.href = "./checkout.html"; // Redirect to checkout page
        }
    });
});
