<?php
session_start();

// Vider le panier en détruisant la variable de session
unset($_SESSION['panier']);

// Rediriger vers la page d'acceuil
header('Location: index.php');
exit();
?>
