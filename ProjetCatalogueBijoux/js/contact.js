/*On recupere le formulaire et le champ d'e-mail ainsi que l'element span 
dans lequel on placera le message d'erreur*/ 

var form = document.getElementsByTagName("form")[0];

var caractere = /^[A-Za-z]+$/

var valueDateContact = document.getElementById('date_du_contact').value;
var error_dateContact= document.getElementById("error-dateContact");
var valueDateNaissance = document.getElementById('date_naissance').value;
var error_dateNaissance = document.getElementById("error-dateNaissance");


var email = document.getElementById("email");
var error_email = document.getElementById("error-email");
var nom = document.getElementById("nom");
var error_nom = document.getElementById("error-nom");
var prenom = document.getElementById("prenom");
var error_prenom = document.getElementById("error-prenom");
var sujet = document.getElementById("sujet");
var error_sujet = document.getElementById("error-sujet");
var contenu = document.getElementById("contenu");
var error_contenu = document.getElementById("error-contenu");
/*
email.setCustomValidity("Invalid Field");
nom.setCustomValidity("Invalid Field");
prenom.setCustomValidity("Invalid Field");
sujet.setCustomValidity("Invalid Field");
contenu.setCustomValidity("Invalid Field");

*/

document.getElementById('date_du_contact').addEventListener(
    "input",
    function(event){
        
        if ( valueDateContact == null || valueDateContact== ''){
            error_dateContact.innerHTML = ""; // On réinitialise le contenu
            error_dateContact.className = "error"; // On réinitialise l'état visuel du message
            valueDateContact.setCustomValidity('');
        }
        else {
            valueDateContact.setCustomValidity("Invalid Field");
        }   
  },
  false,
)



email.addEventListener(
    "input",
    function(event){
        if(email.validity.valid){
            error_email.innerHTML = ""; // On réinitialise le contenu
            error_email.className = "error"; // On réinitialise l'état visuel du message
        }
  },
  false,
);

nom.addEventListener(
    "input",
    function(event){
        
        var nomV = document.getElementById("nom").value.trim();
        if(!(nomV =='') && caractere.test(nomV)){
            
            error_nom.innerHTML = ""; // On réinitialise le contenu
            error_nom.className = "error"; // On réinitialise l'état visuel du message
            nom.setCustomValidity('');
        }
        else {
            nom.setCustomValidity("Invalid Field");
        }
        
  },
  false,
);

prenom.addEventListener(
    "input",
    function(event){
        
        var prenomV = document.getElementById("prenom").value.trim();
        if(!(prenomV =='') && caractere.test(prenomV)){
            
            error_prenom.innerHTML = ""; // On réinitialise le contenu
            error_prenom.className = "error"; // On réinitialise l'état visuel du message
            prenom.setCustomValidity('');
        }
        else {
            prenom.setCustomValidity("Invalid Field");
        }
        
  },
  false,
);

document.getElementById('date_naissance').addEventListener(
    "input",
    function(event){
        
        if ( valueDateNaissance== null || valueDateNaissance== ''){
            error_dateNaissance.innerHTML = ""; // On réinitialise le contenu
            error_dateNaissance.className = "error"; // On réinitialise l'état visuel du message
            valueDateNaissance.setCustomValidity('');
        }
        else {
            valueDateNaissance.setCustomValidity("Invalid Field");
        }   
  },
  false,
);



sujet.addEventListener(
    "input",
    function(event){
        
        var sujetV = document.getElementById("prenom").value.trim();
        if(!(sujetV =='')){
            
            error_sujet.innerHTML = ""; // On réinitialise le contenu
            error_sujet.className = "error"; // On réinitialise l'état visuel du message
            sujet.setCustomValidity('');
        }
        else {
            sujet.setCustomValidity("Invalid Field");
        }
        
  },
  false,
);

contenu.addEventListener(
    "input",
    function(event){
        
        var contenuV = document.getElementById("contenu").value.trim();
        if(!(contenuV =='')){
            
            error_contenu.innerHTML = ""; // On réinitialise le contenu
            error_contenu.className = "error"; // On réinitialise l'état visuel du message
            contenu.setCustomValidity('');
        }
        else {
            contenu.setCustomValidity("Invalid Field");
        }
        
  },
  false,
);


form.addEventListener(
    "submit",
    function(event){
        
        var nomV = document.getElementById("nom").value.trim();
        var prenomV = document.getElementById("prenom").value.trim();
        var emailV = document.getElementById("email").value.trim();
        var contenuV = document.getElementById("contenu").value.trim();
        var sujetV = document.getElementById("sujet").value.trim();
        var date_du_contactV = document.getElementById('date_du_contact').value;
        var date_naissanceV = document.getElementById('date_naissance').value;

        if(!document.getElementById("date_du_contact").validity.valid){
            error_dateContact.innerHTML = "Le date de contact n'est pas saisi"; // On réinitialise le contenu
            error_dateContact.className = "error active"; // On réinitialise l'état visuel du message
            
            event.preventDefault();
        }

        if(!email.validity.valid){
            error_email.innerHTML = "Vous n'avez pas saisi un email valide : monmail@monsite.org"; // On réinitialise le contenu
            error_email.className = "error active"; // On réinitialise l'état visuel du message
            event.preventDefault();
        }
        
        if(!nom.validity.valid){
            error_nom.innerHTML = "Vous n'avez pas saisi un nom valide : seules les lettres sont autorisées"; // On réinitialise le contenu
            error_nom.className = "error active"; // On réinitialise l'état visuel du message
            event.preventDefault();
        }
        
        if(!prenom.validity.valid){
            error_prenom.innerHTML = "Vous n'avez pas saisi un prenom valide : seules les lettres sont autorisées"; // On réinitialise le contenu
            error_prenom.className = "error active"; // On réinitialise l'état visuel du message
            event.preventDefault();
        }

        if(!document.getElementById("date_naissance").validity.valid){
            error_dateNaissance.innerHTML = "Le date de contact n'est pas saisi"; // On réinitialise le contenu
            error_dateNaissance.className = "error active"; // On réinitialise l'état visuel du message
            event.preventDefault();
        }


        
        if(!sujet.validity.valid){
            error_sujet.innerHTML = "Le sujet est vide"; // On réinitialise le contenu
            error_sujet.className = "error active"; // On réinitialise l'état visuel du message
            event.preventDefault();
        }

        
        if(!contenu.validity.valid){
            error_contenu.innerHTML = "Le message est vide"; // On réinitialise le contenu
            error_contenu.className = "error active"; // On réinitialise l'état visuel du message
            event.preventDefault();
        }

        
        //test initial car si l'user ne touche pas les inputs, les test ne sont jamais vérifiés
      
        if ( date_du_contactV == null || date_du_contactV== ''){
            error_dateContact.innerHTML = "Le date de contact n'est pas saisi"; // On réinitialise le contenu
            error_dateContact.className = "error active"; // On réinitialise l'état visuel du message
            event.preventDefault();
        }

        if(emailV == ""){
            error_email.innerHTML = "Vous n'avez pas saisi d'email"; // On réinitialise le contenu
            error_email.className = "error active"; // On réinitialise l'état visuel du message
            
            event.preventDefault();
        }

        if (nomV == "")
        {
            error_nom.innerHTML = "Vous n'avez pas saisi de nom"; // On réinitialise le contenu
            error_nom.className = "error active";
            event.preventDefault(); 
        }

        if(prenomV == ""){
            error_prenom.innerHTML = "Vous n'avez pas saisi de prenom"; // On réinitialise le contenu
            error_prenom.className = "error active"; // On réinitialise l'état visuel du message
            event.preventDefault();
        }

        if (date_naissanceV == null || date_naissanceV== ''){
            error_dateNaissance.innerHTML = "Le date de contact n'est pas saisi"; // On réinitialise le contenu
            error_dateNaissance.className = "error active"; // On réinitialise l'état visuel du message
            event.preventDefault();
        }

        if(sujetV == ""){
            error_sujet.innerHTML = "Vous n'avez pas saisi de sujet"; // On réinitialise le contenu
            error_sujet.className = "error active"; // On réinitialise l'état visuel du message
            event.preventDefault();
        }

        if(contenuV == ""){
            error_contenu.innerHTML = "Vous n'avez pas saisi de message"; // On réinitialise le contenu
            error_contenu.className = "error active"; // On réinitialise l'état visuel du message
            event.preventDefault();
        }

  },
  false,
);