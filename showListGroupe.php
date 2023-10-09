<?php

include("./sessionprolong.php");

$mysqli = new mysqli("localhost", "root", "root", "voisinous");
if ($mysqli->connect_errno) {
    echo ("Échec de la connexion : " . $mysqli->connect_error);
    exit();
} else {
    $queryGetListGroupe = "SELECT groupid 
    FROM groupemembers
    WHERE userid = " . $userid . ";";

    $listGroupe = $mysqli->query($queryGetListGroupe);
    foreach ($listGroupe as $groupe) {
        echo ("<p> ID du groupe : " . $groupe['groupid'] . "<p>");
    }

}

?>