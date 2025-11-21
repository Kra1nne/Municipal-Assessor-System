@extends('layouts/contentNavbarLayout')

@section('title', 'GIS Map')

@section('content')

<div class="container mb-2">
    @if(Auth::user()->role == "Admin")
    <header class="row mb-3">
      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="py-5">
              <p class="text-muted mb-2 fw-bolder">Total Properties</p>
              <h3 class="fw-bold mb-0" id="totalProperties">{{ $countall }}</h3>
              <small class="text-primary">All register properties</small>
            </div>
            <div class="text-primary fs-2">
              <i class="ri-building-line" style="font-size: 2.8rem;"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="py-5">
              <p class="text-muted mb-2 fw-bolder">Active Properties</p>
              <h3 class="fw-bold mb-0" id="activeProperties">{{ $countComplete }}</h3>
              <small class="text-success">Current active</small>
            </div>
            <div class="text-success fs-2">
              <i class="ri-building-line" style="font-size: 2.8rem;"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="py-5">
              <p class="text-muted mb-2 fw-bolder">Under Review Properties</p>
              <h3 class="fw-bold mb-0" id="reviewProperties">{{ $countReview }}</h3>
              <small class="text-muted">Under Review Properties</small>
            </div>
            <div class="text-muted fs-2">
              <i class="ri-building-line" style="font-size: 2.8rem;"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="py-5">
              <p class="text-muted mb-2 fw-bolder">Total Value</p>
              <h3 class="fw-bold text-success mb-0" id="totalValue">{{ $total }}</h3>
              <small class="text-muted">Total Assessed Value</small>
            </div>
            <div class="text-success fs-2">
              <i class="ri-money-dollar-box-line" style="font-size: 2.8rem;"></i>
            </div>
          </div>
        </div>
      </div>
    </header>
    @endif
    <main>
      <input type="text" id="search-lot" placeholder="Search Lot Number" class="form-control form-control-sm mb-2" style="width: 500px;">
      <div id="map" style="height: 700px; width: 100%; position: relative; z-index: 0;"></div>
    </main>
</div>



<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // Initialize map
    var map = L.map('map').setView([10.518201, 124.768402], 13);

    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // GeoJSON Layer (empty initially)
    let geojsonLayer = L.geoJSON(null, {
        onEachFeature: function (feature, layer) {
            let lot = feature.properties.LotNumber ?? "Unknown";
            let owner = feature.properties.Owner ?? "Unknown";

            layer.bindPopup(`
                <b>Lot Number:</b> ${lot}<br>
                <b>Owner:</b> ${owner}
            `);

            layer.setStyle({
                color: "gray",
                weight: 1,
                fillColor: "transparent",
                fillOpacity: 0.3
            });
        }
    }).addTo(map);

    // Load parcels inside visible map
    function loadVisibleParcels() {
        let bounds = map.getBounds();

        let bbox = [
            bounds.getWest(),
            bounds.getSouth(),
            bounds.getEast(),
            bounds.getNorth()
        ].join(',');

        fetch(`{{ route('map-gis-parcel') }}?bbox=` + bbox)
            .then(res => res.json())
            .then(data => {
                geojsonLayer.clearLayers();
                geojsonLayer.addData(data);
            });
    }

    // Trigger loading when map moves/zooms
    map.on('moveend', loadVisibleParcels);

    // Initial load
    loadVisibleParcels();

    // Search on Enter
    document.getElementById('search-lot').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            let searchVal = this.value.trim();

            if (!searchVal) return;

            fetch(`/gis-map/search?lot_number=${searchVal}`)
                .then(res => res.json())
                .then(data => {
                    geojsonLayer.clearLayers();

                    if (data.features.length === 0) {
                        Swal.fire('Error!', 'Lot number not found.', 'error');
                        return;
                    }

                    geojsonLayer.addData(data);

                    let layer = geojsonLayer.getLayers()[0];

                    layer.setStyle({
                        color: "red",
                        weight: 2,
                        fillColor: "red",
                        fillOpacity: 0.5
                    });

                    map.fitBounds(layer.getBounds());
                    layer.openPopup();

                    setTimeout(() => {
                        layer.setStyle({
                            color: "gray",
                            weight: 1,
                            fillColor: "transparent",
                            fillOpacity: 0.3
                        });
                    }, 6000);
                });
        }
    });


});
</script>
@endsection
