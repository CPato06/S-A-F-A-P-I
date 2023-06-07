var botones = document.querySelectorAll('.btn_expandir');
var textos_expandir = document.querySelectorAll('.texto_expandir');

botones.forEach((elemento, clave)=>{
    elemento.addEventListener('click', () => {
        console.log("Hola")
        textos_expandir[clave].classList.toggle("abrir_cerrar")
    });
});