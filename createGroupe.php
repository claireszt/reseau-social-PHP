<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="/htmlcss/stylesheets/_body.css">

</head>
<body>
    <nav><h1>NAV BAR</h1></nav> <!-- import navbar -->

    <main>
    <section id="createGroupForm">
        <h1>NOUVEL UTILISATEUR</h1>
        <?php
        echo "<pre>" . print_r($_POST, 1) . "</pre>";
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
            $name = $_POST["name"];
            $description = $_POST["description"];
            $localisation = $_POST["localisation"];
            $private = $_POST["private"];
            $adminid = $_POST["adminid"]
            $date = "CURRENT_TIMESTAMP";

            $queryCreateGroup = "INSERT INTO Groupes (name, localisation, private, adminid, date) "
                 . "VALUES (" 
                 . "'" . $name . "'," 
                 . "'" . $localisation . "'," 
                 . "'" . $private . "'," 
                 . "'" . $adminid . "', CURRENT_TIMESTAMP);

            $createGroupe = $mysqli->query($querycreateGroupe);

            $queryAfficherAllGroups = "SELECT * FROM Groupes";
                $lesInformations = $mysqli->query($queryAfficherAllGroups);
                $result = $lesInformations->fetch_assoc();
        }
        ?>

        <h2>Groupe créé !</h2>

    </section>
    </main>

    
</body>
</html>