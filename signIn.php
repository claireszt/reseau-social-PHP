<?php
session_start();
session_destroy();

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
            //rajouter check et si la query ne sort pas de ligne renvoyé "le compte spécifié est introuvable
            $result = $searchUser->fetch_assoc();
            print_r($result);
            if($result != null){
            if(password_verify ($mdp ,$result['mdp'])){
                session_start();
                $_SESSION['pseudo'] = $_POST["pseudo"];
                $_SESSION['id'] = $result['id'];
                $_SESSION['localisation'] = $result['localisation'];
                // On redirige vers le fichier admin.php
                header('Location: ./accueil.php');
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
    <link rel="stylesheet" href="./htmlcss/stylesheets/_body.css">

  </head>
  <body>
    <?php include("htmlcss/navbar.php")?>

      <main>
        <section id="signIn">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

        <h1>Identifiez-vous</h1>
        <?php
          // Rencontre-t-on une erreur ?
          if(!empty($errorMessage)) 
          {
            echo '<p>', htmlspecialchars($errorMessage) ,'</p>';
          }
        ?>
       <div>
          <input type="text" name="pseudo" id="pseudo" value="" placeholder="pseudo" required/>
        </div>
        <div>
          <input type="password" name="mdp" id="mdp" value="" placeholder="mot de passe" required/> 
        </div>
        <div>
          <input type="submit" name="submit" value="Se connecter" />
        </div>
        </section>
        </main>
    </form>
  </body>
</html>