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
    <section id="createUserForm">
        <h1>NOUVEL UTILISATEUR</h1>
        <form action="createUser.php" method="post" enctype="multipart/form-data">
                <div>
                    <input type="text" name="pseudo" placeholder="votre pseudo" required />
                </div>
                <div>
                    <input type="email" name="mail" placeholder="votre adresse email" required />
                </div>
                <div>
                    <input type="number" name="localisation" maxlength="5" placeholder="votre code postal" required />
                </div>
                <div>
                    <input type="password" name="mdp" placeholder="votre mot de passe">
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