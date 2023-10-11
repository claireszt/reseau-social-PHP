<?php

// Connexion à la base de données.

$mysqli = new mysqli("localhost", "root", "root", "voisinous");
//verification
if ($mysqli->connect_errno) {
    echo ("Échec de la connexion : " . $mysqli->connect_error);
    exit();
}

function getLikes($postid, $mysqli)
{
    $queryLikes =
        "SELECT *
    FROM likes
    WHERE postid = " . $postid . ";";
    $resultLikes = $mysqli->query($queryLikes);
    return $resultLikes->num_rows;

}
function setLikeListener($postid)
{
    echo "<script>
    var xmlhttp = new XMLHttpRequest()
    console.log(xmlhttp)
    likeIt = document.getElementById('like')
    postid = likeIt.parentElement.parentElement.attributes.postid.value
    console.log(postid)
    likeIt.addEventListener('click', () => {
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log('like envoyé')
            }
        };
        xmlhttp.open('POST', 'sendLike.php?id=' + postid , true);
        xmlhttp.send();
        
    })
    </script>";
}
function displayMessage($message, $mysqli)
{
    $date = $message['formatted_date'];
    $heure = date('H:i', strtotime($message['date']));

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
    echo "<article class='message' postid='" . $message['id'] . "'>
    <div class='messageHeader'>
    <p> le " . $date . " à " . $heure . "</p>
        <p>par " . $user['pseudo'] . " (<a href='./groupPage.php?id=" . $message['groupeid'] . "'>" . $groupe['name'] . "</a>)</p>
    </div>
    <p>" . $message['content'] . "</p>
    <div class='messageFooter'>
        <a href='' id='like'>♥ ". $message['likes'] . "</a>
    </div>
</article>";
    setLikeListener($message['id']);
}


// Fonction qui récupère les commentaires des utilisateurs dans la base de données.
function setComments($mysqli)
{
    if (isset($_POST['commentSubmit']) && isset($_SESSION['pseudo'])) {
        $pseudo = $_SESSION["pseudo"];

        $content = $_POST["content"];
        $userid = $_SESSION['id']; // $userid = $_POST["userid"];
        $date = "CURRENT_TIMESTAMP";
        $groupeid = $_GET['id'];
        $principale = '1'; // $principale = $_POST["principale"]; 

        $queryInsertMessage = $mysqli->prepare("INSERT INTO Posts (content, userid, date, groupeid, principale) VALUES (?, ?, CURRENT_TIMESTAMP, ?, ?)");
        $queryInsertMessage->bind_param("sisi", $content, $userid, $groupeid, $principale);

        if ($queryInsertMessage->execute()) {
            echo "Message envoyé";
        } else {
            echo "Erreur lors de l'insertion : " . $queryInsertMessage->error;
        }

        $querySearchUser = $mysqli->prepare("SELECT * FROM Users WHERE pseudo LIKE ?");
        $querySearchUser->bind_param("s", $pseudo);

        if ($querySearchUser->execute()) {
            $result = $querySearchUser->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Traitement des données de l'utilisateur
                }
            }
        } else {
            echo "Erreur lors de la recherche de l'utilisateur : " . $querySearchUser->error;
        }
    }
}


// Fonction qui permet d'afficher les messages instantanées.
function getComments($mysqli)
{
    // Sélectionne tous les commentaires de tous les utilisateurs
    $selectComments = "SELECT p.content, p.date, u.pseudo 
                       FROM Posts p
                       INNER JOIN Users u ON p.userid = u.id";
    $queryGetComments = $mysqli->query($selectComments);

    $allComments = array();
    foreach ($queryGetComments as $comments) {
        array_push($allComments, $comments);
    }
    $allComments = array_reverse($allComments);
    if ($queryGetComments) {
        foreach ($allComments as $comments) {
            // Parcoure les résultats et les affiche 
            echo "<section id='groupFeed'>
                    <article class='message'>
                        <div class='messageHeader'>
                            <p>" . $comments['date'] . "</p> 
                            <p>" . $comments['pseudo'] . "</p>
                        </div>
                        <br><p>" . $comments["content"] . "</p>
                        <div class='messageFooter'>
                            <p id='like'>♥ 13</p>
                        </div>
                    </article>
                  </section>";
        }
    } else {
        echo "Erreur lors de la récupération des commentaires : " . $mysqli->error;
    }
}

function getAllCommentsByUser($mysqli)
{
    $querygetAllMessages =
        "SELECT *, DATE_FORMAT(date, '%d-%m-%Y') AS formatted_date  FROM Posts
    WHERE userid = " . $_SESSION['id'] . ";";
    $queryAllMessages = $mysqli->query($querygetAllMessages);



    $allMessages = array();
    foreach ($queryAllMessages as $message) {
        array_push($allMessages, $message);
    }
    $allMessages = array_reverse($allMessages);

    foreach ($allMessages as $message) {

        $date = $message['formatted_date'];
        $heure = date('H:i', strtotime($message['date']));

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
                        <p> le " . $date . " à " . $heure . "</p>
                        <p>par " . $user['pseudo'] . " (<a href='./groupPage.php?id=" . $message['groupeid'] . "'>" . $groupe['name'] . "</a>)</p>
                    </div>
                    <p>" . $message['content'] . "</p>
                    <div class='messageFooter'>
                        <a href='' id='like'>♥ 256</a>
                    </div>
                </article>";
    }
}

function getAllCommentsByGroup($mysqli, $groupeid)
{
    $querygetAllMessagesGroup =
        "SELECT *, DATE_FORMAT(date, '%d-%m-%Y') AS formatted_date FROM Posts
    WHERE groupeid = " . $groupeid . ";";
    $queryMessagesGroup = $mysqli->query($querygetAllMessagesGroup);

    $allMessagesGroup = array();
    foreach ($queryMessagesGroup as $message) {
        array_push($allMessagesGroup, $message);
    }
    $allMessagesGroup = array_reverse($allMessagesGroup);

    foreach ($allMessagesGroup as $message) {
        $message['likes'] = getLikes($message['id'],$mysqli);
        displayMessage($message,$mysqli);
    }

    if (empty($allMessagesGroup)) {
        echo "<p class='empty'>Aucun message dans ce groupe</p>";
    }
}

//function getAllCommentsByGroup($mysqli, $groupeid) {
//   $querygetAllMessagesGroup = 
// "SELECT * FROM Posts
// WHERE groupeid = " . $groupeid .";";
// $queryMessagesGroup = $mysqli->query($querygetAllMessagesGroup);

// $allMessagesGroup = array();
// foreach($queryMessagesGroup as $message){
//   array_push($allMessagesGroup,$message);
// }
// $allMessagesGroup = array_reverse($allMessagesGroup);

//  foreach($allMessagesGroup as $message){

//    $queryGroupName = 
//  "SELECT name FROM groupes
//  WHERE id = " . $message['groupeid'] . ";";
//  $getGroupName = $mysqli->query($queryGroupName);
//  $groupe = $getGroupName->fetch_array();

// $queryUserPseudo = 
// "SELECT pseudo FROM users
// WHERE id = " . $message['userid'] . ";";
// $getUserPseudo = $mysqli->query($queryUserPseudo);
// $user = $getUserPseudo->fetch_array();

// echo "<article class='message'>
//           <div class='messageHeader'>
//             <p>" . $message['date'] . "</p>
//           <p>par " . $user['pseudo'] . "</p>
//     </div>
//   <p>" . $message['content'] . "</p>
// <div class='messageFooter'>
//    <a href=''>♥ 256</a>
// </div>
// </article>";
// }
//}
?>