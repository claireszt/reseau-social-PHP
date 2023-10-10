<?php
include("sessionprolong.php");

session_destroy();

header('Location: ./signIn.php');
exit();

?>