<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chroropleth Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

     <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        #map { height: 600px; }

     </style>
</head>
<body>
<div id="map"></div>

     <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

     <script>
            var map = L.map('map').setView([ -0.4728082, 108.4682188], 4);
           

        var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        const regencies = <?php echo json_encode($regencies, 15, 512) ?>
        // const regencies = <?php echo json_encode($regencies); ?>;

        const regencyData = regencies.map(regency => ({
            type: "Feature",
            properties: {
                name: regency.name,
                id: regency.id,
                population: regency.population,
            }, 
            geometry: {
                type: regency.type_polygon,
                coordinates: JSON.parse(regency.polygon),
            }
        }));

        const geoJson = {
        type: "FeatureCollection",
        features: regencyData,
        };

        function getColor(d) {
            return d > 800000 ? '#800026' :
                d > 700000  ? '#BD0026' :
                d > 600000  ? '#E31A1C' :
                d > 500000  ? '#FC4E2A' :
                d > 400000   ? '#FD8D3C' :
                d > 300000   ? '#FEB24C' :
                d > 200000   ? '#FED976' :
                            '#FFEDA0';
        }

                function style(feature) {
            return {
                fillColor: getColor(feature.properties.population),
                weight: 2,
                opacity: 1,
                color: 'white',
                dashArray: '3',
                fillOpacity: 0.7
            };
        }

        function highlightFeature(e) {
    var layer = e.target;

    layer.setStyle({
        weight: 5,
        color: '#666',
        dashArray: '',
        fillOpacity: 0.7
    });

    layer.bringToFront();
}

function resetHighlight(e) {
    geojson.resetStyle(e.target);
}


function zoomToFeature(e) {
    map.fitBounds(e.target.getBounds());
}

function onEachFeature(feature, layer) {
    layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: zoomToFeature
    });
}

        L.geoJson(geoJson, {style: style,  
            onEachFeature: onEachFeature
        }).addTo(map);

        var info = L.control();

info.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
    this.update();
    return this._div;
};

// method that we will use to update the control based on feature properties passed
info.update = function (props) {
    this._div.innerHTML = '<h4>Kalimatan Barat Province Population</h4>' +  (props ?
        '<b>' + props.name + '</b><br />' + props.density + ' people / mi<sup>2</sup>'
        : 'Hover over a state');
};

info.addTo(map);
     </script>
    
</body>
</html><?php /**PATH C:\xampp\htdocs\SIG\Project2\chroropleth-map\resources\views/chroropleth_map.blade.php ENDPATH**/ ?>