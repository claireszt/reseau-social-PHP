<?php
include("./sessionprolong.php");
$userid = $_SESSION['id'];
$groupid = $_GET['id'];


$mysqli = new mysqli("localhost", "root", "root", "voisinous");
if ($mysqli->connect_errno) {
    echo ("Échec de la connexion : " . $mysqli->connect_error);
    exit();
} else {
    $queryJoinGroupe = "INSERT INTO groupemembers (userid, groupid) "
        . "VALUES ("
        . "'" . $userid . "',"
        . "'" . $groupid . "');";

    $joinGroupe = $mysqli->query($queryJoinGroupe);

    if ($joinGroupe != '') {
        header("Location: ./groupPage.php?id=" . $_GET['id'] );
        exit();
    }
}

?>