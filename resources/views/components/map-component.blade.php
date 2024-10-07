<div id="map" style="height: 100%; width: 100%; position: relative; z-index: 1;"></div>

@push('styles')
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css' rel='stylesheet' />
    <style>
        .mobile-menu {
            position: relative;
            z-index: 10;
        }
    </style>
@endpush

@push('scripts')
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Define the flood locations and city details
            const floodLocations = [
                { lnglat: [106.863956, -6.138414], city: "Jakarta Utara", count: 8 },
                { lnglat: [106.7570, -6.1615], city: "Jakarta Barat", count: 15 },
                { lnglat: [106.900447, -6.225014], city: "Jakarta Timur", count: 3 },
                { lnglat: [106.810600, -6.261493], city: "Jakarta Selatan", count: 4 },
            ];

            const cityDetails = {
                "Jakarta Barat": [
                    { lnglat: [106.7235353, -6.140227], kelurahan: "Cengkareng Barat", indeksBanjir: 1.8, Kategori: "Sedang"},
                    { lnglat: [106.7328601, -6.1416616], kelurahan: "Cengkareng Timur", indeksBanjir: 1.6, Kategori: "Sedang" },
                    { lnglat: [106.71605, -6.16888], kelurahan: "Duri Kosambi", indeksBanjir: 1.8, Kategori: "Sedang" },
                    { lnglat: [106.75331, -6.13983], kelurahan: "Kapuk", indeksBanjir: 1.6, Kategori: "Sedang" },
                    { lnglat: [106.7575653, -6.1511336], kelurahan: "Kedaung Kali Angke", indeksBanjir: 1.6, Kategori: "Sedang" },
                    { lnglat: [106.73901, -6.16122], kelurahan: "Rawa Buaya", indeksBanjir: 2.2, Kategori: "Tinggi" },
                    { lnglat: [106.7823051, -6.1489448], kelurahan: "Jelambar Baru", indeksBanjir: 1.6, Kategori: "Sedang" },
                    { lnglat: [106.78476, -6.17116], kelurahan: "Tanjung Duren Utara", indeksBanjir: 1.6, Kategori: "Sedang" },
                    { lnglat: [106.70250, -6.16684], kelurahan: "Semanan", indeksBanjir: 1.6, Kategori: "Sedang" },
                    { lnglat: [106.718693, -6.1198254], kelurahan: "Tegal Alur", indeksBanjir: 1.8, Kategori: "Sedang" },
                    { lnglat: [106.75909, -6.18190], kelurahan: "Kedoya Selatan", indeksBanjir: 1.6, Kategori: "Sedang" },
                    { lnglat: [106.76152, -6.16781], kelurahan: "Kedoya Utara", indeksBanjir: 1.8, Kategori: "Sedang" },
                    { lnglat: [106.73918, -6.21895], kelurahan: "Joglo", indeksBanjir: 1.6, Kategori: "Sedang" },
                    { lnglat: [106.73647, -6.18999], kelurahan: "Kembangan Selatan", indeksBanjir: 2.0, Kategori: "Tinggi"},
                    { lnglat: [106.74394, -6.17179], kelurahan: "Kembangan Utara", indeksBanjir: 2.0, Kategori: "Tinggi" }
                ],
                "Jakarta Utara": [
                    { lnglat: [106.92662, -6.12292], kelurahan: "Semper Barat", indeksBanjir: 1.8, Kategori: "Sedang" },
                    { lnglat: [106.93517, -6.12093], kelurahan: "Semper Timur", indeksBanjir: 1.8, Kategori: "Sedang" },
                    { lnglat: [106.92796, -6.15233], kelurahan: "Sukapura", indeksBanjir: 1.8, Kategori: "Sedang" },
                    { lnglat: [106.9158465, -6.1626344], kelurahan: "Pegangsaan Dua", indeksBanjir: 1.6, Kategori: "Sedang" },
                    { lnglat: [106.9116460, -6.1140999], kelurahan: "Lagoa", indeksBanjir: 1.6, Kategori: "Sedang" },
                    { lnglat: [106.9121406, -6.1224924], kelurahan: "Tugu Utara", indeksBanjir: 1.6, Kategori: "Sedang" },
                    { lnglat: [106.78545, -6.13550], kelurahan: "Pejagalan", indeksBanjir: 2.2, Kategori: "Tinggi" },
                    { lnglat: [106.800759, -6.125643], kelurahan: "Penjaringan", indeksBanjir: 1.8, Kategori: "Sedang" }
                ],
                "Jakarta Timur": [
                    { lnglat: [106.86651, -6.23471], kelurahan: "Bidara Cina", indeksBanjir: 2.4, Kategori: "Tinggi" },
                    { lnglat: [106.86132, -6.21850], kelurahan: "Kampung Melayu", indeksBanjir: 2.2, Kategori: "Tinggi" },
                    { lnglat: [106.90110, -6.19978], kelurahan: "Jatinegara Kaum", indeksBanjir: 1.6, Kategori: "Tinggi" }
                ],
                "Jakarta Selatan": [
                    { lnglat: [106.82440, -6.23404], kelurahan: "Kuningan Barat", indeksBanjir: 1.8, Kategori: "Sedang" },
                    { lnglat: [106.82211, -6.25085], kelurahan: "Mampang Prapatan", indeksBanjir: 1.8, Kategori: "Sedang" },
                    { lnglat: [106.81625, -6.24694], kelurahan: "Pela Mampang", indeksBanjir: 1.8, Kategori: "Sedang" },
                    { lnglat: [106.85500, -6.25884], kelurahan: "Rawajati", indeksBanjir: 2.0, Kategori: "Tinggi" }
                ],
            };

            mapboxgl.accessToken = 'pk.eyJ1IjoiZG9kb3hkIiwiYSI6ImNtMXNzc3o2eDBham0ya3BybjAzdHh6dTUifQ.j4wY9CcmmjYGbPizv6b-Dg';
            const map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/dark-v11',
                center: [106.8456, -6.2088], // Jakarta coordinates
                zoom: 10,
                pitch: 45, // Add 3D perspective
                bearing: -17.6,
                projection: 'globe'
            });

            map.on('load', () => {
                // Add 3D building layer
                map.addLayer({
                    'id': '3d-buildings',
                    'source': 'composite',
                    'source-layer': 'building',
                    'filter': ['==', 'extrude', 'true'],
                    'type': 'fill-extrusion',
                    'minzoom': 15,
                    'paint': {
                        'fill-extrusion-color': '#aaa',
                        'fill-extrusion-height': [
                            "interpolate", ["linear"], ["zoom"],
                            15, 0,
                            15.05, ["get", "height"]
                        ],
                        'fill-extrusion-opacity': .6
                    }
                });

                // Add markers for flood locations
                floodLocations.forEach((location) => {
                    const el = document.createElement('div');
                    el.className = 'marker';
                    el.style.backgroundColor = '#3388ff';
                    el.style.width = '18px';
                    el.style.height = '18px';
                    el.style.borderRadius = '50%';
                    el.style.border = '2px solid #000';

                    const marker = new mapboxgl.Marker(el)
                        .setLngLat(location.lnglat)
                        .setPopup(new mapboxgl.Popup({ offset: 25 })
                            .setHTML(`<h3>${location.city}</h3><p>Total Lokasi Banjir: ${location.count}</p>`))
                        .addTo(map);

                    marker.getElement().addEventListener('click', () => {
                        console.log(`Marker clicked: ${location.city}`);
                        toggleCityDetails(location.city);
                    });
                });
            });

            const detailMarkers = [];
            let currentCity = null;

            window.showDetails = function(city) {
                console.log(`Showing details for: ${city}`);
                const cityCenter = floodLocations.find((loc) => loc.city === city)?.lnglat;
                if (cityCenter) {
                    map.flyTo({
                        center: cityCenter,
                        zoom: 10,
                        essential: true
                    });
                }

                // Clear previous markers
                detailMarkers.forEach((marker) => marker.remove());
                detailMarkers.length = 0;

                cityDetails[city].forEach((location) => {
                    const el = document.createElement('div');
                    el.className = 'detail-marker';
                    el.style.backgroundColor = location.indeksBanjir >= 2.0 ? "#FF0000" : "#FFA500";
                    el.style.width = '14px';
                    el.style.height = '14px';
                    el.style.borderRadius = '50%';
                    el.style.border = '1px solid #000';

                    const marker = new mapboxgl.Marker(el)
                        .setLngLat(location.lnglat)
                        .setPopup(new mapboxgl.Popup({ offset: 25 })
                            .setHTML(`<h3>${location.kelurahan}</h3><p>Indeks Banjir: ${location.indeksBanjir}<br>Kategori: ${location.Kategori}</p>`))
                        .addTo(map);

                    detailMarkers.push(marker);
                });

                currentCity = city;
            };

            function toggleCityDetails(city) {
                if (currentCity === city) {
                    // Hide details if the same city is clicked
                    detailMarkers.forEach((marker) => marker.remove());
                    detailMarkers.length = 0;
                    currentCity = null;
                } else {
                    showDetails(city);
                }
            }
        });
    </script>
@endpush  