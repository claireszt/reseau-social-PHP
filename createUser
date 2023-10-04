<?php
        /**
         * Etape 1: Ouvrir une connexion avec la base de donnée.
         */
        // on va en avoir besoin pour la suite
        $mysqli = new mysqli("localhost", "root", "root", "voisinous");
        //verification
        if ($mysqli->connect_errno)
        {
            echo("Échec de la connexion : " . $mysqli->connect_error);
            exit();
        }
        else{

            $id = "";
            $pseudo = $_POST["pseudo"];
            $mail = $_POST["mail"];
            $mdp = $_POST["mdp"];
		    // peut être stocké dans la base de données
		    $mdphash = password_hash($mdp, PASSWORD_DEFAULT);
            $localisation = $_POST["localisation"];
            $date = "CURRENT_TIMESTAMP"
            $photo="";


            $queryCreateUser = "INSERT INTO "Users" ("id", "pseudo", "mail", "mdp", "localisation", "date", "photo") VALUES (NULL, "$pseudo", "$mail", "$mdphash", "$localisation", CURRENT_TIMESTAMP, NULL)
            ";

            $createUser = $mysqli->query($queryCreateUser)

            $queryAfficherAllUsers = SELECT * FROM `Users`;
                $lesInformations = $mysqli->query($queryAfficherAllUsers);
                $result = $lesInformations->fetch_assoc();
        }
        ?>
    
    <h1> <?php echo $result ?><h1/>


        //pour verifier mdp =>password_verify ( string $password , string $hash ) : bool