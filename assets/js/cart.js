// menu slider function

// open menu side bar funtion

let open_menu_btn = document.getElementById("open_menu_btn");

open_menu_btn.addEventListener("click" , ()=> {
    document.querySelector(".menu_slider").classList.toggle("open_menu_active");
});

// close menu side bar

function close_menu_bar() {
    document.querySelector(".menu_slider").classList.toggle("open_menu_active");
};




document.addEventListener('DOMContentLoaded', function() {
    // user setting show hide
    
        document.querySelector(".mob_user_setting_btn").addEventListener("click", function() {
            console.log("hello");
            document.querySelector(".mob_user_setting").classList.toggle("!block");
    
        });
    
        document.querySelector(".user_setting_btn").addEventListener("click", function() {
            console.log("hello"); 
            document.querySelector(".user_setting").classList.toggle("!opacity-100");
            document.querySelector(".user_setting").classList.toggle("!pointer-events-auto");
        });
    
    });


// Function to update the total amount dynamically
function updateTotalAmount() {
    let totalAmount = 0;

    // Sum up each item's total price based on its quantity
    document.querySelectorAll('.cart_item').forEach(item => {
        const itemPriceElement = item.querySelector(".item-price");
        const itemQuantityElement = item.querySelector(".item_quantity");

        // Get the base price from the data attribute
        const basePrice = parseFloat(itemPriceElement.getAttribute("data-price"));
        // Get the quantity from the quantity element
        const quantity = parseInt(itemQuantityElement.innerHTML, 10);
        
        // Check if basePrice and quantity are valid
        if (!isNaN(basePrice) && !isNaN(quantity)) {
            // Calculate the total for this item and add it to totalAmount
            totalAmount += basePrice * quantity; 
        } else {
            console.error("Invalid price detected:", itemPriceElement.innerHTML);
        }
    });

    // Display the updated total amount
    document.getElementById('totalAmount').innerHTML = totalAmount.toFixed(2); // Format to two decimal places
}

// Event listeners for increasing and decreasing quantity
document.querySelectorAll(".increase_item").forEach(increase => {
    increase.addEventListener("click", () => {
        const quantityElement = increase.previousElementSibling;
        const itemPriceElement = increase.closest(".cart_item").querySelector(".item-price");
        const basePrice = parseFloat(itemPriceElement.getAttribute("data-price"));

        // Update quantity
        let quantity = parseInt(quantityElement.innerHTML, 10);
        quantity++;
        quantityElement.innerHTML = quantity;

        // Update overall total amount
        updateTotalAmount();
    });
});

document.querySelectorAll(".decrease_item").forEach(decrease => {
    decrease.addEventListener("click", () => {
        const quantityElement = decrease.nextElementSibling;
        const itemPriceElement = decrease.closest(".cart_item").querySelector(".item-price");
        const basePrice = parseFloat(itemPriceElement.getAttribute("data-price"));

        // Update quantity only if it's greater than 1
        let quantity = parseInt(quantityElement.innerHTML, 10);
        if (quantity > 1) {
            quantity--;
            quantityElement.innerHTML = quantity;

            // Update overall total amount
            updateTotalAmount();
        }
    });
});
