<?php
// session_start();
$userid = '1';
$groupid = '2';
// $userid = $_SESSION['id'];

$mysqli = new mysqli("localhost", "root", "root", "voisinous");
if ($mysqli->connect_errno)
{
    echo("Échec de la connexion : " . $mysqli->connect_error);
    exit();
}
else {
    $queryJoinGroupe = "INSERT INTO groupemembers (userid, groupid) "
    . "VALUES (" 
    . "'" . $userid . "'," 
    . "'" . $groupid . "');" ;

$joinGroupe = $mysqli->query($queryJoinGroupe);
    if($joinGroupe!='')
    {
        echo 'Vous avez rejoint le groupe';
    }
}

?>

                