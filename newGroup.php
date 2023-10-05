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
    <section id="createForm">
        <h1>NOUVEAU GROUPE</h1>
        <form action="createGroupe.php" method="post" enctype="multipart/form-data">
                <div>
                    <input type="text" name="name" placeholder="nom du groupe" required />
                </div>
                <div>
                    <textarea type="text" name="description" placeholder="description" required></textarea>
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
            
        </form>
    </section>
    </main>


</body>

</html>