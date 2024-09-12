// Sélection de toutes les images avec la classe "zoomable"
const images = document.querySelectorAll(".zoomable");

// Fonction permettant de définir le niveau de zoom d'une image
function setZoomLevel(image, zoomLevel) {
    image.style.transform = `scale(${zoomLevel})`;
}

// Boucle sur toutes les images
images.forEach(function(image) {
    // Ajout d'un écouteur d'événement pour le survol de la souris
    image.addEventListener("mouseenter", function() {
        // Définition du niveau de zoom de l'image à 150% lorsque la souris survole l'image
        setZoomLevel(image, 1.7);
    });

    // Ajout d'un écouteur d'événement lorsque la souris quitte l'image
    image.addEventListener("mouseleave", function() {
        // Réinitialisation du niveau de zoom de l'image à sa taille d'origine 100%
        setZoomLevel(image, 1);
    });
});