<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="/htmlcss/stylesheets/_body.css">

</head>

<body>
    <?php include("htmlcss/navbar.php")?>

    <main>
        <section id="createGroupForm">
            <?php

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

            
                $createUser = $mysqli->query($queryCreateUser);


                if ($mysqli->error) {
                    echo "  <div class='error'>
                                <p>Ce pseudo ou cette adresse email existe déjà.</p>
                                <a href='signUp.php'><button id='retry'>Réessayez</button></a>
                            </div>";
                } else {
                    echo "<h2>Inscription réussie !</h2>" . 
                    "Bienvenue " . $pseudo . " !" . 
                    "<br /> " . "
                    <button>Se connecter</button>";
                };


                // Fetch the result as an associative array
                // $rows = array();
            
                // while ($row = $createUser->fetch_assoc()) {
                //     $rows[] = $row;
                //     echo $row;
                // }
            }
            ?>

            <!-- //pour verifier mdp =>password_verify ( string $password , string $hash ) : bool -->



        </section>
    </main>


</body>

</html>