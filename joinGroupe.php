<?php
include("./sessionprolong.php");
$userid = $_SESSION['id'];
$groupid = '16'; // A remplacer


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
    echo "<pre>" . print_r($joinGroupe) . "</pre>";

    if ($joinGroupe != '') {
        echo 'Vous avez rejoint le groupe';
    } else {
        echo 'aa';
    }
}

?>