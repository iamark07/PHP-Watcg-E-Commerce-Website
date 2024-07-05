// increase decrease cart item 
let increase_count = 1;
document.querySelectorAll(".increase_item").forEach(increase =>{
    increase.addEventListener("click", ()=>{
        
        let no_of_item = increase.previousElementSibling;
        increase_count++;
        console.log(increase_count);
        no_of_item.innerHTML = increase_count;       
    });
});

// document.querySelectorAll(".decrease_item").forEach(decrease =>{
//     decrease.addEventListener("click", ()=>{
        
//         let no_of_item = decrease.previousElementSibling;
//         count--;
//         console.log(count);
//         no_of_item.innerHTML = count;       
//     });
// });