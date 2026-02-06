document.addEventListener('DOMContentLoaded', () => {
    const menuLink = document.getElementById('menu-link');
    const menuSection = document.getElementById('menu');

    menuLink.addEventListener('click', (event) => {
        event.preventDefault();
        if (menuSection.style.display === 'none' || menuSection.style.display === '') {
            menuSection.style.display = 'block';
        } else {
            menuSection.style.display = 'none';
        }
    });

    // Cierra el menú si se hace clic fuera de él
    document.addEventListener('click', (event) => {
        if (!menuSection.contains(event.target) && event.target !== menuLink) {
            menuSection.style.display = 'none';
        }
    });
});

$(document).ready(function(){
    $('.carousel').slick({
        dots: true, // Muestra los puntos de navegación
        arrows: true, // Muestra las flechas de navegación
        autoplay: true, // Reproducción automática del carrusel
        autoplaySpeed: 2000, // Velocidad de reproducción en milisegundos
        infinite: true, // Reproducción infinita del carrusel
        speed: 500, // Velocidad de transición en milisegundos
        slidesToShow: 1, // Número de imágenes a mostrar simultáneamente
        slidesToScroll: 1 // Número de imágenes a desplazar al avanzar o retroceder
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Seleccionar el footer por su ID
    var footer = document.getElementById("main-footer");

    // Establecer el temporizador para ocultar el footer después de 5 segundos (5000 milisegundos)
    setTimeout(function() {
        footer.style.display = "none"; // Ocultar el footer cambiando su estilo a "display: none;"
    }, 1000); // 5000 milisegundos = 5 segundos
});
