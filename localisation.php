<div class="containmap">
    <div id="map">
        <input name="lat" id="latitude"></input>
        <input name="lon" id="longitude"></input>
    </div>
</div>

<script>
    let localisation = new Object()
    let lat = document.getElementById("latitude")
    let lon = document.getElementById("longitude")

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
        lat.value = localisation.lat
        lon.value = localisation.lon
        theMarker = L.marker([localisation.lat, localisation.lon]).addTo(map)

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
        lat.value = localisation.lat
        lon.value = localisation.lon
        console.log(localisation)
    });

</script>