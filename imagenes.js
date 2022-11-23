const nombre_img = document.querySelector("#nombre_img");
const ruta_img = document.querySelector("#ruta_img");


window.onload= ()=>{
    async function calling(){
        const res = await fetch('./imagen.php?nombre='+ nombre_img.value);
    } 
    calling();
}


