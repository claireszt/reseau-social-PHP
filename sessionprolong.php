<?php
// On prolonge la session
session_start();
// On teste si la variable de session existe et contient une valeur
  // Vérifie si l'utilisateur n'est pas connecté et s'il se trouve sur "acceuil.php"
  if (empty($_SESSION['pseudo']) && basename($_SERVER['SCRIPT_FILENAME']) == 'accueil.php') {
    header('Location: welcome.php');
    exit();
  }
  // Vérifie si l'utilisateur n'est pas connecté sur une autre page
  elseif (empty($_SESSION['pseudo'])) {
    header('Location: signIn.php');
    exit();
  }
?>