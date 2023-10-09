<?php 
include("./sessionprolong.php"); 
include("./messageFonctions.php");
getAllCommentsByUser($mysqli);
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
            <article class="message">
                    <div class="messageHeader">
                        <p>4 octobre 2023</p>
                        <p>par Claire, <a href="groupPage.php">Les Bricoleurs du dimanche</a></p>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam consectetur fringilla eros, ac eleifend neque volutpat ac. Vestibulum porttitor commodo massa ac volutpat. Suspendisse potenti. Phasellus in ipsum ex. Cras eu vehicula eros. Etiam laoreet, odio nec sodales tempor, neque ligula tempor tortor, non tempus diam turpis sed purus. Aliquam pulvinar commodo accumsan. Nullam eget malesuada neque, in consectetur tellus.</p>
                    <div class="messageFooter">
                        <p>♥ 256</p>
                    </div>
                </article>
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