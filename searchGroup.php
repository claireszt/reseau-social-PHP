
<?php 

    if(!empty($_POST['groupNameOrLocalisation']))
    {
        function verif_localisation($str){
            // On cherche tt les caractères autre que [A-z]
            preg_match("/([^A-Za-z\s])/",$str,$result);
            // si on trouve des caractère autre que A-z
            if(!empty($result)){
              return false;
            }
            return true;
          }
        $mysqli = new mysqli("localhost", "root", "root", "voisinous");
        //verification
        if ($mysqli->connect_errno){
            echo("Échec de la connexion : " . $mysqli->connect_error);
            exit();
        }
        else{
        if(verif_localisation($_POST['groupNameOrlocalisation'])){
            $searchLocalisationGroup = $_POST['groupNameOrlocalisation'];
            //mettre query pour 2 valeur groupName et localisation
            $querySearchUser = "SELECT * "
            . "FROM groupes "
            . "WHERE "
            . "localisation = '" . $searchLocalisationGroup . "'";
            $searchUser = $mysqli->query($querySearchUser);
            //rajouter check et si la query ne sort pas de ligne renvoyé "le compte spécifié est introuvable
            $result = $searchUser->fetch_assoc();
            if ($result != null){
                print_r($result);
            }
            else{
                $errorMessage = 'Aucun groupe a cette localisation !';
            }
            }
            else {
            $searchNameGroup = $_POST['groupNameOrLocalisation'];
            //mettre query pour 2 valeur groupName et localisation
            $querySearchUser = "SELECT * "
            . "FROM groupes "
            . "WHERE "
            . "name LIKE '" . $searchNameGroup . "'"
            ;
            $searchUser = $mysqli->query($querySearchUser);
            //rajouter check et si la query ne sort pas de ligne renvoyé "le compte spécifié est introuvable
            $result = $searchUser->fetch_assoc();
            if ($result != null){
            print_r($result);
            }
              else{
            $errorMessage = 'Aucun groupe ne porte ce nom !';
              }
            }
            } 
        }
            ?>  
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
                    <label for="groupNameOrLocalisation">Nom du groupe :</label> 
                    <input type="text" name="groupNameOrLocalisation" id="groupNameOrLocalisation" value="" />
                    <input type="submit" name="submit" value="Rechercher" />
                    </p>
                    </fieldset>
                </article>
            </main>
        </div>
    </body>
</html>