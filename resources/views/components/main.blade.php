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