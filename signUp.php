<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="/htmlcss/stylesheets/_body.css">

</head>
<body>
    <nav><h1>NAV BAR</h1></nav> <!-- import navbar -->

    <main>
    <section id="createGroupForm">
        <h1>NOUVEL UTILISATEUR</h1>
        <form action="createUser.php" method="post" enctype="multipart/form-data">
                <div>
                    <label for="pseudo">Pseudo</label>
                    <input type="text" name="pseudo" required />
                </div>
                <div>
                    <label for="mail">Email</label>
                    <input type="email" name="mail" required />
                </div>
                <div>
                    <label for="localisation">Localisation</label>
                    <input type="number" name="localisation" maxlength="5" required />
                </div>
                <div>
                    <label for="mdp">Password</label>
                    <input type="password" name="mdp">
                </div>
                <div>
                    <label for="img">Image</label>
                    <input type="file" name="img">
                </div>
                <input type="submit">         
            
        </form>
    </section>
    </main>

    
</body>
</html>