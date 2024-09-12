function afficherFormulaireInscription() {
    let formulaire_inscription = document.getElementById("formulaire_inscription");
    let formulaire_connexion = document.getElementById("Formulaire_Connexion");

        
        formulaire_connexion.style.display = "none";
        formulaire_inscription.style.display = "block";

        
}

function afficherFormulaireConnexion() {
    let formulaire_inscription = document.getElementById("formulaire_inscription");
    let formulaire_connexion = document.getElementById("Formulaire_Connexion");
    let message_erreur = document.getElementById("message_erreur_inscription");
    formulaire_connexion.style.display = "block";
    formulaire_inscription.style.display = "none";
    
    if (formulaire_inscription.style.display == "none") {
        message_erreur.style.display = "none";
    }    
    

       
}

 