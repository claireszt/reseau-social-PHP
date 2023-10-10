<?php 

function joinGroup ($mysqli, $groupeid) {
    $userid = $_SESSION['id'];

$mysqli = new mysqli("localhost", "root", "root", "voisinous");
if ($mysqli->connect_errno) {
    echo ("Échec de la connexion : " . $mysqli->connect_error);
    exit();
} else {
    $queryJoinGroupe = "INSERT INTO groupemembers (userid, groupid) "
        . "VALUES ("
        . "'" . $userid . "',"
        . "'" . $groupeid . "');";

    $joinGroupe = $mysqli->query($queryJoinGroupe);

    if ($joinGroupe != '') {
        header("Location: ./groupPage.php?id=" . $groupeid );
        exit();
    }
}
}
?>