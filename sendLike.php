<?php
include("./sessionprolong.php");

$userid = $_SESSION['id'];
$postid = $_GET['id'];

$mysqli = new mysqli("localhost", "root", "root", "voisinous");
//verification
if ($mysqli->connect_errno) {
    echo("Échec de la connexion : " . $mysqli->connect_error);
    exit();
}

$querySendLike = $mysqli->prepare("INSERT INTO likes (userid ,postid)
VALUES (?,?)"); 
$querySendLike->bind_param('ii', $userid, $postid);
$sendLike = $querySendLike->execute();
print_r($sendLike);
?>