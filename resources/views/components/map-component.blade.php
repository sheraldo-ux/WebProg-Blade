<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flood Map</title>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css' rel='stylesheet' />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }
        #map {
            height: 100vh;
            width: 100%;
            position: relative;
            z-index: 1;
        }
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background-color: #333;
            color: white;
            display: flex;
            align-items: center;
            padding: 0 20px;
            transition: transform 0.3s ease-in-out;
            z-index: 1000;
        }
        .navbar.hidden {
            transform: translateY(-100%);
        }
        #leftPopup {
            position: fixed;
            left: 20px;
            top: 80px;
            width: 300px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            z-index: 1000;
            overflow: hidden;
            display: none;
            transition: all 0.3s ease-in-out;
            transform: translateX(-320px);
        }
        #leftPopup.visible {
            transform: translateX(0);
        }
        #leftPopup h3 {
            margin: 0;
            padding: 15px;
            background-color: #6366f1;
            color: white;
            font-size: 18px;
        }
        #leftPopup .content {
            padding: 15px;
        }
        #cityDetailsPopup {
            margin-top: 10px;
            background-color: rgba(240, 240, 240, 0.9);
            border-radius: 8px;
            padding: 10px;
            display: none;
        }
        .marker {
            background-color: #6366f1;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid #fff;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 14px;
        }
        .detail-marker {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid #fff;
            cursor: pointer;
            box-shadow: 0 0 8px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Flood Map</h1>
    </nav>
    <div id="map"></div>
    <div id="leftPopup">
        <h3 id="popupTitle"></h3>
        <div id="popupContent" class="content"></div>
        <div id="cityDetailsPopup"></div>
    </div>

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

        async function fetchWeatherData(lat, lon) {
            const apiKey = '3d3081b6edd1db1586dd4ae459aeab56';
            const url = `http://api.openweathermap.org/data/2.5/forecast?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`;

            try {
                const response = await fetch(url);
                const data = await response.json();

                const forecastList = data.list.map(item => ({
                    datetime: item.dt_txt,
                    temperature: item.main.temp,
                    description: item.weather[0].description,
                    icon: item.weather[0].icon
                }));

                return forecastList;
            } catch (error) {
                console.error('Error fetching weather data:', error);
                throw error;
            }
        }



        mapboxgl.accessToken = 'pk.eyJ1IjoiZG9kb3hkIiwiYSI6ImNtMXNzc3o2eDBham0ya3BybjAzdHh6dTUifQ.j4wY9CcmmjYGbPizv6b-Dg';
    
    // Define a default map view in case geolocation fails
    let defaultCoordinates = [106.8456, -6.2088]; // Jakarta coordinates
    let zoomLevel = 10;

    // Create the map
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/dark-v11',
        center: defaultCoordinates,
        zoom: zoomLevel,
        pitch: 45,
        bearing: -17.6,
        projection: 'globe'
    });

    // Try to get the user's current location using Geolocation API
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            const userCoordinates = [position.coords.longitude, position.coords.latitude];
            
            // Center the map on the user's location
            map.setCenter(userCoordinates);
            map.setZoom(12);  // Adjust the zoom to fit the user location better

            // Add a circle layer to indicate user's location
            map.addSource('user-location', {
                type: 'geojson',
                data: {
                    type: 'FeatureCollection',
                    features: [{
                        type: 'Feature',
                        geometry: {
                            type: 'Point',
                            coordinates: userCoordinates
                        }
                    }]
                }
            });

            map.addLayer({
                id: 'user-location-circle',
                type: 'circle',
                source: 'user-location',
                paint: {
                    'circle-radius': 10,
                    'circle-color': '#007cbf',
                    'circle-opacity': 0.8
                }
            });

        }, error => {
            console.error('Geolocation error:', error);
            // If error occurs or permission is denied, the map will default to Jakarta
        });
    } else {
        console.error('Geolocation is not supported by this browser.');
        // If geolocation isn't available, the map stays at the default center
    }

    map.on('load', () => {
        // Add 3D building layer (unchanged)
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

        // Add markers for flood locations (unchanged)
        floodLocations.forEach((location) => {
            const el = document.createElement('div');
            el.className = 'marker';
            el.innerHTML = `<i class="fas fa-water"></i>`;

            const marker = new mapboxgl.Marker(el)
                .setLngLat(location.lnglat)
                .addTo(map);

            marker.getElement().addEventListener('click', () => {
                showFloodLocationPopup(location);
            });
        });
    });
            const detailMarkers = [];
            let currentCity = null;

            function showFloodLocationPopup(location) {
                const popupTitle = document.getElementById('popupTitle');
                const popupContent = document.getElementById('popupContent');
                const leftPopup = document.getElementById('leftPopup');
                const cityDetailsPopup = document.getElementById('cityDetailsPopup');

                popupTitle.textContent = location.city;
                popupContent.innerHTML = `
                    <p><i class="fas fa-map-marker-alt"></i> Total Lokasi Banjir: ${location.count}</p>
                    <p><i class="fas fa-info-circle"></i> Klik pada marker detail untuk informasi lebih lanjut.</p>
                `;
                leftPopup.style.display = 'block';
                leftPopup.classList.add('visible');
                cityDetailsPopup.style.display = 'none';

                map.flyTo({
                    center: location.lnglat,
                    zoom: 12,
                    essential: true
                });

                // Clear previous markers
                detailMarkers.forEach((marker) => marker.remove());
                detailMarkers.length = 0;

                cityDetails[location.city].forEach((detail) => {
                    const el = document.createElement('div');
                    el.className = 'detail-marker';
                    el.style.backgroundColor = detail.indeksBanjir >= 2.0 ? "#FF0000" : "#FFA500";

                    const marker = new mapboxgl.Marker(el)
                        .setLngLat(detail.lnglat)
                        .addTo(map);

                    marker.getElement().addEventListener('click', () => {
                        showCityDetailPopup(detail);
                    });

                    detailMarkers.push(marker);
                });

                currentCity = location.city;
            }

            function showCityDetailPopup(detail) {
                const cityDetailsPopup = document.getElementById('cityDetailsPopup');

                cityDetailsPopup.innerHTML = `
                    <h4>${detail.kelurahan}</h4>
                    <p><i class="fas fa-tint"></i> Indeks Banjir: ${detail.indeksBanjir}</p>
                    <p><i class="fas fa-exclamation-triangle"></i> Kategori: ${detail.Kategori}</p>
                    <h5>Weather Forecast:</h5>
                    <div id="weatherForecast"></div>
                `;
                cityDetailsPopup.style.display = 'block';

                // Fetch the weather data using latitude and longitude
                fetchWeatherData(detail.lnglat[1], detail.lnglat[0]).then(forecast => {
                    const weatherForecastDiv = document.getElementById('weatherForecast');
                    weatherForecastDiv.innerHTML = ''; // Clear previous forecasts

                    if (forecast.length) {
                        forecast.forEach(item => {
                            const weatherItem = document.createElement('div');
                            weatherItem.className = 'weather-item';
                            weatherItem.innerHTML = `
                                <p>${item.datetime}</p>
                                <p>Temperature: ${item.temperature} °C</p>
                                <p>Condition: ${item.description}</p>
                                <img src="http://openweathermap.org/img/wn/${item.icon}.png" alt="${item.description}">
                            `;
                            weatherForecastDiv.appendChild(weatherItem);
                        });
                    } else {
                        weatherForecastDiv.innerHTML = '<p>No forecast data available.</p>';
                    }
                }).catch(err => {
                    console.error('Failed to fetch weather data:', err);
                    const weatherForecastDiv = document.getElementById('weatherForecast');
                    weatherForecastDiv.innerHTML = '<p>Error fetching weather data.</p>';
                });

                cityDetailsPopup.style.opacity = '0';
                cityDetailsPopup.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    cityDetailsPopup.style.transition = 'all 0.3s ease-in-out';
                    cityDetailsPopup.style.opacity = '1';
                    cityDetailsPopup.style.transform = 'translateY(0)';
                }, 50);
            }

            let lastScrollTop = 0;
            const navbar = document.querySelector('.navbar');

            window.addEventListener('scroll', () => {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                if (scrollTop > lastScrollTop) {
                    navbar.classList.add('hidden');
                } else {
                    navbar.classList.remove('hidden');
                }
                lastScrollTop = scrollTop;
            });
        });
    </script>
</body>
</html>
