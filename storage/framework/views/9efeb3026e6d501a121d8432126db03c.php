<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chroropleth Map</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #map {
            height: 600px;
        }

        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
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

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <div id="map"></div>

    <script>
        var map = L.map('map').setView([ -0.4728082, 108.4682188], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Fungsi untuk mendapatkan warna berdasarkan jumlah penduduk
        function getColor(population) {
            return population > 650 ? '#006400' :
                population > 550 ? '#008000' :
                population > 400 ? '#228B22' :
                population > 300 ? '#32CD32' :
                population > 250 ? '#66CDAA' :
                population > 150 ? '#7FFFD4' :
                population > 100 ? '#ADFF2F' :
                '#F0FFF0';
        }

        // Fungsi untuk mendapatkan style berdasarkan jumlah population
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

        // Fungsi untuk menampilkan informasi saat hover
        function highlightFeature(e) {
            var layer = e.target;

            layer.setStyle({
                weight: 5,
                color: '#666',
                dashArray: '',
                fillOpacity: 0.7
            });

            if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                layer.bringToFront();
            }

            info.update(layer.feature.properties);
        }

        // Fungsi untuk mengembalikan style saat tidak hover
        function resetHighlight(e) {
            e.target.setStyle(style(e.target.feature));
            info.update();
        }

        // Fungsi untuk menampilkan popup saat klik
        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds());
        }

        // Menambahkan event listener
        function onEachFeature(feature, layer) {
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
            });
        }

        // Menampilkan informasi di pojok kanan atas
        var info = L.control();

        info.onAdd = function(map) {
            this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
            this.update();
            return this._div;
        };

        // Method untuk memperbarui informasi
        info.update = function(props) {
            this._div.innerHTML = '<h4>Kabupaten/Kota</h4>' + (props ?
                '<b>' + props.name + '</b><br />' + props.population.toLocaleString() + ' Jumlah Guru' :
                'Hover over a region');
        };

        info.addTo(map);

        // Menambahkan legenda
        var legend = L.control({
            position: 'bottomright'
        });

        legend.onAdd = function(map) {
            var div = L.DomUtil.create('div', 'info legend'),
                grades = [0, 100, 150, 250, 350, 400, 550, 650],
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

        // Menambahkan data geojson ke peta
        <?php $__currentLoopData = $geojsonData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            L.geoJSON(<?php echo json_encode($data); ?>, {
                style: style,
                onEachFeature: onEachFeature
            }).addTo(map);
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>

    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/popup.js"></script>
    
    <script>
        setTimeout(function() {
            $('.loader').fadeToggle();
        }, 1500);

        $("a[href='#top']").click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
            return false;
        });
    </script>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\Semester-7\chroropleth-map\resources\views/chroropleth_map.blade.php ENDPATH**/ ?>