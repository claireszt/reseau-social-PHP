<?php
    $currentDate = date_default_timezone_set("Europe/Paris");
    include("messageFonctions.php");

// On prolonge la session
session_start();
// On teste si la variable de session existe et contient une valeur
if(empty($_SESSION['pseudo'])) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: ./signIn.php');
  exit();
} 
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Flux</title>         
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="/htmlcss/stylesheets/_body.css"/>
    </head>
    <body>
        <?php include("htmlcss/navbar.php")?> <!-- import navbar -->

 <?php
    // Connection à la base de données
   // $displayAllMessages = "";
    
    
     
        // Vérification 
         //if(isset($_POST['envoyer']) && isset($_SESSION['pseudo'])) {
           //         $pseudo = $_SESSION["pseudo"];

             //       $content= $_POST["content"];
               //     $userid = $_SESSION['id']; // $userid = $_POST["userid"];
                 //   $date = "CURRENT_TIMESTAMP";
                   // $groupeid = '5'; // $groupeid = $_POST["groupeid"];
                  //  $principale = '1'; // $principale = $_POST["principale"]; 

                    // Insertion des données dans la table "Posts".
                 //   $queryInsertMessage = "INSERT INTO Posts (content, userid, date, groupeid, principale) "
                  //  . "VALUES ('" 
                   // . $content . "',"
                   // . "'" . $userid . "',"
                   // . "CURRENT_TIMESTAMP" . ", '"
                   // . $groupeid . "',"
                   // . "'" . $principale . "');";

              //      $querySearchUser = "SELECT * "
                //    . "FROM users "
                  //  . "WHERE "
                 //   . "pseudo LIKE '" . $pseudo . "'"
                   // ;

                 //   $searchUser = $mysqli->query($querySearchUser);
                 //   $result =$searchUser->fetch_assoc();

                    // Vérification
                   // $createmessage = $mysqli->query($queryInsertMessage);
                    //if ($createmessage === TRUE) {
                   //     echo "Données insérées avec succès.";
                    //} else {
                      //  echo "Erreur lors de l'insertion : " . $mysqli->error;
                    //}
                    // Récupération des données de la colonne "content" dans la table "Posts"
                   // $displayAllMessages = "SELECT * FROM Posts";
                 //       $lesInformations = $mysqli->query($displayAllMessages);
                   //     $displayMessage = $lesInformations->fetch_assoc();
                    //}
                
              ?>

            <?php 
            echo "<form action='".setComments($mysqli)."' method='POST'>
                    <textarea name='content' style='color:grey;' placeholder='Ecrivez quelque chose ...'></textarea>
                    <button type=submit value='envoyer' name='commentSubmit'>Envoyer</button>
                    <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
                </form>";
            echo "<p>"
            ?>
    </body>
<html>
  