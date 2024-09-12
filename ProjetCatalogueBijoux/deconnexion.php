<?php
    session_start();
    session_destroy();
echo "<p>Vous vous êtes bien déconnecté ! Redirection dans quelques secondes...</p>";
header("refresh:3;url=index.php");
exit;  
?>