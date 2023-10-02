<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Actualités</title> 
        <meta name="author" content="">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <?php include ("./header.php"); ?>

        <div id="wrapper">
            <aside>
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez les derniers messages de
                        tous les utilisatrices du site.</p>
                </section>
            </aside>
            <main>      

                <?php

                include ("./bdd.php");

                $newsInfo = $mysqli->query($newsSql);
                // Vérification
                if ( ! $newsInfo)
                {
                    echo "<article>";
                    echo("Échec de la requete : " . $mysqli->error);
                    echo("<p>Indice: Vérifiez la requete  SQL suivante dans phpmyadmin<code>$newsSql</code></p>");
                    exit();
                }

                while ($post = $newsInfo->fetch_assoc())
                {
                    ?>
                    <article>
                        <h3>
                            <time><?php echo $post['created'] ?></time>
                        </h3>
                        <address><?php echo "par ".$post['author_name'] ?></address>
                        <div>
                            <p><?php echo $post['content'] ?></p>
                        </div>
                        <footer>
                            <small> <?php echo "♥ ".$post['like_number'] ?> </small>
                            <a href=""><?php echo "# ".$post['taglist'] ?></a>,
                        </footer>
                    </article>
                    <?php
                }
                ?>

            </main>
        </div>
    </body>
</html>
