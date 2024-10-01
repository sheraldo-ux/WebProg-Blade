<h1 class="sr-only">Home Page</h1>
<div class="grid grid-cols-1 gap-4 lg:grid-cols-3 mt-8">
  <!-- Left column -->
  <div class="flex flex-col gap-4 lg:col-span-2">
    <section aria-labelledby="map-title">
      <h2 class="sr-only" id="map-title">Map Section</h2>
      <div class="overflow-hidden rounded-lg bg-white shadow flex-grow">
        <div class="p-6">
          <x-map-component />
        </div>
      </div>
    </section>
  </div>

  <!-- Right column -->
  <div class="flex flex-col gap-4">
    <section aria-labelledby="section-2-title" class="flex-grow">
      <h2 class="sr-only" id="section-2-title">Section title</h2>
      <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="p-6">
          <div class="grid grid-cols-2 gap-4">
            <!-- City Boxes -->
            <div class="city-box group" aria-labelledby="jakarta-barat-title">
              <h2 class="sr-only" id="jakarta-barat-title">Jakarta Barat</h2>
              <div onclick="showDetails('Jakarta Barat')" class="cursor-pointer overflow-hidden rounded-lg bg-slate-800 shadow transition-all duration-300 ease-in-out hover:bg-slate-700 active:bg-indigo-400 active:shadow-lg">
                <div class="p-3 flex flex-col items-center">
                  <div class="w-full h-20 flex items-center justify-center mb-4">
                    <img src="/firebase.png" alt="Monumen Jakarta Barat" class="max-w-full max-h-full object-contain">
                  </div>
                  <h3 class="text-lg font-bold text-indigo-400 group-active:text-white">Jakarta Barat</h3>
                </div>
              </div>
            </div>
            <div class="city-box group" aria-labelledby="jakarta-timur-title">
              <h2 class="sr-only" id="jakarta-timur-title">Jakarta Timur</h2>
              <div onclick="showDetails('Jakarta Timur')" class="cursor-pointer overflow-hidden rounded-lg bg-slate-800 shadow transition-all duration-300 ease-in-out hover:bg-slate-700 active:bg-indigo-400 active:shadow-lg">
                <div class="p-3 flex flex-col items-center">
                  <div class="w-full h-20 flex items-center justify-center mb-4">
                    <img src="/firebase.png" alt="Monumen Jakarta Timur" class="max-w-full max-h-full object-contain">
                  </div>
                  <h3 class="text-lg font-bold text-indigo-400 group-active:text-white">Jakarta Timur</h3>
                </div>
              </div>
            </div>
            <div class="city-box group" aria-labelledby="jakarta-selatan-title">
              <h2 class="sr-only" id="jakarta-selatan-title">Jakarta Selatan</h2>
              <div onclick="showDetails('Jakarta Selatan')" class="cursor-pointer overflow-hidden rounded-lg bg-slate-800 shadow transition-all duration-300 ease-in-out hover:bg-slate-700 active:bg-indigo-400 active:shadow-lg">
                <div class="p-3 flex flex-col items-center">
                  <div class="w-full h-20 flex items-center justify-center mb-4">
                    <img src="/firebase.png" alt="Monumen Jakarta Selatan" class="max-w-full max-h-full object-contain">
                  </div>
                  <h3 class="text-lg font-bold text-indigo-400 group-active:text-white">Jakarta Selatan</h3>
                </div>
              </div>
            </div>
            <div class="city-box group" aria-labelledby="jakarta-utara-title">
              <h2 class="sr-only" id="jakarta-utara-title">Jakarta Utara</h2>
              <div onclick="showDetails('Jakarta Utara')" class="cursor-pointer overflow-hidden rounded-lg bg-slate-800 shadow transition-all duration-300 ease-in-out hover:bg-slate-700 active:bg-indigo-400 active:shadow-lg">
                <div class="p-3 flex flex-col items-center">
                  <div class="w-full h-20 flex items-center justify-center mb-4">
                    <img src="/firebase.png" alt="Monumen Jakarta Utara" class="max-w-full max-h-full object-contain">
                  </div>
                  <h3 class="text-lg font-bold text-indigo-400 group-active:text-white">Jakarta Utara</h3>
                </div>
              </div>
            </div>
            <!--Combined Box -->
            <div class="city-box group col-span-2" aria-labelledby="combined-jakarta-title">
              <h2 class="sr-only" id="Alert">Alert</h2>
              <div class="overflow-hidden rounded-lg" style="background-color: #ce0f0f;">
                <div class="p-3 flex flex-col items-center">
                  <div class="w-full h-20 flex items-center justify-center mb-4">
                    <img src="/firebase.png" alt="Alert" class="max-w-full max-h-full object-contain">
                  </div>
                  <h3 class="text-lg font-bold text-indigo-400 group-active:text-white">Alert</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>