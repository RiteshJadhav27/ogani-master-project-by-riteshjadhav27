document.addEventListener("DOMContentLoaded", function () {
    const orderSummary = document.getElementById("order-summary"); // Order summary list
    const subtotalEl = document.getElementById("subtotal"); // Subtotal amount
    const totalEl = document.getElementById("total"); // Total amount

    // Get cart items from localStorage
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    // Check if cart is empty
    if (cart.length === 0) {
        orderSummary.innerHTML = "<li>Your cart is empty!</li>";
        subtotalEl.textContent = "₹0.00";
        totalEl.textContent = "₹0.00";
        return;
    }

    let subtotal = 0;

    // Loop through each cart item and add it to checkout page
    cart.forEach(item => {
        // ✅ Ensure values exist before using them
        let productName = item.productName || "Unknown Product";
        let productPrice = parseFloat(item.productPrice) || 0;
        let productQuantity = parseInt(item.quantity) || 1;

        let itemTotal = productPrice * productQuantity; // Calculate total price
        subtotal += itemTotal;

        let li = document.createElement("li");
        li.innerHTML = `${productName} (x${productQuantity}) <span>₹${itemTotal.toFixed(2)}</span>`;
        orderSummary.appendChild(li);
    });

    // Update subtotal and total
    subtotalEl.textContent = `₹${subtotal.toFixed(2)}`;
    totalEl.textContent = `₹${subtotal.toFixed(2)}`; // Assuming no extra charges
});


