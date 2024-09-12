<?php
session_start();
include "bdd.php";

// Récupérer les catégories depuis la base de données
$categories = recupererDonnees();
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/page_authentification.css">
    <link rel="stylesheet" href="js/page_authentification.js">
    <title>Accueil</title>
</head>

<body>
    
    <header>
        <div class="haut">
            <img src="img/haut.jpg" alt="Logo Haut">
        </div>
        <div class="main-head">
            <nav>
                <div class="logo">
                    <a href="#"><img src="img/logo2.jpg" alt="Logo"></a>
                </div>
                <ul>
                    <li><a href="index.php?page=accueil">Accueil</a></li>
                    <?php 
                    foreach ($categories as $nomCategorie => $produits) 
                    {
                        echo '<li><a href="index.php?page=' . $nomCategorie . '">' . $nomCategorie . '</a></li>';
                    }
                    ?>
                    <li><a href="index.php?page=contact">Contact</a></li>
                    <li><a href="index.php?page=panier">Panier</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="main">
        <div class="menu">
        <a class="menu_noborder">Société PERLfect</a>
            <a class="menu_border" href="index.php?page=accueil">Accueil</a> <!--permet de donner la variable nécessaire au changement de page-->
            <br><br>
            <a class="menu_noborder">Nos produits</a>
            <?php 
                    foreach ($categories as $nomCategorie => $produits) 
                    {
                        echo '<a class="menu_border" href="index.php?page=' . $nomCategorie . '">' . $nomCategorie . '</a>';
                    }
                    ?>
            <br><br>
            <a class="menu_noborder" href="index.php?page=contact">Contact</a>
            <br><br>
            <?php
                if (!isset($_SESSION['email'])) {
                    // Affichez le lien qui permet de se connecter
                    echo '<a href="page_authentification.php">Se connecter</a>';
                }
                else{
                    echo '<a href="deconnexion.php">Se déconnecter</a>';
                }
            ?>
        </div>


        <?php
        if (!isset($_GET['page']) || $_GET['page'] == 'accueil'){ /** verifie si la variable existe */
            include 'accueil.php'; /**permet de récupérer la variable nécessaire au changement de page*/
        }
        else if($_GET['page'] == 'contact'){
            include 'contact.php';
        }
        else if($_GET['page'] == 'panier'){
            include 'panier.php';
        } 

        else{
            ?>
            <div class="catalogue">
            <br><br><br><br><br>
            <table class="tableau-style">
            <caption> <?php echo $_GET['page'] ?> </caption>
            <thead>
            <tr>
                <th>PRODUIT</th>
                <th>REFERENCE </th>
                <th>DESCRIPTION</th>
                <th>PRIX</th>
                <th><span id="ss">STOCK</span></th>
                <th>COMMANDE </th>
            </tr>
            </thead>
            <tbody>
            <?php

            $i = 0;

            foreach ($categories[$_GET['page']] as $produit) 
            {
                ?>
                <tr>
                    <td><img src="<?php echo $produit["image"] ?>" alt="<?php echo $produit["description"] ?>" class="zoomable"></td>
                    <td><?php echo $produit["reference"] ?></td>
                    <td><?php echo $produit["description"] ?></td>
                    <td><?php echo $produit["prix"] ?></td>
                    <td><span id ="<?php echo "s" . $i ?>"><?php echo $produit["stock"] ?></span></td>
                    <td>
                    <button class="button-add" onclick="decrementer(<?php echo $i ?>)" id="-<?php echo $i ?>" disabled>-</button>
                      <span data-stock="<?php echo $produit["stock"]?>" data-img="<?php echo $produit["image"] ?>" data-prix="<?php echo $produit["prix"] ?>" data-ref="<?php echo $produit["reference"] ?>" id="<?php echo $i ?>">0</span>
                      <button class="button-add" onclick="incrementer(<?php echo $i ?>)" id="+<?php echo $i ?>">+</button>
                      <br />
                      <button class="button-panier">Ajouter au panier</button>
                    </td>     
                </tr>
                <?php
                $i++;
            }
            ?>
        
        </tbody>
        </table>
        <br> <br> <br>
        <button class="button-stock" onclick="hide()" class="btn-stock" id="btns">Cacher stock</button>
        <?php
        }
        ?>
        
       
       <br> <br> <br>
        </div>
    </div>

    <footer>
        <div id="plan-du-site">
            <h3>Plan du site</h3>
            <ul>
                <li><a href="index.php?page=accueil">Accueil</a></li>
                <?php 
                    foreach ($categories as $nomCategorie => $produits) 
                    {
                        echo '<li><a href="index.php?page=' . $nomCategorie . '">' . $nomCategorie . '</a></li>';
                    }
                    ?>
                <li><a href="index.php?page=contact">Contact</a></li>
            </ul>
        </div>

        <div id="mentions-legales">
            <h3>Mentions Légales</h3>
            <p>PERLeFect - 2024 Copyright</p>
        </div>

        <div id="contact">
            <h3>Contact</h3>
            <p>Concepteurs: DEVE Ewen, DELINDE Marika, EL MAHFOUDY Jihan, MIRZICA-VIGE Lucas, NICOLAS Garance</p>
            <p>Société : PERLeFect</p>
            <p>Email : perlefect@gmail.com</p>
            <p>Téléphone : 01 60 83 45 12</p>
        </div>
    </footer>

</body>
<script src="js/boutonsGestionStock.js"></script>
<script src="js/zoom.js"></script>



</html>
