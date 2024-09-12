    <?php
ob_start();
session_start();
include "bdd.php";

// Récupération des données des clients depuis la base de données
$clients = recupererDonneesClients();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <script src="js/page_authentification.js"></script>
        <link rel="stylesheet" href="css/page_authentification.css">
        <meta charset="UTF-8">
    </head>
    <body class="fond">
        <!-------------------------------------Partie Connexion ------------------------------->
        <div class="Formulaire_Connexion" style="display: block;" id="Formulaire_Connexion">  <!-- formulaire de connexion, il est initialement affiché -->
            
            <?php
            if (isset($_POST["confirmer_connexion"])) { 
                // On récupère les données du formulaire de connexion
                $mail1 = $_POST["email"];
                $motdepasse1 = $_POST["mdp"];
                
                $identifiant_valide = false; // on crée un booléen qui permettra de savoir si l'utilisateur a saisi les bons identifiants
                                 
                // on parcourt les données des clients pour vérifier les informations d'identification
                foreach ($clients as $client) {
                    if ($client['email'] === $mail1 && password_verify($motdepasse1, $client['mdp'])) {
                        // Les identifiants sont valides
                        $_SESSION["email"] = $mail1;
                        // Redirection vers la page d'accueil
                        header('location: index.php');
                        exit(); // on arrête l'exécution du script après la redirection
                    }
                }

                // Si les identifiants sont incorrects, afficher un message d'erreur
                echo '<p class="message_erreur_connexion">Identifiants incorrects !</p>';
            }
        ?>
            
            <!----------------------------------- formulaire pour se connecter ---------------------------------->
            
                
                <p class="texte_connexion"> Se connecter </p>
                <hr>
                <form method="POST" action="page_authentification.php">

                    <input class="champ_inscription" type="email" name="email" placeholder="Votre adresse mail" required>
                    <br>
                    <input class="champ_inscription" type="password" name="mdp" placeholder="Votre mot de passe" required>

                    <button class="confirmer_connexion" type="submit" name="confirmer_connexion"> Se connecter</button>     <!--bouton pour envoyer le formulaire de connexion -->
                </form>
              
                <p class="redirection_inscription">Pas de compte ? Cliquer <a href="#" onclick="afficherFormulaireInscription()">ici</a> pour vous inscrire.</p>
            
        </div>


            <!-------------------------------------Partie Inscription ------------------------------->
            
            <div id="formulaire_inscription" <?php if (!isset($_POST["confirmer_inscription"])) echo 'style="display: none;"'; ?>> <!-- formulaire d'inscription, il est initialement masqué -->
            
            <?php
            if (isset($_POST["confirmer_inscription"])) {
                //On récupère les données utilisateur
                $nom = $_POST["nom"];
                $prenom = $_POST["prenom"];
                $date_naissance = $_POST["dateDeNaissance"];
                $genre = $_POST["genre"];
                $mail = $_POST["email"];
                $motdepasse = $_POST["mdp"];

                // Cette partie de code permet de s'assurer de l'unicité du mail
                if (isset($clients[$mail])) {
                    echo '<p class="message_erreur_inscription" id="message_erreur_inscription">Cette e-mail est déjà utilisée. Veuillez en choisir une autre.</p>';
                } else {
                    // Crypter le mot de passe
                    $motdepassehash = password_hash($motdepasse, PASSWORD_BCRYPT);
            
                    // on insère les données dans la base de données
                    $connexion = connexionBDD();
                    $sql = "INSERT INTO clients (email, mdp, nom, prenom, genre, dateDeNaissance) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $connexion->prepare($sql);
                    $stmt->execute([$mail, $motdepassehash, $nom, $prenom, $genre, $date_naissance]);
                    // deconnexion de la bdd
                    deconnexionBDD($connexion);
            
                    // Rediriger l'utilisateur vers la page d'accueil
                    $_SESSION["email"] = $_POST["email"];
                    $_SESSION["nom"] = $_POST["nom"];
                    $_SESSION["prenom"] = $_POST["prenom"];
                    $_SESSION["dateDeNaissance"] = $_POST["dateDeNaissance"];
                    header('location: index.php');
                    exit(); // Arrêter l'exécution du script après la redirection
                }
            }
        ?>
            <!-------------------------------------Formulaire pour s'inscrire ------------------------------->

            <form method="POST" action="page_authentification.php">
                <fieldset>
                    <legend>Inscription</legend>
           
                    <div >
                        <label class="titre_inscription"> Votre nom </label>                        
                        <input class="champ_inscription" type="text" name="nom" required>   <!-- Champ pour demander le nom -->
                        <br>
                    </div>

                

                    <div>
                        <label class="titre_inscription"> Votre prénom </label>
                        <input class="champ_inscription" type="text" name="prenom" required> <!-- Champ pour demander le prénom -->
                        <br>
                    </div>

                    

                    <div >
                        <label class="titre_inscription" > Votre date de naissance</label>
                        <input class="champ_inscription" type="date" name="dateDeNaissance" required>  <!-- Champ pour demander la date de naissance -->
                        <br>
                    </div>
                    
                

                    <div class="champ_inscription_boutons_radio">
                        <label class="titre_inscription">
                            Genre :
                            <input type="radio" name="genre" value="homme" required><label>Homme</label>    <!-- Champ pour demander le sexe -->
                            <input type="radio" name="genre" value="femme"><label>Femme</label>
                        </label>
                    </div>

                    <div>
                        <label class="titre_inscription" > Votre email</label>
                        <input class="champ_inscription" type="email" name="email" required> <!-- Champ pour demander le mail -->
                    
                    </div>

                    <div>
                        <label class="titre_inscription"> Votre mot de passe</label>
                        <input class="champ_inscription" type="password" name="mdp" required> <!-- Champ pour demander le mot de passe  -->
                    </div>

                    <button class="bouton_confirmer_inscription" type="submit" name="confirmer_inscription"> S'inscrire</button> <!-- bouton pour envoyer le formulaire de d'inscription -->
                    <p class="redirection_connexion">Vous avez déjà un compte ? Cliquez <a href="#" onclick="afficherFormulaireConnexion()">ici</a> pour vous connecter.</p>
                </fieldset>
            </form>
        </div>
    </body>
</html>
