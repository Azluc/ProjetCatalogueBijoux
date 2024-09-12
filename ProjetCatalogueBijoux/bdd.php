<?php
// On inclut le fichier contenant les données de connexion à la base de données
require_once("bddData.php");

// Fonction de connexion à la base de données
function connexionBDD() {
    global $serveur, $utilisateur, $motDePasse, $baseDeDonnees;

    try {
        // Connexion à la base de données avec PDO
        $bdd = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
        // Définition du mode d'erreur PDO sur Exception
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bdd;
    } catch(PDOException $e) {
        // En cas d'erreur de connexion, afficher un message d'erreur
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}

// Fonction de déconnexion de la base de données
function deconnexionBDD($bdd) {
    // Fermeture de la connexion
    $bdd = null;
}

// Fonction de récupération des données depuis la base de données
function recupererDonnees() {
    // Connexion à la base de données
    $bdd = connexionBDD();

    // Requête SQL pour récupérer les catégories et les produits associés
    $sql = "SELECT c.nom AS nom_categorie, p.* FROM categories c LEFT JOIN produits p ON c.id = p.categorie_id";

    try {
        // Préparation de la requête
        $stmt = $bdd->prepare($sql);
        // Exécution de la requête
        $stmt->execute();
        // Récupération des résultats
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Tableau pour stocker les données récupérées
        $categories = array();

        // Récupération des données et on les stock dans le tableau
        foreach ($resultats as $row) {
            // On vérifie si la catégorie existe déjà dans le tableau des catégories
            if (!isset($categories[$row['nom_categorie']])) {
                // Si la catégorie n'existe pas, on la met dans le tableau
                $categories[$row['nom_categorie']] = array();
            }
            // On ajoute les détails du produit à la catégorie correspondante
            $categories[$row['nom_categorie']][] = $row;
        }

        // on se déconnecte de la bdd
        deconnexionBDD($bdd);
        
        // On renvoie les données récupérées
        return $categories;

    } catch(PDOException $e) {
        // En cas d'erreur lors de l'exécution de la requête, afficher un message d'erreur
        die("Erreur lors de la récupération des données produits/catégories depuis la base de données : " . $e->getMessage());
    }
    
}


function recupererDonneesClients(){
    // Connexion à la base de données
    $bdd = connexionBDD();

    // Requête SQL pour récupérer les catégories et les produits associés
    $sql = "SELECT * FROM clients";

    try {
        // Préparation de la requête
        $stmt = $bdd->prepare($sql);
        // Exécution de la requête
        $stmt->execute();
        // Récupération des résultats
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Tableau pour stocker les données récupérées
        $clients = array();

        // Récupération des données et on les stock dans le tableau
        foreach ($resultats as $row) {
            // On utilise l'e-mail comme clé pour chaque client
            $email = $row['email'];
            // On stocke directement les détails du client avec l'e-mail comme clé
            $clients[$email] = $row;
        }
        
        // on se déconnecte de la bdd
        deconnexionBDD($bdd);

        // On renvoie les données récupérées
        return $clients;

    } catch(PDOException $e) {
        // En cas d'erreur lors de l'exécution de la requête, afficher un message d'erreur
        die("Erreur lors de la récupération des données clients depuis la base de données : " . $e->getMessage());
    }
}

?>