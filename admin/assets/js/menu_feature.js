let open_menu_btn = document.getElementById("open_menu_btn");

open_menu_btn.addEventListener("click" , ()=> {
    // console.log("jela")
    document.querySelector(".menu_slider").classList.toggle("!left-0");
});

// close menu side bar

function close_menu_bar() {
    document.querySelector(".menu_slider").classList.toggle("!left-0");
};