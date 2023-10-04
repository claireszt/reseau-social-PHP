<?php
// session_start();
$userid = '1';
// $userid = $_SESSION['id'];

$mysqli = new mysqli("localhost", "root", "root", "voisinous");
if ($mysqli->connect_errno)
{
    echo("Échec de la connexion : " . $mysqli->connect_error);
    exit();
}
else {
    $queryGetListGroupe = "SELECT groupid 
    FROM groupemembers
    WHERE userid = " . $userid . ";";

$listGroupe = $mysqli->query($queryGetListGroupe);
$rows = array();
    if($listGroupe!='')
    {
        while ($row = $listGroupe->fetch_assoc()) {
            $rows[] = $row;
        }
        print_r($rows);
    }
}

?>

                

$queryGetListGroupe = "SELECT userid
    FROM groupemembers
    WHERE EXISTS (
        SELECT groupeid
        FROM groupemembers
        WHERE userid = '". $userid . "' AND groupeid = '" . password . "'
        LIMIT 1
    );";