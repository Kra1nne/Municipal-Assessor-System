@extends('layouts/contentNavbarLayout')

@section('title', 'GIS Map')

@section('content')

<div class="container mb-2">

    <!-- Dashboard Cards -->
    <header class="row mb-3">

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="py-5">
                        <p class="text-muted mb-2 fw-bolder">Total Properties</p>
                        <h3 class="fw-bold mb-0">{{ $countall }}</h3>
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
                        <h3 class="fw-bold mb-0">{{ $countComplete }}</h3>
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
                        <p class="text-muted mb-2 fw-bolder">Under Review</p>
                        <h3 class="fw-bold mb-0">{{ $countReview }}</h3>
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
                        <h3 class="fw-bold text-success mb-0">{{ $total }}</h3>
                        <small class="text-muted">Total Assessed Value</small>
                    </div>
                    <div class="text-success fs-2">
                        <i class="ri-money-dollar-box-line" style="font-size: 2.8rem;"></i>
                    </div>
                </div>
            </div>
        </div>

    </header>

    <main>
        <div class="d-flex align-items-end">
             <div class="mb-3 ms-auto">
                <div class="d-flex align-items-center gap-2">
                <button id="open-qgis-btn" title="Download QGIS Project" aria-label="Download QGIS Project" class="btn btn-primary w-100 w-md-auto">
                    Download
                </button>
                <button class="btn btn-outline-secondary w-100 w-md-auto" title="View QGIS Project Documentation" aria-label="View QGIS Project Documentation">
                    Documentation
                </button>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="mb-3 d-flex flex-column flex-md-row align-items-start align-items-md-center px-3 mt-3 gap-3">
                <div class="align-items-start flex-grow-1 w-100">
                    <div class="nav-item d-flex align-items-center">
                        <i class="ri-search-line ri-22px me-1_5"></i>
                        <input
                            type="text"
                            id="search-lot"
                            placeholder="Search parcel or owner..."
                            class="form-control border-0 shadow-none ps-1 ps-sm-2 ms-50"
                        >
                    </div>
                </div>
            </div>
            <div id="map" style="height: 700px; width: 100%; position: relative;"></div>
        </div>
    </main>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
.lot-label {
    font-size: 12px;
    font-weight: bold;
    color: black;
    background: rgba(255, 255, 255, 0.9);
    padding: 2px 4px;
    border: 1px solid #666;
    border-radius: 4px;
}
.legend {
    line-height: 18px;
    color: #555;
    background: white;
    padding: 6px 8px;
    border-radius: 4px;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
}
.legend i {
    width: 18px;
    height: 18px;
    float: left;
    margin-right: 8px;
    opacity: 0.7;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const forceLabel = @json(Auth::user()->role == "User");

    // Color mapping for ActualUse
    const useColor = {
        Residentials: "blue",
        Agricultural: "green",
        Commercial: "yellow",
        Industrial: "orange",
        Mineral: "brown",
        Timberland: "red",
        null: "transparent",
        "": "transparent"
    };

    // Initialize map
    const map = L.map("map", { preferCanvas: true }).setView([10.518201, 124.768402], 13);
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);

    // Function to style parcels
    function styleFeature(feature) {
        const actualUse = feature.properties.ActualUse;
        return {
            color: "gray",
            weight: 1.5,
            fillColor: actualUse in useColor ? useColor[actualUse] : "transparent",
            fillOpacity: 0.6
        };
    }

    // Main GeoJSON layer
    const parcelLayer = L.geoJSON(null, {
        style: styleFeature,
        onEachFeature: (feature, layer) => {
            const p = feature.properties;
            layer.bindPopup(`
                <b>Lot:</b> ${p.LotNumber ?? "Unknown"}<br>
                <b>Owner:</b> ${p.Owner ?? "Unknown"}<br>
                <b>Use:</b> ${p.ActualUse ?? "N/A"}
            `);

            if (forceLabel) {
                layer.bindTooltip(
                    `LOT: ${p.LotNumber}`,
                    { permanent: true, className: "lot-label", direction: "center" }
                );
            }
        }
    }).addTo(map);

    // Add legend
    const legend = L.control({ position: "bottomright" });
    legend.onAdd = function(map) {
        const div = L.DomUtil.create("div", "legend");
        div.innerHTML = "<b>Zoning Classification</b><br>";
        for (const key in useColor) {
            if (key && useColor[key] !== "transparent") {
                div.innerHTML +=
                    '<i style="background:' + useColor[key] + '"></i> ' + key + '<br>';
            }
        }
        return div;
    };
    legend.addTo(map);

    // Debounce function
    function debounce(fn, delay = 300) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => fn(...args), delay);
        };
    }

    // Load parcels
    function loadParcels() {
        const b = map.getBounds();
        const bbox = `${b.getWest()},${b.getSouth()},${b.getEast()},${b.getNorth()}`;

        fetch(`{{ route('map-gis-parcel') }}?bbox=${bbox}`)
            .then(res => res.json())
            .then(data => {
                data.features.forEach(f => {
                    if (!f.properties.ActualUse) f.properties.ActualUse = null;
                });
                parcelLayer.clearLayers();
                parcelLayer.addData(data);
            });
    }

    const loadParcelsDebounced = debounce(loadParcels, 300);
    map.on("moveend", loadParcelsDebounced);
    loadParcels();

    // Search functionality
    document.getElementById("search-lot").addEventListener("keypress", function(e){
        if (e.key !== "Enter") return;
        const val = this.value.trim();
        if (!val) return;

        fetch(`/gis-map/search?lot_number=${val}`)
            .then(res => res.json())
            .then(data => {
                data.features.forEach(f => {
                    if (!f.properties.ActualUse) f.properties.ActualUse = null;
                });

                parcelLayer.clearLayers();
                parcelLayer.addData(data);

                const group = L.featureGroup();
                parcelLayer.eachLayer(l => group.addLayer(l));
                map.fitBounds(group.getBounds(), { padding: [40,40] });
            });
    });

    const params = new URLSearchParams(window.location.search);
    const lotFromUrl = params.get("lot_number");

    if (lotFromUrl) {
        const searchInput = document.getElementById("search-lot");
        searchInput.value = lotFromUrl;
        searchAndZoom(lotFromUrl);
    }

    function searchAndZoom(val) {
        fetch(`/gis-map/search?lot_number=${encodeURIComponent(val)}`)
            .then(res => res.json())
            .then(data => {
                if (!data.features || data.features.length === 0) {
                    console.warn("No parcel found");
                    return;
                }

                parcelLayer.clearLayers();
                parcelLayer.addData(data);

                const group = L.featureGroup();
                parcelLayer.eachLayer(layer => {
                    group.addLayer(layer);
                    layer.openPopup();
                });

                map.fitBounds(group.getBounds(), { padding: [40, 40] });
            })
            .catch(err => console.error(err));
    }
});
</script>

@endsection
