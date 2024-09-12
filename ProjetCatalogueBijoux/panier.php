<link rel="stylesheet" href="css/contact.css">
<section>
        <h2>Panier</h2><br /><br />
        <table>
            <tr>
                <th>Image</th>
                <th>Référence</th>
                <th>Quantité</th>
                <th>Prix à l'unité</th>
            </tr>
            <?php
            if (!empty($_SESSION['panier'])) {
                // Afficher les produits du panier
                foreach ($_SESSION['panier'] as $produit) {
                    ?>
                    <tr>
                        <td><img src="<?php echo $produit["image"] ?>" class="panier-image"></td>
                        <td><?php echo $produit["reference"] ?></td>
                        <td><?php echo $produit["quantite"] ?></td>
                        <td><?php echo $produit["prix"] ?></td>
                    </tr>
                <?php   
                }
                if (!isset($_SESSION['email'])) {
                    echo '<p>Vous devez vous connecter pour pouvoir faire une commande </p>';
                }
            } else {
                if( empty($_SESSION['panier']) && isset($_SESSION['email']  ))
                {
                    echo '<tr><td colspan="4">Votre panier est vide.</td></tr>';
                }
            }
            ?>
        </table>
        <?php
            if (!empty($_SESSION['panier']) && isset($_SESSION['email'])) {
                ?>
                
                <form action="vider_panier.php" method="post">  
                    <input type="submit" name="viderPanier" value="Vider le Panier">
                </form>
                <br><br>
                <form action="confirmer_commande.php" method="post">
                    <input type="submit" name="confirmerPanier" value="Confirmer la commande">
                </form>
                <?php
            }
            ?>
            
    </section>

