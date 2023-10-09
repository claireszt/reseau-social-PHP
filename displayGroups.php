<?php

include("./sessionprolong.php");

$userid = $_SESSION['id'];

$mysqli = new mysqli("localhost", "root", "root", "voisinous");
if ($mysqli->connect_errno) {
    echo ("Échec de la connexion : " . $mysqli->connect_error);
    exit();
} else {
    $queryGetListGroupe = "SELECT groupid 
    FROM groupemembers
    WHERE userid = " . $userid . ";";

    $listGroupeID = $mysqli->query($queryGetListGroupe);
    foreach ($listGroupeID as $groupeID) {
        $queryGroupInfo = "SELECT * 
        FROM groupes
        WHERE id = " . $groupeID['groupid'] . ";";
        $groupInfo = $mysqli->query($queryGroupInfo);
        foreach ($groupInfo as $groupe) {
            echo "<li><a href='groupPage.php'>" . $groupe['name'] . "</a></li>";
        }
    }



}

?>