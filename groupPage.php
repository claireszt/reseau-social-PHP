<?php 
include('./sessionprolong.php');
include("./messageFonctions.php");

$mysqli = new mysqli("localhost", "root", "root", "voisinous");
    //verification
    if ($mysqli->connect_errno){
        echo("Échec de la connexion : " . $mysqli->connect_error);
        exit();
    }
    else{
        $groupId = $_GET['id']; // recupéré id du groupe grace a l'url
        $querySearchGroup = "SELECT * "
        . "FROM groupes "
        . "WHERE "
        . "id = '" . $groupId . "'";
        $searchGroup = $mysqli->query($querySearchGroup);
        $resultGroup = $searchGroup->fetch_assoc();
        
        $queryGetUserIdForGroupe = "SELECT * "
        . "FROM groupemembers "
        . "WHERE " 
        . "groupid = '" . $groupId . "'";
        $searchUserForGroup = $mysqli->query($queryGetUserIdForGroupe);
        $resultUserForGroup = array();
            foreach ($searchUserForGroup as $userId){
                    //print_r($userId);
                    $queryUserInfo = "SELECT * 
                    FROM users
                    WHERE id = " . $userId['userid'] . ";";
                    $userInfo = $mysqli->query($queryUserInfo);
                    $resultUserOfGroup = $userInfo->fetch_array();
                    array_push($resultUserForGroup,$resultUserOfGroup);
           }
           function isUserMember($mysqli){
            $queryMembership = "
            SELECT *
            FROM groupemembers
            WHERE userid = " . $_SESSION['id'] . "
            AND groupid = " . $_GET['id'] . ";";
            $membership = $mysqli->query($queryMembership);
            if($membership->num_rows>=1){
                return true;
            }
            return false;
        }
        }



        ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($resultGroup['name']); ?></title>

    <link rel="icon" type="image/png" href="logo.png" />

    <link rel="stylesheet" href="./htmlcss/stylesheets/_body.css">

</head>

<body>
    <?php include("htmlcss/navbar.php"); ?>

    <main>
    <section class="left" id="groupFeed">
            <?php 
        if(isUserMember($mysqli)==true) {
            echo "<button class='greyBtn' id='newmessage'>NOUVEAU MESSAGE</button>";
            getAllCommentsByGroup($mysqli, $groupId);
        }
        else{
            echo ("
            <a href='./joinGroupe.php?id=" . $groupId . "'><button class='redBtn' id='joingroup'>Rejoindre le groupe</button></a>
           ");
        }
        ?>
        </section>

        <aside class="right" id="groupProfile">
            <article id="groupHeader">
                <?php echo "<img src='./uploads/users/" . $resultGroup['photo'] . "'/>"; ?>
                <div>
                    <div>
                        <h3> <?php echo $resultGroup['name']?> </h3><br />
                        <span><?php echo $resultGroup['localisation']?></span>
                    </div>
                </div>
                <p><?php echo $resultGroup['description']?></p>
                <h3>Membres</h3>
                <ul>
                <?php foreach ($resultUserForGroup as $user){
                 echo "<li>" . $user['pseudo'] ."</li>";}
                 ?>
                 </ul> 
                 
                
            </article>
        </aside>
        

    </main>


</body>

</html>