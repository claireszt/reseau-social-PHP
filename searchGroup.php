<?php 
include("./sessionprolong.php");
include("./functionCalculDistance.php")     ?>


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
    <title>recherche de groupes</title>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <fieldset>
            <legend>recherche de groupes </legend>
            <?php
            // Rencontre-t-on une erreur ?
            if (!empty($errorMessage)) {
                echo '<p>', htmlspecialchars($errorMessage), '</p>';
            }
            ?>
            <p>
                <label for="localisation">par localisation :</label>
                <input type="radio" name="searchMethod" id="localisation" value="localisation" />
            </p>
            </p>
            <label for="nom">par nom :</label>
            <input type="radio" name="searchMethod" id="nom" value="nom" />
            </p>
            <label for="groupSearch">Nom du groupe :</label>
            <input type="text" name="groupSearch" id="groupSearch" value="" />
            <input type="submit" name="submit" value="Rechercher" />
            </p>
        </fieldset>
        </article>
        <?php
        // Rencontre-t-on une erreur ?
        if (!empty($result)) {

            echo "<p id=searchResult>", print_r($result), "</p>";

        }
        ?>
        </main>
        </div>
</body>

</html>