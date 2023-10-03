<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Flux</title>         
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
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

    <div>


    <?php
            
                $messageSql = "SELECT * FROM `Posts`";
                $lesInformations = $mysqli->query($messageSql);
                // Vérification
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                    exit();
                }





        <input type="text" placeholder="type something..." ></input>
        <p><?<php echo $_POST ?></p>
    </div>
    </body>
</html>