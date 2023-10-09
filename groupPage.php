<?php 
$currentDate = date_default_timezone_set("Europe/Paris");
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

            
           // print_r($resultUserForGroup);
           }
        }


        ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voisinous</title>

    <link rel="stylesheet" href="./htmlcss/stylesheets/_body.css">
    <link rel="stylesheet" href="./htmlcss/stylesheets/groupPage.css">

</head>

<body>
    <?php include("htmlcss/navbar.php") ?>
    <?php include("messageFonctions.php") ?>

    <main>
        <aside id="groupProfile">
            <article id="groupHeader">
                <img
                    src="./uploads/groups/<?php echo $resultGroup['photo']?>" />
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
        <section id="groupFeed">
        <?php 
            echo "<form action='".setComments($mysqli)."' method='POST'>
                    <textarea name='content' style='color:grey;' placeholder='Ecrivez quelque chose ...'></textarea>
                    <button type=submit value='envoyer' name='commentSubmit'>Envoyer</button>
                    <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
                </form>";

            echo "<form action='".getComments($mysqli)."' method='POST'>
                </form>";
                ?>
            <button id="newmessage">Nouveau message</button>
            <article class="message">
                <div class="messageHeader">
                    <p>5 octobre 2023</p>
                    <p>par Claire</p>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim dignissim est ut elementum. Sed lacinia purus in mi tempor posuere. Proin eget lacinia turpis, a vulputate enim. Curabitur semper suscipit diam, et tincidunt ligula vestibulum sed. Curabitur ac ligula at libero scelerisque tristique id non odio. Phasellus vel ante quam. Sed semper eu orci laoreet interdum. Nullam vel est id lectus dignissim luctus congue eget tellus. Sed suscipit leo ut efficitur dictum. Maecenas et rutrum sapien. Etiam mollis venenatis odio, ut lobortis dui commodo ac. Maecenas et venenatis orci, eget viverra risus. Integer viverra hendrerit augue at accumsan.</p>
                <div class="messageFooter">
                    <p>♥ 13</p>
                </div>
            </article>
           
            <article class="message">
                <div class="messageHeader">
                    <p><?php echo $row['date'] ?></p>
                    <p><?php echo $_SESSION['pseudo'] ?></p>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim dignissim est ut elementum. Sed lacinia purus in mi tempor posuere. Proin eget lacinia turpis, a vulputate enim. Curabitur semper suscipit diam, et tincidunt ligula vestibulum sed. Curabitur ac ligula at libero scelerisque tristique id non odio. Phasellus vel ante quam. Sed semper eu orci laoreet interdum. Nullam vel est id lectus dignissim luctus congue eget tellus. Sed suscipit leo ut efficitur dictum. Maecenas et rutrum sapien. Etiam mollis venenatis odio, ut lobortis dui commodo ac. Maecenas et venenatis orci, eget viverra risus. Integer viverra hendrerit augue at accumsan.</p>
                <div class="messageFooter">
                    <p>♥ 13</p>
                </div>
            </article>
           
        </section>
    </main>

</body>

</html>