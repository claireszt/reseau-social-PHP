<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Flux</title>         
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
    <?php include ("./header.php"); ?>

    <?php
    echo "<pre>" . print_r($_POST, 1) . "</pre>";
    // Connection à la base de données

             $mysqli = new mysqli("localhost", "root", "root", "voisinous");
            //verification
            if ($mysqli->connect_errno)
            {
             echo("Échec de la connexion : " . $mysqli->connect_error);
            exit();
            } else {
                if(isset($_POST['envoyer']))
                {
                    $id= "";
                    $content= $_POST["content"];
                    $userid = $_POST["userid"];
                    $date = "CURRENT_TIMESTAMP";
                    $groupeid = $_POST["groupeid"];
                    $principale = $_POST["principale"];


                    $queryInsertMessage = "INSERT INTO Posts (id, content, userid, date, groupeid, principale) "
                    . "VALUES (" . NULL 
                    . "'" . $content . "',"
                    . "'" . NULL . "',"
                    . CURRENT_TIMESTAMP . NULL
                    . "'" . $principale . "');";

                    $createmessage = $mysqli->query($queryInsertMessage);
                    if ($mysqli->query($queryInsertMessage) === TRUE) {
                        echo "Données insérées avec succès.";
                    } else {
                        echo "Erreur lors de l'insertion : " . $mysqli->error;
                    }

                    $displayAllMessages = "SELECT `content` FROM Posts";
                        $lesInformations = $mysqli->query($displayAllMessages);
                        $displayMessage = $lesInformations->fetch_assoc();
                    }
                }
                ?>

                <form action="messagefeature.php" method="POST">
                    <label for="message">Votre message: </label>
                    <input type=text id="message" placeholder="type something..." required></input>
                    <button type=submit value="envoyer" name="envoyer">Envoyer</button>
                    <p style="color:white;"><?php echo $displayAllMessages ?></p>
                </form>
               
    </body>
<html>
  