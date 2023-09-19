<?php
session_start();
// Recupérer tout les sessions dans un tableaux et la detruire // ce qui cause la deconnection et le rédirige vers la page de connexion
$_SESSION = array();
session_destroy();
header('location: index.php');
?>