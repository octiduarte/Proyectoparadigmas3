const imagenes = ["imagenes/CarrouselInicio/remera.jpg", "imagenes/CarrouselInicio/remera2.jpeg", "imagenes/CarrouselInicio/remera3.jpg"]; // El array con las imágenes para pantalla grande
const imagenesMovil = ["imagenes/Carrousel/Movil/Remera1.jpg", "imagenes/Carrousel/Movil/remera2.jpeg" , "imagenes/Carrousel/Movil/remera3.jpg"]; // El array con las imágenes para pantalla pequeña
let imagenActual = 0;
const sliderImage = document.getElementById("sliderImage");
let intervalo = setInterval(updateImage,1500);
updateImage();
window.addEventListener("resize", cambiarImagenes); // Agregar un listener al evento resize

function cambiarImagenes() {
  let anchoPantalla = window.innerWidth; // Obtener el ancho de la pantalla actual
  clearInterval(intervalo); // Cancelar el intervalo anterior
  if(anchoPantalla<=390){
    updateImageMovil(); // Usar el array con las imágenes más pequeñas
    intervalo = setInterval(updateImageMovil, 1000); // Crear un intervalo que cambia las imágenes cada segundo
  }
  else {
    updateImage(); // Usar el array con las imágenes originales
    intervalo = setInterval(updateImage, 2000); // Crear un intervalo que cambia las imágenes cada dos segundos
  }
}

function updateImage() {
    imagenActual = (imagenActual + 1) % imagenes.length;
    const imageUrl = imagenes[imagenActual];
    sliderImage.src = imageUrl;
}

function updateImageMovil() {
    imagenActual = (imagenActual + 1) % imagenesMovil.length;
    const imageUrl = imagenesMovil[imagenActual];
    sliderImage.src = imageUrl;
}

sliderImage.addEventListener("mouseover", function() {
    clearInterval(intervalo);
  });
  sliderImage.addEventListener("mouseout", function() {
    intervalo = setInterval(updateImage, 3000);
  });