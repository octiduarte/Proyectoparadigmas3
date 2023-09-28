const imagenes = document.querySelectorAll(".imagen-item");
let imagenActual = 0;

const btnAnterior = document.getElementById("btnAnterior");
const btnSiguiente = document.getElementById("btnSiguiente");

btnAnterior.addEventListener("click", () => {
    //ocultamos la imagen actual
    imagenes[imagenActual].style.display = "none";
    //calculamos la nueva posicion
    imagenActual = (imagenActual - 1 + imagenes.length) % imagenes.length;
    //mostramos la nueva imagen
    imagenes[imagenActual].style.display = "block";
});

btnSiguiente.addEventListener("click", () => {
    imagenes[imagenActual].style.display = "none";
    imagenActual = (imagenActual + 1) % imagenes.length;
    imagenes[imagenActual].style.display = "block";
});