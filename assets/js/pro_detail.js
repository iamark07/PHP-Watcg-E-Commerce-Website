// product full img 

// let pro_side_img = document.querySelectorAll(".pro_side_img");
// pro_side_img.forEach(val => {
//     val.addEventListener("click", () => {
//         let side_img = val.querySelector("img");
//         side_img.forEach(img => {
//             img_attr = side_img.getAttribute('src');
//             console.log(img_attr);
//             let full_side_img = document.querySelector(".full_side_img");
//             full_side_img.setAttribute('src', img_attr);
//             document.querySelector(".show_side_img_container").classList.add("show_side_img");
//         });
//     });
// });



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

// Select all elements with the class "pro_side_img"
let pro_side_img = document.querySelectorAll(".pro_side_img");

pro_side_img.forEach(val => {
    val.addEventListener("click", () => {
        // Get the img element inside the clicked pro_side_img
        let img = val.querySelector("img");
        
        // Get the src attribute of the img
        let img_attr = img.getAttribute('src');
        
        // Select the full side image element
        let full_side_img = document.querySelector(".full_side_img");
        
        // Set the src attribute of the full side image to the clicked image's src
        full_side_img.setAttribute('src', img_attr);
        
        // Show the full image container
        document.querySelector(".show_side_img_container").classList.add("show_side_img");
        // remove hide full img class
        document.querySelector(".show_side_img_container").classList.remove("hide_full_img");
    });
});


function close_full_img(){
    document.querySelector(".show_side_img_container").classList.add("hide_full_img");
    document.querySelector(".show_side_img_container").classList.remove("show_side_img");
}


// review img show and hide function

let review_img = document.querySelectorAll(".review_img");

review_img.forEach(val => {
    val.addEventListener("click", () => {
        
        // Get the src attribute of the img
        let review_img_attr = val.getAttribute('src');
        console.log(review_img_attr);
        
        // Select the show review image element
        let full_review_img = document.querySelector(".full_review_img");
        
        // Set the src attribute of the show review image to the clicked image's src
        full_review_img.setAttribute('src', review_img_attr);
        
        // Show the full image container
        document.querySelector(".show_review_img_container").classList.add("review_show_side_img");
        // remove hide full img class
        document.querySelector(".show_review_img_container").classList.remove("review_hide_full_img");
    });
});

// hide review image
function close_review_full_img(){
    document.querySelector(".show_review_img_container").classList.add("review_hide_full_img");
    document.querySelector(".show_review_img_container").classList.remove("review_show_side_img");
}


function add_review_btn(){
    document.querySelector(".add_review_container").classList.add("show_add_review");
    document.querySelector(".add_review_container").classList.remove("close_add_review");
}


function close_add_review(){
    document.querySelector(".add_review_container").classList.remove("show_add_review");
    document.querySelector(".add_review_container").classList.add("close_add_review");
}