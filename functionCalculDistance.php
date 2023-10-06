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

    $queryUserGeoloc = "SELECT * FROM users WHERE id=8;"; //à modifier par l'id de user
    $userGeoloc = $mysqli->query($queryUserGeoloc);
    $user = $userGeoloc->fetch_array();

    $queryAllGroups = "SELECT * FROM Groupes";
    $allGroups = $mysqli->query($queryAllGroups);

    $groups = array();
    while($group = $allGroups->fetch_assoc()) {
        $group['distanceToUser'] = calculDistance($user['latitude'], $user['longitude'], $group['latitude'], $group['longitude']);
        array_push($groups, $group);
    }

    function compareDistances($a, $b) {
        return $a['distanceToUser'] - $b['distanceToUser'];
    }

    usort($groups, 'compareDistances');

    foreach($groups as $group) {
        if($group['distanceToUser']<1){
            $group['distanceToUser'] = round(($group['distanceToUser'] * 1000), 0, PHP_ROUND_HALF_UP) . " m";
        }
        else{
            $group['distanceToUser'] = round($group['distanceToUser'], 1, PHP_ROUND_HALF_UP) . " km";
        }
        echo "<p>Le groupe " . $group['name'] . " est à " . $group['distanceToUser'] . "</p>";
    }

}

?>