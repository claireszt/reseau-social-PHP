<?php include ("./sessionprolong.php"); ?>
<?php 

if(!empty($_POST)) 
  {
    // Les identifiants sont transmis ?
    if(!empty($_POST['groupName']) && !empty($_POST['localisation'])) 
    {
        $mysqli = new mysqli("localhost", "root", "root", "voisinous");
        //verification
        if ($mysqli->connect_errno)
        {
            echo("Échec de la connexion : " . $mysqli->connect_error);
            exit();
        }
        else{
            $pseudo = $_SESSION["pseudo"];
            $searchNameGroup = $_POST['groupName'];
            $searchLocalisationGroup = $_POST['localisation']
            //mettre query pour 2 valeur groupName et localisation
            $querySearchUser = "SELECT * "
            . "FROM groupes "
            . "WHERE "
            . "name LIKE '" . $searchNameGroup . "'"
            ;
            $searchUser = $mysqli->query($querySearchUser);
            //rajouter check et si la query ne sort pas de ligne renvoyé "le compte spécifié est introuvable
            $result = $searchUser->fetch_assoc();
            print_r($result);
                //exit();
              }
              if(!empty($_POST['groupName']){
                $mysqli = new mysqli("localhost", "root", "root", "voisinous");
            //verification
            if ($mysqli->connect_errno)
            {
            echo("Échec de la connexion : " . $mysqli->connect_error);
            exit();
            }
        else{
            $pseudo = $_SESSION["pseudo"];
            $searchNameGroup = $_POST['groupName'];
            $searchLocalisationGroup = $_POST['localisation']
            //mettre query pour 2 valeur groupName et localisation
            $querySearchUser = "SELECT * "
            . "FROM groupes "
            . "WHERE "
            . "name LIKE '" . $searchNameGroup . "'"
            ;
            $searchUser = $mysqli->query($querySearchUser);
            //rajouter check et si la query ne sort pas de ligne renvoyé "le compte spécifié est introuvable
            $result = $searchUser->fetch_assoc();
            print_r($result);

              }
            }
              !empty($_POST['localisation']){

              }
        }
		    
        
    } ?>  
                    <!doctype html>
                    <html lang="fr">
                      <head>
                        <title>recherche de groupes</title>
                      </head>
                      <body>                   
                     <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <fieldset>
                    <legend>recherche de groupes </legend>
                    <?php
          // Rencontre-t-on une erreur ?
                    if(!empty($errorMessage)) 
                    {
                     echo '<p>', htmlspecialchars($errorMessage) ,'</p>';
                    }
                    ?>
                    <p>
                    <label for="groupName">Nom du groupe :</label> 
                    <input type="text" name="groupName" id="groupName" value="" />
                    </p>
                    <p>
                    <label for="localisation">localisation :</label> 
                    <input type="text" name="localisation" id="localisation" value="" /> 
                    <input type="submit" name="submit" value="Rechercher" />
                    </p>
                    </fieldset>
                </article>
            </main>
        </div>
    </body>
</html>