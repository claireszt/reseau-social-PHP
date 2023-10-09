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
        center: [48.8616, 2.3444],
        zoom: 8.5
    }

    const locationOptions = {
        maximumAge: 10000,
        timeout: 5000,
        enableHighAccuracy: true
    };

    var map = new L.map("map", mapOptions);

    var layer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.control.scale().addTo(map);

    var southWest = L.latLng(40.80299963379161, -5.292896190349028);
    var northEast = L.latLng(51.63643116025757, 10.960406494409353);
    var bounds = L.latLngBounds(southWest, northEast);

    var searchControl = new L.esri.Geocoding.geosearch({ useMapBounds: false }, { searchBounds: bounds }, { expanded: false }).addTo(map);
    // searchControl._container.style.width = "300px"

    var results = L.layerGroup().addTo(map);
    
    let theMarker = {};
    
    map.addLayer(layer);

    
    searchControl.addEventListener
    searchControl.on('results', function (data) {
        
        results.clearLayers();

        for (var i = data.results.length - 1; i >= 0; i--) {
            if (theMarker != undefined) {
                map.removeLayer(theMarker);
            };

            theMarker = L.marker(data.results[i].latlng).addTo(map)
            localisation.lat = data.results[i].latlng.lat
            localisation.lon = data.results[i].latlng.lng
            lat.value = localisation.lat
            lon.value = localisation.lon
            console.log(localisation)
        }
    });


    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(handleLocation, handleLocationError, locationOptions);
    } else {
        alert("Géolocalisation indisponible");
    }

    function handleLocation(position) {
        map.setZoom(16);
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