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
    $selectComments = "SELECT content FROM Posts";
    $queryGetComments = $mysqli->query($selectComments);
   // $row = $queryGetComments->fetch_assoc();
    while ($row = $queryGetComments->fetch_assoc()) {
        echo "<div><p>";
            echo $_SESSION["pseudo"] . " a publié ";
            echo $row["content"] . " dans le groupe: " . "<br>";
         //   echo $row["groupeid"]."<br><br>";
        echo "</p></div>";
    }
}

function getAllCommentsByUser($mysqli) {
    $querygetAllMessages = 
    "SELECT * FROM Posts
    WHERE userid = " . $_SESSION['id'] . ";";
    $queryAllMessages = $mysqli->query($querygetAllMessages);

    $allMessages = array();
    foreach($queryAllMessages as $message){
        array_push($allMessages,$message);
    }
    $allMessages = array_reverse($allMessages);

    foreach($allMessages as $message){

        $queryGroupName = 
        "SELECT name FROM groupes
        WHERE id = " . $message['groupeid'] . ";";
        $getGroupName = $mysqli->query($queryGroupName);
        $groupe = $getGroupName->fetch_array();

        $queryUserPseudo = 
        "SELECT pseudo FROM users
        WHERE id = " . $message['userid'] . ";";
        $getUserPseudo = $mysqli->query($queryUserPseudo);
        $user = $getUserPseudo->fetch_array();

        echo "<article class='message'>
                    <div class='messageHeader'>
                        <p>" . $message['date'] . "</p>
                        <p>par " . $user['pseudo'] . " (<a href='./groupPage.php?id=". $message['groupeid'] . "'>" . $groupe['name'] . "</a>)</p>
                    </div>
                    <p>" . $message['content'] . "</p>
                    <div class='messageFooter'>
                        <a href=''>♥ 256</a>
                    </div>
                </article>";
    }
}

function getAllCommentsByGroup($mysqli, $groupeid) {
    $querygetAllMessagesGroup = 
    "SELECT * FROM Posts
    WHERE userid = " . $_SESSION['id'] . " AND groupeid = " . $groupeid .";";
    $queryMessagesGroup = $mysqli->query($querygetAllMessagesGroup);

    $allMessagesGroup = array();
    foreach($queryMessagesGroup as $message){
        array_push($allMessagesGroup,$message);
    }
    $allMessagesGroup = array_reverse($allMessagesGroup);

    foreach($allMessagesGroup as $message){

        $queryGroupName = 
        "SELECT name FROM groupes
        WHERE id = " . $message['groupeid'] . ";";
        $getGroupName = $mysqli->query($queryGroupName);
        $groupe = $getGroupName->fetch_array();

        $queryUserPseudo = 
        "SELECT pseudo FROM users
        WHERE id = " . $message['userid'] . ";";
        $getUserPseudo = $mysqli->query($queryUserPseudo);
        $user = $getUserPseudo->fetch_array();

        echo "<article class='message'>
                    <div class='messageHeader'>
                        <p>" . $message['date'] . "</p>
                        <p>par " . $user['pseudo'] . "</p>
                    </div>
                    <p>" . $message['content'] . "</p>
                    <div class='messageFooter'>
                        <a href=''>♥ 256</a>
                    </div>
                </article>";
    }
}

    ?>