@extends('layouts.app')

<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <title>Document</title>
</head>
<body class="h-full overflow-hidden">
<div class="min-h-full" x-data="{ isOpen: false }">
  <header class="bg-black pb-24 max-sm:pt-4">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
      <div class="relative flex items-center justify-between py-5">
        <!-- Logo -->
        <div class="absolute left-0 flex-shrink-0 lg:static">
          <a href="#">
            <span class="sr-only">Your Company</span>
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=300" alt="Your Company">
          </a>
        </div>

        <!-- Right section on desktop -->
        <div class="hidden lg:ml-4 lg:flex lg:items-center lg:pr-0.5 w-full">
          <nav class="flex justify-start space-x-4 w-full">
            <a href="#map" class="rounded-md bg-white bg-opacity-0 px-3 py-2 text-sm font-medium text-white hover:bg-opacity-10" aria-current="page">Map</a>
            <a href="#information" class="rounded-md bg-white bg-opacity-0 px-3 py-2 text-sm font-medium text-indigo-100 hover:bg-opacity-10">Information</a>
            <a href="#tips" class="rounded-md bg-white bg-opacity-0 px-3 py-2 text-sm font-medium text-indigo-100 hover:bg-opacity-10">Tips</a>
            <a href="#about" class="rounded-md bg-white bg-opacity-0 px-3 py-2 text-sm font-medium text-indigo-100 hover:bg-opacity-10">About</a>
            <a href="#support" class="rounded-md bg-white bg-opacity-0 px-3 py-2 text-sm font-medium text-indigo-100 hover:bg-opacity-10">Support</a>
          </nav>
        </div>

        <!-- Mobile menu button -->
        <div class="absolute right-0 flex-shrink-0 lg:hidden">
          <button type="button" @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md bg-transparent p-2 text-indigo-200 hover:bg-white hover:bg-opacity-10 hover:text-white focus:outline-none focus:ring-2 focus:ring-white" aria-expanded="isOpen">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile menu, show/hide based on mobile menu state. -->
      <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform"
           x-transition:enter-start="opacity-0 scale-95"
           x-transition:enter-end="opacity-100 scale-100"
           x-transition:leave="transition ease-in duration-75 transform"
           x-transition:leave-start="opacity-100 scale-100"
           x-transition:leave-end="opacity-0 scale-95"
           class="lg:hidden"
      >
        <div class="fixed inset-0 z-20 bg-black bg-opacity-25" aria-hidden="true"></div>

        <div class="absolute inset-x-0 top-0 z-30 mx-auto w-full max-w-3xl origin-top transform p-2 transition max-sm:pt-6">
          <div class="divide-y divide-gray-200 rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
            <div class="pb-2 pt-3">
              <div class="flex items-center justify-between px-4">
                <div>
                  <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                </div>
                <div class="-mr-2">
                  <button type="button" @click="isOpen = false" class="relative inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Close menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="mt-3 space-y-1 px-2">
                <a href="#map" class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100 hover:text-gray-800">Map</a>
                <a href="#information" class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100 hover:text-gray-800">Information</a>
                <a href="#tips" class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100 hover:text-gray-800">Tips</a>
                <a href="#about" class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100 hover:text-gray-800">About</a>
                <a href="#support" class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100 hover:text-gray-800">Support</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <main class="-mt-24 pb-8 max-sm:pt-4">
    <div class="mandatory-scroll-snapping"> <!-- Scroll Animation -->
      <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <h1 class="sr-only">Home Page</h1>
        <div class="grid grid-cols-1 items-start gap-4 lg:grid-cols-3 lg:gap-8">
          <!-- Left column -->
          <div class="grid grid-cols-1 gap-4 lg:col-span-2">
            <section aria-labelledby="map-title">
              <h2 class="sr-only" id="map-title">Map Section</h2>
              <div class="overflow-hidden rounded-lg bg-white shadow">
                <div class="p-6">
                  <x-map-component />
                </div>
              </div>
            </section>
          </div>

          <!-- Right column -->
          <div class="grid grid-cols-1 gap-4">
            <section aria-labelledby="section-2-title">
              <h2 class="sr-only" id="section-2-title">Section title</h2>
              <div class="overflow-hidden rounded-lg bg-white shadow">
                <div class="p-6">
                  <div class="grid grid-cols-1 gap-4">
                    <!-- First Box (Jakarta Barat) -->
                    <div aria-labelledby="jakarta-barat-title">
                      <h2 class="sr-only" id="jakarta-barat-title">Jakarta Barat</h2>
                      <div class="cursor-pointer overflow-hidden rounded-lg bg-indigo-500 shadow" onclick="showDetails('Jakarta Barat')">
                          <div class="p-6">
                              <h3 class="text-lg font-bold" style="color: white">Jakarta Barat</h3>
                              <p style="color: white">Click to see details for Jakarta Barat</p>
                          </div>
                      </div>
                    </div>

                    <!-- Second Box (Jakarta Timur) -->
                    <div aria-labelledby="jakarta-timur-title">
                      <h2 class="sr-only" id="jakarta-timur-title">Jakarta Barat</h2>
                      <div class="cursor-pointer overflow-hidden rounded-lg bg-indigo-500 shadow" onclick="showDetails('Jakarta Timur')">
                          <div class="p-6">
                              <h3 class="text-lg font-bold" style="color: white">Jakarta Timur</h3>
                              <p style="color: white">Click to see details for Jakarta Timur</p>
                          </div>
                      </div>
                    </div>
                
                    <!-- Third Box (Jakarta Selatan) -->
                    <div aria-labelledby="jakarta-selatan-title">
                      <h2 class="sr-only" id="jakarta-selatan-title">Jakarta Barat</h2>
                      <div class="cursor-pointer overflow-hidden rounded-lg bg-indigo-500 shadow" onclick="showDetails('Jakarta Selatan')">
                          <div class="p-6">
                              <h3 class="text-lg font-bold" style="color: white">Jakarta Selatan</h3>
                              <p style="color: white">Click to see details for Jakarta Selatan</p>
                          </div>
                      </div>
                    </div>
                
                    <!-- Fourth Box (Jakarta Utara) -->
                    <div aria-labelledby="jakarta-utara-title">
                      <h2 class="sr-only" id="jakarta-utara-title">Jakarta Barat</h2>
                      <div class="cursor-pointer overflow-hidden rounded-lg bg-indigo-500 shadow" onclick="showDetails('Jakarta Utara')">
                          <div class="p-6">
                              <h3 class="text-lg font-bold" style="color: white">Jakarta Utara</h3>
                              <p style="color: white">Click to see details for Jakarta Utara</p>
                          </div>
                      </div>
                    </div>
                </div>              
                </div>
              </div>
            </section>
          </div>
        </div>

        <!-- Information Section -->
        <section id="information" aria-labelledby="information-title" class="mt-8">
          <h2 class="sr-only" id="information-title">Information</h2>
          <div class="overflow-hidden rounded-lg bg-white shadow mb-8">
            <div class="p-6">
              <h3 class="text-lg font-medium">Information</h3>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed neque elit, tristique placerat feugiat ac, facilisis vitae arcu. Proin eget egestas augue. Praesent ut sem nec arcu pellentesque aliquet. Duis dapibus diam vel metus tempus, ac volutpat libero posuere. Nunc sit amet varius quam, id facilisis lectus. Donec et purus luctus, lacinia lectus a, aliquam lectus. In viverra sit amet turpis eu eleifend. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis erat sed mauris. Integer nec turpis at lectus aliquet ultrices. In sit amet posuere sem. Aenean quis odio et dolor accumsan imperdiet.
              </p>
            </div>
          </div>
        </section>

        <!-- Tips Section -->
        <section id="tips" aria-labelledby="information-title" class="mt-8">
          <h2 class="sr-only" id="information-title">Tips</h2>
          <div class="overflow-hidden rounded-lg bg-white shadow mb-8">
            <div class="p-6">
              <h3 class="text-lg font-medium">Tips</h3>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed neque elit, tristique placerat feugiat ac, facilisis vitae arcu. Proin eget egestas augue. Praesent ut sem nec arcu pellentesque aliquet. Duis dapibus diam vel metus tempus, ac volutpat libero posuere. Nunc sit amet varius quam, id facilisis lectus. Donec et purus luctus, lacinia lectus a, aliquam lectus. In viverra sit amet turpis eu eleifend. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis erat sed mauris. Integer nec turpis at lectus aliquet ultrices. In sit amet posuere sem. Aenean quis odio et dolor accumsan imperdiet.
              </p>
            </div>
          </div>
        </section>

        <!-- About Section -->
        <section id="about" aria-labelledby="information-title" class="mt-8">
          <h2 class="sr-only" id="information-title">About</h2>
          <div class="overflow-hidden rounded-lg bg-white shadow mb-8">
            <div class="p-6">
              <h3 class="text-lg font-medium">About</h3>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed neque elit, tristique placerat feugiat ac, facilisis vitae arcu. Proin eget egestas augue. Praesent ut sem nec arcu pellentesque aliquet. Duis dapibus diam vel metus tempus, ac volutpat libero posuere. Nunc sit amet varius quam, id facilisis lectus. Donec et purus luctus, lacinia lectus a, aliquam lectus. In viverra sit amet turpis eu eleifend. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis erat sed mauris. Integer nec turpis at lectus aliquet ultrices. In sit amet posuere sem. Aenean quis odio et dolor accumsan imperdiet.
              </p>
            </div>
          </div>
        </section>

        <!-- Support Section -->
        <section id="support" aria-labelledby="information-title" class="mt-8">
          <h2 class="sr-only" id="information-title">Support</h2>
          <div class="overflow-hidden rounded-lg bg-white shadow mb-8">
            <div class="p-6">
              <h3 class="text-lg font-medium">Support</h3>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed neque elit, tristique placerat feugiat ac, facilisis vitae arcu. Proin eget egestas augue. Praesent ut sem nec arcu pellentesque aliquet. Duis dapibus diam vel metus tempus, ac volutpat libero posuere. Nunc sit amet varius quam, id facilisis lectus. Donec et purus luctus, lacinia lectus a, aliquam lectus. In viverra sit amet turpis eu eleifend. Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis erat sed mauris. Integer nec turpis at lectus aliquet ultrices. In sit amet posuere sem. Aenean quis odio et dolor accumsan imperdiet.
              </p>
            </div>
          </div>
        </section>

      </div>
    </div>
  </main>
</div>

</body>
</html>
