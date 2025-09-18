// document.getElementById("place-order").addEventListener("click", function () {
//     let cart = JSON.parse(localStorage.getItem("cart")) || [];
//     let orderDetails = cart.map(item => `${item.productName} (x${item.quantity})`).join(", ");

//     // Select inputs using name attributes
//     let firstName = document.querySelector("input[name='first_name']");
//     let lastName = document.querySelector("input[name='last_name']");
//     let address = document.querySelector("input[name='address']");
//     let apartment = document.querySelector("input[name='apartment']");
//     let city = document.querySelector("input[name='city']");
//     let state = document.querySelector("input[name='state']");
//     let zipcode = document.querySelector("input[name='zipcode']");
//     let phone = document.querySelector("input[name='phone']");
//     // let email = document.querySelector("input[name='email']");
//     let orderNotes = document.querySelector("input[name='order_notes']");
//     // let paymentMethod = document.querySelector("input[name='payment_method']:checked");

//     // Check if required fields are filled
//     if (!firstName || !lastName || !address || !city || !state || !zipcode || !phone ) {
//         alert("Please fill in all required fields and select a payment method.");
//         return;
//     }

//     let formData = new FormData();
//     formData.append("first_name", firstName.value);
//     formData.append("last_name", lastName.value);
//     formData.append("address", address.value);
//     formData.append("apartment", apartment ? apartment.value : ""); // Optional field
//     formData.append("city", city.value);
//     formData.append("state", state.value);
//     formData.append("zipcode", zipcode.value);
//     formData.append("phone", phone.value);
//     // formData.append("email", email.value);
//     formData.append("order_notes", orderNotes ? orderNotes.value : ""); // Optional field
//     // formData.append("payment_method", paymentMethod.value);
//     formData.append("total_amount", document.getElementById("total").textContent.replace("₹", ""));
//     formData.append("order_details", orderDetails);

//     fetch("./Backend/place_order.php", {
//         method: "POST",
//         body: formData
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             alert("Order placed successfully!");
//             localStorage.removeItem("cart"); 
//             // window.location.href = "order_success.php";
//         } else {
//             alert("Order failed: " + data.message);
//         }
//     })
//     .catch(error => console.error("Error:", error));
// });

document.getElementById("place-order").addEventListener("click", function () {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let orderDetails = cart.map(item => `${item.productName} (x${item.quantity})`).join(", ");

    // Get form input values
    let firstName = document.querySelector("input[name='first_name']");
    let lastName = document.querySelector("input[name='last_name']");
    let address = document.querySelector("input[name='address']");
    let apartment = document.querySelector("input[name='apartment']");
    let city = document.querySelector("input[name='city']");
    let state = document.querySelector("input[name='state']");
    let zipcode = document.querySelector("input[name='zipcode']");
    let phone = document.querySelector("input[name='phone']");
    let orderNotes = document.querySelector("input[name='order_notes']");
    let email = document.querySelector("input[name='email']");

    // Check if required fields are filled
    if (!firstName.value || !lastName.value || !address.value || !city.value || !state.value || !zipcode.value || !phone.value || !email.value) {
        alert("Please fill in all required fields.");
        return;
    }

    let formData = new FormData();
    formData.append("first_name", firstName.value);
    formData.append("last_name", lastName.value);
    formData.append("address", address.value);
    formData.append("apartment", apartment ? apartment.value : "");
    formData.append("city", city.value);
    formData.append("state", state.value);
    formData.append("zipcode", zipcode.value);
    formData.append("email", email.value);  // Fixed this line
    formData.append("order_notes", orderNotes ? orderNotes.value : "");
    formData.append("total_amount", document.getElementById("total").textContent.replace("₹", ""));
    formData.append("order_details", orderDetails);
    formData.append("phone", phone.value);

    fetch("./Backend/place_order.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text()) // First get raw text response
    .then(text => {
        try {
            let data = JSON.parse(text); // Try parsing as JSON
            if (data.success) {
                alert("Order placed successfully!");
                localStorage.removeItem("cart");
                // window.location.href = "order_success.php"; 
            } else {
                alert("Order failed: " + data.message);
            }
        } catch (error) {
            console.error("Response Error:", text); // Log full response
            alert("An error occurred. Check the console.");
        }
    })
    .catch(error => console.error("Fetch Error:", error));
    
});

