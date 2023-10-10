<?php include("./sessionprolong.php"); ?>


<!doctype html>
<html lang="fr">

<head>
    <title>Recherche</title>
    <link rel="stylesheet" href="./htmlcss/stylesheets/_body.css">

    <link rel="icon" type="image/png" href="logo.png" />

</head>

<body>
    <?php include("htmlcss/navbar.php"); ?>

    <main>

        <section id="groupSearchForm">

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <h1>RECHERCHER UN GROUPE</h1>
                <?php
                // Rencontre-t-on une erreur ?
                if (!empty($errorMessage)) {
                    echo '<p>', htmlspecialchars($errorMessage), '</p>';
                }
                ?>
                <fieldset id="radioBtns">
                    <div>
                        <input type="radio" name="searchMethod" id="localisation" value="localisation" />
                        <label for="localisation">par localisation</label>
                    </div>
                    <div>
                        <input type="radio" name="searchMethod" id="nom" value="nom" />

                        <label for="nom">par nom</label>
                    </div>
                </fieldset>


                <input type="text" name="groupSearch" id="groupSearch" value=""
                    placeholder="écrivez votre recherche ici" />
                <input type="submit" name="submit" value="Rechercher" />
                </p>
            </form>
            <?php

            if (!empty($_POST)) {

                if (!empty($_POST['groupSearch']) && $_POST['searchMethod'] == "localisation") {
                    $mysqli = new mysqli("localhost", "root", "root", "voisinous");
                    //verification
                    if ($mysqli->connect_errno) {
                        echo ("Échec de la connexion : " . $mysqli->connect_error);
                        exit();
                    } else {
                        $searchLocalisationGroup = $_POST['groupSearch'];
                        $querySearchGroup = "SELECT *, DATE_FORMAT(date, '%d-%m-%Y') AS formatted_date "
                            . "FROM groupes "
                            . "WHERE "
                            . "localisation = '" . $searchLocalisationGroup . "'";
                        $searchGroup = $mysqli->query($querySearchGroup);
                        if ($searchGroup) {
                            echo "<ul>";
                            while ($result = $searchGroup->fetch_assoc()) {
                                $queryGetUsersForGroupe = "SELECT * "
                                    . "FROM groupemembers "
                                    . "WHERE groupid = '" . $result['id'] . "'";
                                $searchUsersForGroup = $mysqli->query($queryGetUsersForGroupe);

                                if ($searchUsersForGroup) {
                                    $numberOfMembers = $searchUsersForGroup->num_rows;
                                    if ($numberOfMembers > 1) {
                                        $membersTxt = 'membres';
                                    } else {
                                        $membersTxt = 'membre';
                                    }

                                } else {
                                    echo "Erreur lors de l'exécution de la requête : " . $mysqli->error;
                                }
                                echo "<li><a href='groupPage.php?id=" . $result['id'] . "'>" . $result['name'] . "</a>, créé le " . $result['formatted_date'] . " - " . $numberOfMembers . " " . $membersTxt . "</li>";
                            }
                            echo "</ul>"; 
                        } else {
                            echo "Erreur lors de l'exécution de la requête : " . $mysqli->error;
                        }
                    }
                }

                if (!empty($_POST['groupSearch']) && $_POST['searchMethod'] == "nom") {
                    $mysqli = new mysqli("localhost", "root", "root", "voisinous");
                    if ($mysqli->connect_errno) {
                        echo ("Échec de la connexion : " . $mysqli->connect_error);
                        exit();
                    } else {
                        $searchNameGroup = $_POST['groupSearch'];
                        $querySearchGroup = "SELECT *, DATE_FORMAT(date, '%d-%m-%Y') AS formatted_date "
                            . "FROM groupes "
                            . "WHERE "
                            . "name LIKE '" . $searchNameGroup . "'";
                        $searchGroup = $mysqli->query($querySearchGroup);
                        if ($searchGroup) {
                            echo "<ul>";
                            while ($result = $searchGroup->fetch_assoc()) {
                                $queryGetUsersForGroupe = "SELECT * "
                                    . "FROM groupemembers "
                                    . "WHERE groupid = '" . $result['id'] . "'";
                                $searchUsersForGroup = $mysqli->query($queryGetUsersForGroupe);

                                if ($searchUsersForGroup) {
                                    $numberOfMembers = $searchUsersForGroup->num_rows;
                                    if ($numberOfMembers > 1) {
                                        $membersTxt = 'membres';
                                    } else {
                                        $membersTxt = 'membre';
                                    }

                                } else {
                                    echo "Erreur lors de l'exécution de la requête : " . $mysqli->error;
                                }
                                echo "<li><a href='groupPage.php?id=" . $result['id'] . "'>" . $result['name'] . "</a>, créé le " . $result['formatted_date'] . " - " . $numberOfMembers . " " . $membersTxt . "</li>";
                            }
                            echo "</ul>"; 
                        } else {
                            echo "Erreur lors de l'exécution de la requête : " . $mysqli->error;
                        }
                    }
                }
            }

            ?>

        </section>

        <aside id="distanceGroups">
            <h1>GROUPES A PROXIMITE</h1>
            <?php include("./functionCalculDistance.php") ?>
        </aside>

    </main>
</body>

</html>