<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.js"></script>
    <style>
        html,
        body {
            margin: 0;
            height: 100%;
        }

        #map {
            width: 50%;
            height: 50%;
        }
    </style>
</head>

<body>

    <div id="map"></div>

    <script>
        let localisation = new Object()

        const mapOptions = {
            center: [48.866, 2.345],
            zoom: 10
        }

        const locationOptions = {
            maximumAge: 10000,
            timeout: 5000,
            enableHighAccuracy: true
        };

        var map = new L.map("map", mapOptions);

        var layer = new L.TileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            { attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors' });

        map.addLayer(layer);

        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(handleLocation, handleLocationError, locationOptions);
        } else {
            alert("Géolocalisation indisponible");
        }

        function handleLocation(position) {
            /* Zoom avant de trouver la localisation */
            map.setZoom(16);
            /* Centre la carte sur la latitude et la longitude de la localisation de l'utilisateur */
            map.panTo(new L.LatLng(position.coords.latitude, position.coords.longitude));
            localisation.lat = position.coords.latitude
            localisation.lon = position.coords.longitude
            theMarker = L.marker([localisation.lat, localisation.lon]).addTo(map);
        }
        function handleLocationError(msg) {
            alert("Erreur lors de la géolocalisation");
        }

        let theMarker = {};

        map.on('click', function (e) {
            localisation.lat = e.latlng.lat;
            localisation.lon = e.latlng.lng;

            if (theMarker != undefined) {
                map.removeLayer(theMarker);
            };

            //Add a marker to show where you clicked.
            theMarker = L.marker([localisation.lat, localisation.lon]).addTo(map);
            console.log(localisation)
        });

    </script>

</body>

</html>