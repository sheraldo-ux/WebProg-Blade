<div id="map" style="height: 500px; width: 100%;"></div>

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Define the flood locations and city details
        const floodLocations = [
            { latlng: [-6.138414, 106.863956], city: "Jakarta Utara", count: 8 },
            { latlng: [-6.1615, 106.7570], city: "Jakarta Barat", count: 15 },
            { latlng: [-6.225014, 106.900447], city: "Jakarta Timur", count: 3 },
            { latlng: [-6.261493, 106.810600], city: "Jakarta Selatan", count: 4 },
        ];

        const cityDetails = {
            "Jakarta Barat": [
                { latlng: [-6.140227, 106.7235353], kelurahan: "Cengkareng Barat", indeksBanjir: 1.8, Kategori: "Sedang" },
                { latlng: [-6.1416616, 106.7328601], kelurahan: "Cengkareng Timur", indeksBanjir: 1.6, Kategori: "Sedang" },
                { latlng: [-6.16888, 106.71605], kelurahan: "Duri Kosambi", indeksBanjir: 1.8, Kategori: "Sedang" },
                { latlng: [-6.13983, 106.75331], kelurahan: "Kapuk", indeksBanjir: 1.6, Kategori: "Sedang" },
                // Add the rest here
            ],
            "Jakarta Utara": [
                { latlng: [-6.12292, 106.92662], kelurahan: "Semper Barat", indeksBanjir: 1.8, Kategori: "Sedang" },
                // Add more data as needed
            ],
            "Jakarta Timur": [
                { latlng: [-6.23471, 106.86651], kelurahan: "Bidara Cina", indeksBanjir: 2.4, Kategori: "Tinggi" },
            ],
            "Jakarta Selatan": [
                { latlng: [-6.23404, 106.82440], kelurahan: "Kuningan Barat", indeksBanjir: 1.8, Kategori: "Sedang" },
            ],
        };

        // Initialize the map
        const map = L.map("map").setView([-6.2088, 106.8456], 11);

        // Add the OpenStreetMap tile layer
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "© OpenStreetMap contributors",
        }).addTo(map);

        const detailMarkers = [];
        let currentCity = null;

        // Add flood locations markers
        floodLocations.forEach((location) => {
            const marker = L.circleMarker(location.latlng, {
                radius: 9,
                fillColor: "#3388ff",
                color: "#000",
                weight: 1,
                opacity: 1,
                fillOpacity: 0.8,
            }).addTo(map);

            marker.on("click", () => toggleCityDetails(location.city));

            marker.bindPopup(`Kota: ${location.city}<br>Total Lokasi Banjir: ${location.count}`);
        });

        // Function to show details for a specific city
        function showDetails(city) {
            const cityCenter = floodLocations.find((loc) => loc.city === city)?.latlng;
            map.setView(cityCenter, 14);

            const markers = cityDetails[city].map((location) => {
                const detailMarker = L.circleMarker(location.latlng, {
                    radius: 7,
                    fillColor: location.indeksBanjir >= 2.0 ? "#FF0000" : "#FFA500",
                    color: "#000",
                    weight: 1,
                    opacity: 1,
                    fillOpacity: 0.8,
                }).addTo(map)
                    .bindPopup(`Kelurahan: ${location.kelurahan}<br>Indeks Banjir: ${location.indeksBanjir}<br>Kategori: ${location.Kategori}`);
                
                return detailMarker;
            });

            detailMarkers.push(...markers);
        }

        // Function to hide the current city details
        function hideDetails() {
            detailMarkers.forEach((marker) => map.removeLayer(marker));
            detailMarkers.length = 0; // Clear the markers array
        }

        // Function to toggle the city details
        function toggleCityDetails(city) {
            if (currentCity === city) {
                hideDetails();
                map.setView([-6.2088, 106.8456], 11);
                currentCity = null;
            } else {
                hideDetails();
                showDetails(city);
                currentCity = city;
            }
        }
    </script>
@endpush
