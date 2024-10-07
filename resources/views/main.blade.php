@extends('layouts.app')

<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Dynamic Map Layout</title>
    <style>
        :root {
            --navbar-height: 64px; /* Adjust this to match your navbar height */
            --map-top-gap: 36px; /* Adjust this for the desired gap between navbar and map */
        }

        @media (max-width: 1024px) {
            :root {
                --navbar-height: 56px;
                --map-top-gap: 8px;
            }
        }

        .navbar-hidden {
            transform: translateY(-100%);
        }
        .navbar-visible {
            transform: translateY(0);
        }
        .navbar-transition {
            transition: transform 0.3s ease-in-out;
        }
        #map-container {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            transition: top 0.3s ease-in-out;
        }
        .map-with-navbar {
            top: calc(var(--navbar-height) + var(--map-top-gap));
        }
        .map-fullscreen {
            top: 0;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var lastScrollTop = 0;
            var navbar = document.querySelector('header');
            var mapContainer = document.getElementById('map-container');
            var threshold = 50; // Adjust this value to change how much scroll is needed to hide/show the navbar

            window.addEventListener('scroll', function() {
                var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                if (scrollTop > lastScrollTop && scrollTop > threshold) {
                    // Scrolling down
                    navbar.classList.remove('navbar-visible');
                    navbar.classList.add('navbar-hidden');
                    mapContainer.classList.remove('map-with-navbar');
                    mapContainer.classList.add('map-fullscreen');
                } else if (scrollTop < lastScrollTop && scrollTop <= threshold) {
                    // Scrolling up and near the top
                    navbar.classList.remove('navbar-hidden');
                    navbar.classList.add('navbar-visible');
                    mapContainer.classList.remove('map-fullscreen');
                    mapContainer.classList.add('map-with-navbar');
                }
                
                lastScrollTop = scrollTop;
            });
        });
    </script>
</head>

<body class="h-full" style="background-color: #eae8e0">
    <x-header class="fixed top-0 left-0 right-0 z-50 navbar-visible navbar-transition" />
    <main class="h-full">
        <div id="map-container" class="map-with-navbar">
            <x-map-page />
        </div>
    </main>
</body>
</html>