<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un groupe</title>

    <link rel="icon" type="image/png" href="logo.png" />

    <link rel="stylesheet" href="./htmlcss/stylesheets/_body.css">

</head>
<body>
    <?php 
    include("./sessionprolong.php");
    include("htmlcss/navbar.php");?>

    <main>
    <section class="center" id="createGroupForm">
        <h1>NOUVEAU GROUPE</h1>
        <?php
        // echo "<pre>" . print_r($_POST, 1) . "</pre>";
        $mysqli = new mysqli("localhost", "root", "root", "voisinous");
        if ($mysqli->connect_errno)
        {
            echo("Échec de la connexion : " . $mysqli->connect_error);
            exit();
        } else {
            $name = $_POST["name"];
            $description = $_POST["description"];
            $localisation = $_POST["localisation"];
            $private = '0'; // $private = $_POST["private"];
            $adminid = $_SESSION['id']; 
            $date = "CURRENT_TIMESTAMP";
            $latitude = $_POST['lat'];
            $longitude = $_POST['lon'];
            $photo = $_FILES['img']['name'];

            $queryCreateGroup = $mysqli->prepare("INSERT INTO Groupes (name, description, localisation, photo, private, latitude, longitude, adminid) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

            $queryCreateGroup->bind_param('ssissddi', $name, $description, $localisation, $photo, $private, $latitude, $longitude, $adminid);

            $createGroupe = $queryCreateGroup->execute();

            move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/groups/' . basename($_FILES['img']['name']));

            if ($mysqli->error) {
                print_r($mysqli->error);
            } else {
                echo "<section class='center'><h2>Groupe créé !</h2>" . "<a href='.groupPage.php?id=>'<button>Voir le groupe</button></a></section>";
            }
            ;
        }
        ?>

    </section>
    </main>

    
</body>
</html>