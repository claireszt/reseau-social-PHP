<?php 
include("./sessionprolong.php"); 
include("./messageFonctions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voisinous</title>

    <link rel="icon" type="image/png" href="logo.png" />

    <link rel="stylesheet" href="./htmlcss/stylesheets/_body.css">

</head>

<body>
    <?php include("./htmlcss/navbar.php") ?> 

    <main>
        <section id="feed">
            <h1>Derniers messages</h1>
            <button id="newmessage">Nouveau message</button>
            <?php getAllCommentsByUser($mysqli); ?>
        </section>
        <aside id="myGroups">
            <h1>Mes groupes</h1>
            <a href="newGroup.php"><button id="newgroup">Créer un groupe</button></a>
            <ul>
                <?php include("./displayGroups.php") ?>
            </ul>
        </aside>
    </main>


</body>

</html>