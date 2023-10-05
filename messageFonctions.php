<?php 

// Connexion à la base de données.

$mysqli = new mysqli("localhost", "root", "root", "voisinous");
//verification
if ($mysqli->connect_errno) {
    echo("Échec de la connexion : " . $mysqli->connect_error);
    exit();
}

// Fonction qui récupère les commentaires des utilisateurs dans la base de données.
function setComments($mysqli) { 
    if(isset($_POST['commentSubmit']) && isset($_SESSION['pseudo'])) {
        $pseudo = $_SESSION["pseudo"];

        $content= $_POST["content"];
        $userid = $_SESSION['id']; // $userid = $_POST["userid"];
        $date = "CURRENT_TIMESTAMP";
        $groupeid = '5';
        $principale = '1'; // $principale = $_POST["principale"]; 


        $queryInsertMessage = "INSERT INTO Posts (content, userid, date, groupeid, principale) "
                    . "VALUES ('" 
                    . $content . "',"
                    . "'" . $userid . "',"
                    . "CURRENT_TIMESTAMP" . ", '"
                    . $groupeid . "',"
                    . "'" . $principale . "');";

        $createmessage = $mysqli->query($queryInsertMessage);
            if ($createmessage === TRUE) {
                echo "Données insérées avec succès.";
            } else {
                echo "Erreur lors de l'insertion : " . $mysqli->error;
            }

               $querySearchUser = "SELECT * "
                    . "FROM users "
                    . "WHERE "
                    . "pseudo LIKE '" . $pseudo . "'"
                    ;

                    $searchUser = $mysqli->query($querySearchUser);
                    $result =$searchUser->fetch_assoc();
    }
}


// Fonction qui permet d'afficher tous les pseudos, messages et groupe ID. 
function getComments($mysqli) {
    $selectComments = "SELECT * FROM Posts";
    $queryGetComments = $mysqli->query($selectComments);
   // $row = $queryGetComments->fetch_assoc();
    while ($row = $queryGetComments->fetch_assoc()) {
        echo "<div><p>";
            echo $_SESSION["pseudo"] . " a publié ";
            echo $row["content"] . " dans le groupe: " . "<br>";
            echo $row["groupeid"]."<br><br>";
        echo "</p></div>";
    }
}
?>
