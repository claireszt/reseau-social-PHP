<?php
// On prolonge la session
session_start();
// On teste si la variable de session existe et contient une valeur
if(empty($_SESSION['pseudo'])) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: http://www.localhost/signIn.php');
  exit();
}
?>
<!doctype html>
<html lang="fr">
  <head>
    <title>Administration</title>
  </head>
  <body>
 <?php
    // Ici on est bien loggué, on affiche un message
    echo 'Bienve ', $_SESSION['pseudo']; 
    echo 'test ', $_SESSION['id'];
  ?>
  </body>
</html>