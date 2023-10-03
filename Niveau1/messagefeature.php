
    <?php include ("./header.php"); ?>


    <?php
             $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
            //verification
            if ($mysqli->connect_errno)
            {
             echo("Échec de la connexion : " . $mysqli->connect_error);
            exit();
            }
    ?>




    <?php
            
                $messageSql = "SELECT * FROM `Posts`";
                $lesInformations = $mysqli->query($messageSql);
                // Vérification
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                    exit();
                } else {
                    $message= $_POST["message"];

                    $queryCreateMessage = "INSERT INTO `Posts` (`id`, `content`, `userid`, `date`, `groupeid`, `principale`) 
                    VALUES (NULL, 'Hello World ! ', '1', '2023-10-03 11:23:36', '4', '1');"
                }




?>
  