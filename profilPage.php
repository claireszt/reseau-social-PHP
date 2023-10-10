<?php
include("./sessionprolong.php");
$userid = $_SESSION['id'];

$mysqli = new mysqli("localhost", "root", "root", "voisinous");
if ($mysqli->connect_errno) {
    echo ("Échec de la connexion : " . $mysqli->connect_error);
    exit();
} else {
        $querySearchUser = "SELECT *, DATE_FORMAT(date, '%d-%m-%Y') AS formatted_date "
        . "FROM users "
        . "WHERE "
        . "id = '" . $userid . "'";
        $searchUser = $mysqli->query($querySearchUser);
        $resultUser = $searchUser->fetch_assoc();
    if(!empty ($_POST)){
    $pseudo = $resultUser["pseudo"];
    $mail = $resultUser["mail"];
    $mdphash = $_POST["mdp"]== $resultUser["mail"] ? $resultUser["mdp"] : password_hash($_POST["mdp"], PASSWORD_DEFAULT);
    $localisation = $_POST["localisation"]== $resultUser["localisation"] ? $resultUser["localisation"] : $_POST["localisation"];
    $latitude = $_POST['lat'] != 0 ? $_POST['lat'] : $resultUser['latitude'];
    $longitude = $_POST['lon'] != 0 ? $_POST['lon'] : $resultUser['longitude'];
    $photo = $_FILES['img']['name']==null ? $resultUser['photo'] : $_FILES['img']['name'];

    // $queryCreateUser = "INSERT INTO Users (pseudo, mail, mdp, localisation, latitude, longitude, date, photo) "
    //     . "VALUES ("
    //     . "'" . $pseudo . "',"
    //     . "'" . $mail . "',"
    //     . "'" . $mdphash . "',"
    //     . "'" . $localisation
    //     . "', CURRENT_TIMESTAMP ,"
    //     . "'" . $photo . "');";

    // $createUser = $mysqli->query($queryCreateUser);
    //'INSERT INTO tenu_de_la_semaine (id,styliste,haut_1,haut_2,bas,chaussure) VALUES(?,?,?,?,?,?)'
    //: 'UPDATE tenu_de_la_semaine set styliste = ?,haut_1 = ?,haut_2 = ?,bas = ?,chaussure = ? WHERE id = ?';

    $querymodifyUser = $mysqli->prepare("UPDATE Users set pseudo = ?,mail = ?,mdp = ?,localisation = ?,latitude = ?,longitude = ?,photo = ? WHERE id = ? ");

    $querymodifyUser->bind_param( 'sssiddsi',$pseudo, $mail, $mdphash, $localisation, $latitude, $longitude, $photo, $userid);

    $modifyUser = $querymodifyUser->execute();

    move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/users/' . basename($_FILES['img']['name']));

    header('Location: ./profilPage.php');
    exit();
}
}
 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
  crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
  crossorigin=""></script>


  <!-- Load Esri Leaflet from CDN -->
  <script src="https://unpkg.com/esri-leaflet@2.4.1/dist/esri-leaflet.js"
  integrity="sha512-xY2smLIHKirD03vHKDJ2u4pqeHA7OQZZ27EjtqmuhDguxiUvdsOuXMwkg16PQrm9cgTmXtoxA6kwr8KBy3cdcw=="
  crossorigin=""></script>

  <!-- Load Esri Leaflet Geocoder from CDN -->
  <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.css"
    integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
    crossorigin="">
  <script src="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.js"
    integrity="sha512-HrFUyCEtIpxZloTgEKKMq4RFYhxjJkCiF5sDxuAokklOeZ68U2NPfh4MFtyIVWlsKtVbK5GD2/JzFyAfvT5ejA=="
    crossorigin=""></script>
    

    <title>Mon profil</title>

    <link rel="stylesheet" href="./htmlcss/stylesheets/_body.css">
    <link rel="icon" type="image/png" href="logo.png" />


</head>

<body>
    <?php include("./htmlcss/navbar.php") ?> 

    <main>
        <section class='center' id="userInfo">
            <h1><?php echo $resultUser['pseudo']?></h1>
            <p>Compte créé le <?php echo $resultUser['formatted_date'] ?></p>
            <a href="./logOut.php">Se déconnecter</a>

        <form id="formUserProfile" action="/profilPage.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" class="readonly" value="<?php echo $resultUser['mail']; ?>" readonly>
        </div>

        <div>
            <label for="localisation">Localisation</label>
            <input type="number" id="localisation" name="localisation" value="<?php echo $resultUser['localisation']; ?>">
        </div>

        <div>
            <label for="mdp">Mot de passe</label>
            <input type="password" id="mdp" name="mdp" value="<?php echo $resultUser['mdp']; ?>">
        </div>

        <div>
            <label for="img">Photo de profil</label>
            <img src='./uploads/users/<?php echo $resultUser['photo']; ?>' style="width:20%">
            <input type="file" id="img" name="img">
        </div>

        <input class="greyBtn" id="confirmModif" type="submit" value="Valider les modifications" />
                <?php include("./localisation.php") ?> 
        </form>

       <!-- <ul>
        <?php
        //  echo "<li> adresse email :" . $resultUser['mail'] ."</li>";
        //  echo "<li> localisation:" . $resultUser['localisation'] ."</li>";
        //  echo "<img src='./uploads/users/".$resultUser['photo']."'/>";
         ?>
        </ul> -->
        </section>

        <!-- <section id="modifyForm">
            <h1>Modifier Profil de <?php echo $resultUser['pseudo']?></h1>
            <form action="/profilPage.php" method="post" enctype="multipart/form-data">
                <div>
               
                </div>
                <div>
                    <input type="number" name="localisation" maxlength="5" placeholder="votre code postal" />
                </div>
                <div>
                    <input type="password" name="mdp" placeholder="votre mot de passe">
                </div>
                <div>
                    <input type="file" name="img" placeholder="votre photo de profil">
                </div>
                <input type="submit" value="VALIDER" />
                
            </form> -->
</section>
            
         

</body>

</html>