<?php

namespace App\Http\Controllers\Map;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use App\Models\Requests;

class MapController extends Controller
{
    private function formatAbbreviatedPHP($value) {
        $value = floatval($value);
        $absValue = abs($value);
        $formatted = '';

        if ($absValue >= 1_000_000_000) {
            $formatted = number_format($value / 1_000_000_000, 2) . 'B';
        } elseif ($absValue >= 1_000_000) {
            $formatted = number_format($value / 1_000_000, 2) . 'M';
        } elseif ($absValue >= 1_000) {
            $formatted = number_format($value / 1_000, 2) . 'K';
        } else {
            $formatted = number_format($value, 2);
        }

        return '₱' . $formatted;
    }
    public function index()
    {
        $countall = Property::count();
        $countReview = Property::where('status', '=', 'Under Review')->count();
        $countComplete = Property::where('status', '=', 'Complete')->count();


        $properties = Property::leftjoin('assessment', 'properties.id', '=', 'assessment.properties_id')
                              ->leftjoin('assessor', 'assessment.assessor_id', '=', 'assessor.id')
                              ->leftjoin('property_type', 'assessment.property_type', '=', 'property_type.id')
                              ->leftjoin('market_value', 'assessment.market_id', '=', 'market_value.id')
                              ->leftjoin('property_list', 'market_value.property_list', '=', 'property_list.id')
                              ->select('properties.*', 'properties.address as property_address', 'assessment.id as assessment_id', 'assessment.date as assessment_date', 'assessor.*', 'market_value.value as market_value_data', 'property_type.assessment_rate', 'properties.status as property_status', 'property_list.name as ActualUse', 'properties.id as property_id')
                              ->whereNull('properties.deleted_at')->orderBy('properties.created_at', 'Desc')->get();

        $totalAssessedValue = $properties
          ->where('property_status', 'Complete')
          ->sum(function ($item) {
              return $item->area * $item->market_value_data * ($item->assessment_rate / 100);
          });
        $total = $this->formatAbbreviatedPHP($totalAssessedValue);
        return view('content.map.gis', compact('countall', 'countReview', 'countComplete', 'total'));
    }

    // Lazy-loading endpoint
    public function getParcels(Request $request)
    {
        if (!$request->bbox) {
            return ['type' => 'FeatureCollection', 'features' => []];
        }

        $bbox = explode(',', $request->bbox);

        // [minLon, minLat, maxLon, maxLat]
        [$minLon, $minLat, $maxLon, $maxLat] = $bbox;

        // Load GeoJSON once
        $geojsonPath = public_path('geojson/inopacan_geojson.geojson');
        $geoData = json_decode(file_get_contents($geojsonPath), true);

        // Load DB properties as HashMap keyed by lot number
        $properties = Property::select('lot_number', 'owner')
            ->get()
            ->keyBy('lot_number');

        $filtered = [];

        foreach ($geoData['features'] as &$feature) {

            $geometry = $feature['geometry'] ?? null;
            if (!$geometry) continue;

            $coordinates = $geometry['coordinates'] ?? null;
            if (!$coordinates || !is_array($coordinates) || empty($coordinates)) continue;

            // Support Polygon or MultiPolygon
            $firstCoord = null;
            if ($geometry['type'] === 'Polygon') {
                $firstCoord = $coordinates[0][0] ?? null;
            } elseif ($geometry['type'] === 'MultiPolygon') {
                $firstCoord = $coordinates[0][0][0] ?? null;
            }

            if (!$firstCoord) continue;

            $lon = $firstCoord[0];
            $lat = $firstCoord[1];

            // Check if inside bbox
            if (
                $lon >= $minLon && $lon <= $maxLon &&
                $lat >= $minLat && $lat <= $maxLat
            ) {
                $lot = $feature['properties']['LotNumber'] ?? null;

                if ($lot && isset($properties[$lot])) {
                    $feature['properties']['Owner'] = $properties[$lot]->owner;
                }


                // Add a condition if the role is a User

                if(Auth::user()->role == "Admin" || Auth::user()->role == "Employee"){
                  $filtered[] = $feature;
                }
                else{
                  $OwnLand = Requests::leftjoin('assessment', 'assessment.id', '=', 'request.assessment_id')
                             ->leftjoin('properties', 'properties.id', '=', 'assessment.id')
                             ->where('user_id', '=', Auth::id())
                             -select('lot_number', 'owner')
                             ->get()
                             ->keyBy('lot_number');

                  if($feature['properties']['LotNumber'] == $OwnLand->lot_number){
                    $filtered[] = $feature;
                  }

                }

            }
        }


        return [
            "type" => "FeatureCollection",
            "features" => $filtered
        ];
    }
    public function searchLot(Request $request)
    {
        $lot = $request->lot_number;
        if (!$lot) {
            return response()->json(['error' => 'Lot number required'], 400);
        }

        $geojsonPath = public_path('geojson/inopacan_geojson.geojson');
        $geoData = json_decode(file_get_contents($geojsonPath), true);

        $properties = Property::select('lot_number', 'owner')
            ->get()
            ->keyBy('lot_number');

        foreach ($geoData['features'] as $feature) {
            if (($feature['properties']['LotNumber'] ?? '') == $lot) {

                if (isset($properties[$lot])) {
                    $feature['properties']['Owner'] = $properties[$lot]->owner;
                }

                return [
                    'type' => 'FeatureCollection',
                    'features' => [$feature]
                ];
            }
        }

        return [
            'type' => 'FeatureCollection',
            'features' => []
        ];
    }

}
