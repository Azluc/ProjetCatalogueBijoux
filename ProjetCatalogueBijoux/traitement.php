<?php
session_start();

// Connexion à la base de données
include 'bdd.php'; // Inclure le fichier de connexion à la base de données
$connexion = connexionBDD();

// Vérification de la demande d'ajout au panier
if (isset($_GET['quantite']) && isset($_GET['ref'])) {
    try {
        // Récupération des données du produit à ajouter au panier
        $quantite = $_GET['quantite'];
        $ref = $_GET['ref']; 
        $image = $_GET['image'];
        $prix = $_GET['prix'];

        echo "qt = $quantite";
        echo "ref = $ref";
        echo "image = $image";
        
        // Récupération du stock disponible dans la base de données
        $sql_select = "SELECT stock FROM produits WHERE reference = '$ref'";
        $stmt_select = $connexion->query($sql_select);
        $row = $stmt_select->fetch(PDO::FETCH_ASSOC);
        $stock_disponible = $row['stock'];

        // Vérification du stock disponible
        if ($stock_disponible >= $quantite) {
            // Mettre à jour le stock dans la base de données
            $nouveau_stock = $stock_disponible - $quantite;
            $sql_update = "UPDATE produits SET stock = $nouveau_stock WHERE reference = '$ref'";
            $connexion->exec($sql_update);
            echo "le produit a été ajouté au panier";
            echo "qt = $quantite, ref = $ref, nv stock = $nouveau_stock";

            // Ajouter le produit au panier de l'utilisateur
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = array();
            }

            $produit = array(
                'reference' => $ref,
                'quantite' => $quantite,
                'prix' => $prix,
                'image' => $image,
            );
            array_push($_SESSION['panier'], $produit);
        } else {
            echo "stock insuffisant !";
        }

        // déconnexion à la bdd
        deconnexionBDD($connexion);

    } catch(PDOException $e) {
        echo "Erreur PDO : " . $e->getMessage();
    }
}
// Fermer la session
session_write_close();
?>
