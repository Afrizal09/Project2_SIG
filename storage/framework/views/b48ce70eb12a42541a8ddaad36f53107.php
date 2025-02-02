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

        .info {
    padding: 6px 8px;
    font: 14px/16px Arial, Helvetica, sans-serif;
    background: white;
    background: rgba(255,255,255,0.8);
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    border-radius: 5px;
}
.info h4 {
    margin: 0 0 5px;
    color: #777;
}

.legend {
    line-height: 18px;
    color: #555;
}
.legend i {
    width: 18px;
    height: 18px;
    float: left;
    margin-right: 8px;
    opacity: 0.7;
}

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
    info.update(layer.feature.properties);
}

function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
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

        geoJson = L.geoJson(geoJson, {style: style,  
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

var legend = L.control({position: 'bottomright'});

legend.onAdd = function (map) {

    var div = L.DomUtil.create('div', 'info legend'),
        grades = [0, 200000, 300000, 400000, 500000, 600000, 700000, 800000],
        labels = [];

    // loop through our density intervals and generate a label with a colored square for each interval
    for (var i = 0; i < grades.length; i++) {
        div.innerHTML +=
            '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
            grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
    }

    return div;
};

legend.addTo(map);
     </script>
    
</body>
</html><?php /**PATH C:\xampp\htdocs\Semester 7\chroropleth-map\resources\views/chroropleth_map.blade.php ENDPATH**/ ?>