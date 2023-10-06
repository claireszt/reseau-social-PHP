<?php
// $queryCreateGroup = $mysqli->prepare("INSERT INTO Groupes (name, description, localisation, photo, private, latitude, longitude, adminid) 
//             VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

// $queryCreateGroup->bind_param('ssissddi', $name, $description, $localisation, $photo, $private, $latitude, $longitude, $adminid);

// $createGroupe = $queryCreateGroup->execute();

function toRad($value){
    return $value * pi() / 180;
}
function calcDistance($lat1, $lon1, $lat2, $lon2){
    $R = 6371; // km
    $dLat = toRad($lat2-$lat1);
    $dLon = toRad($lon2-$lon1);
    $lat1 = toRad($lat1);
    $lat2 = toRad($lat2);

    $a = sin($dLat/2) * sin($dLat/2) +sin($dLon/2) * sin($dLon/2) * cos($lat1) * cos($lat2); 
    $c = 2 * atan2(sqrt($a), sqrt(1-$a)); 
    $d = $R * $c;
    return $d;
}

$mysqli = new mysqli("localhost", "root", "root", "voisinous");
//verification
if ($mysqli->connect_errno) {
    echo ("Échec de la connexion : " . $mysqli->connect_error);
    exit();
} else {
    $queryUserGeoloc = "SELECT * FROM users WHERE id=8;";
    $userGeoloc = $mysqli->query($queryUserGeoloc);
    foreach ($userGeoloc as $user) {
        $userLatitude = $user['latitude'];
        $userLongitude = $user['longitude'];
    }

    $queryAllGroups = "SELECT * FROM Groupes";
    $allGroups = $mysqli->query($queryAllGroups);
    $groupsToCheck = array();
    foreach ($allGroups as $group) {
        $groupToCheck['latitude'] = $group['latitude'];
        $groupToCheck['longitude'] = $group['longitude'];
        array_push($groupsToCheck, $groupToCheck);

    }

    foreach ($groupsToCheck as $group){
        print_r($group);
        $group['distanceToUser'] = calcdistance($userLatitude,$userLongitude,$group['latitude'],$group['longitude']);
        echo "<p>" . "Le groupe est à " . $group['distanceToUser'] . "</p>" ;
    }
}




?>