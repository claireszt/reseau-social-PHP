<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./htmlcss/stylesheets/_body.css">

</head>

<body>
    <?php include("htmlcss/navbar.php") ?>

    <main>
        <section id="afterRegister">
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
                $mdphash = password_hash($mdp, PASSWORD_DEFAULT);
                $localisation = $_POST["localisation"];
                $date = "CURRENT_TIMESTAMP";
                $photo = $_FILES['img']['name'];

                $queryCreateUser = "INSERT INTO Users (pseudo, mail, mdp, localisation, date, photo) "
                    . "VALUES ("
                    . "'" . $pseudo . "',"
                    . "'" . $mail . "',"
                    . "'" . $mdphash . "',"
                    . "'" . $localisation
                    . "', CURRENT_TIMESTAMP ,"
                    . "'" . $photo . "');";

                $createUser = $mysqli->query($queryCreateUser);

                move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/users/' . basename($_FILES['img']['name']));

                if ($mysqli->error) {
                    echo "  <div class='error'>
                                <p>Ce pseudo ou cette adresse email existe déjà.</p>
                                <a href='signUp.php'><button id='retry'>Réessayez</button></a>
                            </div>";
                } else {
                    echo "<div class='registered'><h2>Inscription réussie !</h2>" .
                        "<h4>Bienvenue " . $pseudo . "</h4>" .
                        "<br /> " . "
                        <a href='/signIn.php'><button id='login'>Se connecter</button></a></div>";
                }
                ;
            }
            ?>
        </section>
    </main>


</body>

</html>