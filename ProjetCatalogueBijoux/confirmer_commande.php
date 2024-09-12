<!DOCTYPE html>
<html lang="fr">
<head>

    <?php
        header ("URL=index.php");
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif de commande</title>
    <br><br>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/confirmer_commande.css">


</head>
<body>
        <h2 class="center-title">Récapitulatif de commande</h2>
        <?php
        session_start();
        $total = 0;
        ?>
        <table class="tableau-style">
            <tr>
                <th>Image</th>
                <th>Référence</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
            <?php
            foreach ($_SESSION['panier'] as $produit) {
                $total += $produit['quantite'] * $produit['prix'];
                ?>
                <tr>
                    <td><img src="<?php echo $produit['image']; ?>" class="panier-confirmer img"></td>
                    <td><?php echo $produit['reference']; ?></td>
                    <td><?php echo $produit['quantite']; ?></td>
                    <td><?php echo $produit['prix']; ?> €</td>
                    <td><?php echo $produit['quantite'] * $produit['prix']; ?> €</td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td class="total-align" colspan="4"><strong>Total :</strong></td>
                <td class="total-cell"><?php echo $total; ?> €</td>
            </tr>
            </table>
    <?php
    // Vider le panier en détruisant toutes les données de session
    session_destroy();
    ?>
</body>
</html>
