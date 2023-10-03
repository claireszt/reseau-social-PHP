<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="/htmlcss/stylesheets/_body.css">

</head>

<body>
    <nav>
        <h1>NAV BAR</h1>
    </nav> <!-- import navbar -->

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
            if ($mysqli->connect_errno) {
                echo ("Échec de la connexion : " . $mysqli->connect_error);
                exit();
            } else {
                $pseudo = $_POST["pseudo"];
                $mail = $_POST["mail"];
                $mdp = $_POST["mdp"];
                // peut être stocké dans la base de données
                $mdphash = password_hash($mdp, PASSWORD_DEFAULT);
                $localisation = $_POST["localisation"];
                $date = "CURRENT_TIMESTAMP";

                $queryCreateUser = "INSERT INTO Users (pseudo, mail, mdp, localisation, date, photo) "
                    . "VALUES ("
                    . "'" . $pseudo . "',"
                    . "'" . $mail . "',"
                    . "'" . $mdphash . "',"
                    . "'" . $localisation . "', CURRENT_TIMESTAMP, NULL);";
                // "INSERT INTO users (id, email, password, alias) "
                //                     . "VALUES (NULL, "
                //                     . "'" . $new_email . "', "
                //                     . "'" . $new_passwd . "', "
                //                     . "'" . $new_alias . "'"
                //                     . ");";
            
                $createUser = $mysqli->query($queryCreateUser);

                $queryAfficherAllUsers = "SELECT * FROM Users";
                $lesInformations = $mysqli->query($queryAfficherAllUsers);
                $result = $lesInformations->fetch_assoc();
            }
            ?>

            <!-- //pour verifier mdp =>password_verify ( string $password , string $hash ) : bool -->

            <h2>Inscription réussie !</h2>
            <?php echo "Bienvenue " . $pseudo . " !" ?>
            <br />
            <button>Se connecter</button>

        </section>
    </main>


</body>

</html>