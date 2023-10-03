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
            <form action="createUser.php" method="post">
                <div>
                    <label for="pseudo">Pseudo</label>
                    <input type="text" name="pseudo" placeholder="indiquez votre pseudo" required />
                </div>
                <div>
                    <label for="mail">Email</label>
                    <input type="email" name="mail" placeholder="indiquez votre adresse email" required />
                </div>
                <div>
                    <label for="localisation">Localisation</label>
                    <input type="number" name="localisation" maxlength="5" placeholder="indiquez votre code postal" required />
                </div>
                <div>
                    <label for="mdp">Password</label>
                    <input type="password" name="mdp" placeholder="indiquez votre mot de passe">
                </div>

                <input type="submit" value="VALIDER" />

            </form>
        </section>
    </main>


</body>

</html>