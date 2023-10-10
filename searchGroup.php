<?php include("./sessionprolong.php"); ?>

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
            $querySearchGroup = "SELECT * "
                . "FROM groupes "
                . "WHERE "
                . "localisation = '" . $searchLocalisationGroup . "'";
            $searchGroup = $mysqli->query($querySearchGroup);
            $result = $searchGroup->fetch_assoc();
            if ($result != null) {
                //ajouter au besoin
            } else {
                $errorMessage = 'Aucun groupe a cette localisation !';
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
            $querySearchGroup = "SELECT * "
                . "FROM groupes "
                . "WHERE "
                . "name LIKE '" . $searchNameGroup . "'";
            $searchGroup = $mysqli->query($querySearchGroup);
            $result = $searchGroup->fetch_assoc();
            if ($result != null) {
                //ajouté au besoin 
            } else {
                $errorMessage = 'Aucun groupe ne porte ce nom !';
            }
        }

    }
}

?>
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


                <input type="text" name="groupSearch" id="groupSearch" value="" placeholder="écrivez votre recherche ici" />
                <input type="submit" name="submit" value="Rechercher" />
                </p>
            </form>
            <?php
            // Rencontre-t-on une erreur ?
            if (!empty($result)) {

                // echo "<p id=searchResult>", print_r($result), "</p>";
                echo "<p>" . $result['name'] . "</p>";

            };
            ?>

        </section>

        <aside id="distanceGroups">
            <h1>GROUPES A PROXIMITE</h1>
            <?php include("./functionCalculDistance.php") ?>
        </aside>

    </main>
</body>

</html>