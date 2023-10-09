<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Ajoute la librairie pour la map -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.js"></script>

    <title>Document</title>

    <link rel="stylesheet" href="./htmlcss/stylesheets/_body.css">

</head>

<body>
    <?php include("htmlcss/navbar.php")?>

    <main>
    <section id="createForm">
        <h1>NOUVEAU GROUPE</h1>
        <form action="createGroupe.php" method="post" enctype="multipart/form-data">
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