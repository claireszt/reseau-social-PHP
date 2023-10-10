<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>

    <link rel="icon" type="image/png" href="logo.png" />

    <link rel="stylesheet" href="./htmlcss/stylesheets/_body.css">

</head>

<body>
    <?php include("htmlcss/navbar.php") ?>

    <main>
        <section class="center" id="afterRegister">
            <?php
            $mysqli = new mysqli("localhost", "root", "root", "voisinous");
            //verification
            if ($mysqli->connect_errno) {
                echo ("Échec de la connexion : " . $mysqli->connect_error);
                exit();
            } else {
                $pseudo = $_POST["pseudo"];
                $mail = $_POST["mail"];
                $mdphash = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
                $localisation = $_POST["localisation"];
                $latitude = $_POST['lat'];
                $longitude = $_POST['lon'];
                $photo = $_FILES['img']['name'];

                // $queryCreateUser = "INSERT INTO Users (pseudo, mail, mdp, localisation, latitude, longitude, date, photo) "
                //     . "VALUES ("
                //     . "'" . $pseudo . "',"
                //     . "'" . $mail . "',"
                //     . "'" . $mdphash . "',"
                //     . "'" . $localisation
                //     . "', CURRENT_TIMESTAMP ,"
                //     . "'" . $photo . "');";
            
                // $createUser = $mysqli->query($queryCreateUser);
            
                $queryCreateUser = $mysqli->prepare("INSERT INTO Users (pseudo, mail, mdp, localisation, latitude, longitude, photo)
                VALUES (?, ?, ?, ?, ?, ?, ?)");

                $queryCreateUser->bind_param('sssidds', $pseudo, $mail, $mdphash, $localisation, $latitude, $longitude, $photo);

                $createUser = $queryCreateUser->execute();

                move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/users/' . basename($_FILES['img']['name']));

                if ($mysqli->error) {
                    echo $mysqli->error;
                    echo "  <div class='error'>
                                <p>Ce pseudo ou cette adresse email existe déjà.</p>
                                <a href='signUp.php'><button id='retry'>Réessayez</button></a>
                            </div>";
                } else {
                    echo "<div class='registered'><h2>Inscription réussie !</h2>" .
                        "<h4>Bienvenue " . $pseudo . "</h4>" .
                        "<br /> " . "
                        <a href='./signIn.php'><button id='login'>Se connecter</button></a></div>";
                }
                ;
            }
            ?>
        </section>
    </main>


</body>

</html>