const imagenes = ["imagenes/CarrouselInicio/remera.jpg", "imagenes/CarrouselInicio/remera2.jpeg", "imagenes/CarrouselInicio/remera3.jpg"];
let imagenActual = 0;
const sliderImage = document.getElementById("sliderImage");

function updateImage() {
    imagenActual = (imagenActual + 1) % imagenes.length;
    const imageUrl = imagenes[imagenActual];
    sliderImage.src = imageUrl;
}

// Cambiar automáticamente la imagen cada 3 segundos (3000 ms)
setInterval(updateImage, 2000);

updateImage();