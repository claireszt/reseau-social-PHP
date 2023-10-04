<?php

session_unset();

  if(!empty($_POST)) 
  {
    // Les identifiants sont transmis ?
    if(!empty($_POST['pseudo']) && !empty($_POST['mdp'])) 
    {
        $mysqli = new mysqli("localhost", "root", "root", "voisinous");
        //verification
        if ($mysqli->connect_errno)
        {
            echo("Échec de la connexion : " . $mysqli->connect_error);
            exit();
        }
        else{
            $pseudo = $_POST["pseudo"];
            $mdp = $_POST["mdp"];
            $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
            $querySearchUser = "SELECT * "
            . "FROM users "
            . "WHERE "
            . "pseudo LIKE '" . $pseudo . "'"
            ;
            $searchUser = $mysqli->query($querySearchUser);
            $result = $searchUser->fetch_assoc();
            if($result != null){
            if($mdp == $result['mdp']){
                session_start();
                $_SESSION['pseudo'] = $_POST["pseudo"];
                $_SESSION['id'] = $result['id'];
                echo "<pre>" . print_r($_SESSION, 1) . "</pre>";
                // On redirige vers le fichier admin.php
                header('Location: http://www.localhost/niveau1/admin.php');
                exit();
              }
              else{
                 $errorMessage = 'Mauvais password !';
                }
            }else{
                $errorMessage = 'Le compte spécifié est introuvable';
            }
        }
		    
        }
    }
?>
<!doctype html>
<html lang="fr">
  <head>
    <title>Formulaire d'authentification</title>
  </head>
  <body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <fieldset>
        <legend>Identifiez-vous</legend>
        <?php
          // Rencontre-t-on une erreur ?
          if(!empty($errorMessage)) 
          {
            echo '<p>', htmlspecialchars($errorMessage) ,'</p>';
          }
        ?>
       <p>
          <label for="pseudo">Pseudo :</label> 
          <input type="text" name="pseudo" id="pseudo" value="" />
        </p>
        <p>
          <label for="mdp">Password :</label> 
          <input type="password" name="mdp" id="mdp" value="" /> 
          <input type="submit" name="submit" value="Se logguer" />
        </p>
      </fieldset>
    </form>
  </body>
</html>