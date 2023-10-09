<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Ajoute la librairie pour la map -->
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

    <title>Document</title>

    <link rel="stylesheet" href="./htmlcss/stylesheets/_body.css">

</head>

<body>
    <?php include("./sessionprolong.php"); ?>
    <?php include("./htmlcss/navbar.php")?>

    <main>
    <section id="createFormGroup">
        <form action="createGroupe.php" method="post" enctype="multipart/form-data">
        <h1>NOUVEAU GROUPE</h1>

                <div>
                    <input type="text" name="name" placeholder="nom du groupe" required />
                </div>
                <div>
                    <textarea type="text" name="description" placeholder="description" rows="1"></textarea>
                </div>
                <div>
                    <input type="number" name="localisation" maxlength="5" placeholder="code postal" required />
                </div>
                <div class="checkbox">
                    <label for="checkbox">Privé ?</label>
                    <input type="checkbox" name="private" id="checkbox">
                </div>
                <div>
                    <input type="file" name="img" placeholder="votre photo de profil">
                </div>
                <input type="submit" value="VALIDER" /> 
                
                <?php include("./localisation.php") ?>       

            </form>


        </section>
    </main>


</body>

</html>