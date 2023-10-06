<?php
// $queryCreateGroup = $mysqli->prepare("INSERT INTO Groupes (name, description, localisation, photo, private, latitude, longitude, adminid) 
//             VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

// $queryCreateGroup->bind_param('ssissddi', $name, $description, $localisation, $photo, $private, $latitude, $longitude, $adminid);

// $createGroupe = $queryCreateGroup->execute();

function toRad($value)
{
    return $value * pi() / 180;
}
function calculDistance($lat1, $lon1, $lat2, $lon2)
{
    $R = 6371; // km
    $dLat = toRad($lat2 - $lat1);
    $dLon = toRad($lon2 - $lon1);
    $lat1 = toRad($lat1);
    $lat2 = toRad($lat2);

    $a = sin($dLat / 2) * sin($dLat / 2) + sin($dLon / 2) * sin($dLon / 2) * cos($lat1) * cos($lat2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $d = $R * $c;

    return $d;
}

function sortByDist($group) {

}

$mysqli = new mysqli("localhost", "root", "root", "voisinous");
//verification
if ($mysqli->connect_errno) {
    echo ("Échec de la connexion : " . $mysqli->connect_error);
    exit();
} else {

    $queryUserGeoloc = "SELECT * FROM users WHERE id=8;";
    $userGeoloc = $mysqli->query($queryUserGeoloc);
    $user = $userGeoloc->fetch_array();

    $queryAllGroups = "SELECT * FROM Groupes";
    $allGroups = $mysqli->query($queryAllGroups);
    print_r($allGroups);
    while($row = $allGroups->fetch_assoc()) {
        print_r($row);
        $group = $row;
    }
    $groups = $allGroups->fetch_assoc();

    foreach ($groups as $group) {
        // print_r($group);
        $group['distanceToUser'] = calculDistance($user['latitude'], $user['longitude'], $group['latitude'], $group['longitude']);
        echo "<p>" . print_r($group) . "Le groupe " . $group['name'] . " est à " . $group['distanceToUser'] . " km</p>";

    }

    print_r($groups);

}




?>