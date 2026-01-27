<?php

namespace App\Http\Controllers\property;

use App\Models\Log;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PropertyController extends Controller
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
                            ->whereNull('properties.deleted_at')->orderBy('properties.created_at', 'Desc')
                            ->get();

      $totalAssessedValue = $properties
        ->where('property_status', 'Complete')
        ->sum(function ($item) {
            return $item->area * $item->market_value_data * ($item->assessment_rate / 100);
        });
      $total = $this->formatAbbreviatedPHP($totalAssessedValue);
      return view('content.property.properties-list', compact('properties', 'countall', 'countReview', 'countComplete', 'total'));
    }
    public function lazyLoad(Request $request)
    {
        $page = $request->input('page', 1);
        $search = $request->input('search');
        $perPage = 20;

        $query = Property::leftjoin('assessment', 'properties.id', '=', 'assessment.properties_id')
            ->leftjoin('assessor', 'assessment.assessor_id', '=', 'assessor.id')
            ->leftjoin('property_type', 'assessment.property_type', '=', 'property_type.id')
            ->leftjoin('market_value', 'assessment.market_id', '=', 'market_value.id')
            ->leftjoin('property_list', 'market_value.property_list', '=', 'property_list.id')
            ->select(
                'properties.*',
                'properties.address as property_address',
                'assessment.id as assessment_id',
                'market_value.value as market_value_data',
                'property_type.assessment_rate',
                'properties.status as property_status',
                'property_list.name as ActualUse',
                'properties.id as property_id'
            )
            ->whereNull('properties.deleted_at');

        // Lazy search
        if ($search) {
            $query->where('properties.lot_number', 'LIKE', "%{$search}%")
                  ->orWhere('properties.owner', 'like', "%{$search}%");
        }

        $properties = $query
            ->orderBy('properties.created_at', 'DESC')
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        return response()->json([
            'data' => $properties,
            'hasMore' => $properties->count() === $perPage
        ]);
    }
    public function store(Request $request){
      Log::insert([
        'user_id' => Auth::id(),
        'action' => 'Add',
        'table_name' => 'Property',
        'description' => 'Added a Property',
        'ip_address' => request()->ip(),
        'created_at' => now(),
      ]);
      
      $property = Property::insert([
        'users_id' => Auth::id(),
        'parcel_id' => $request->parcel_id,
        'owner' => $request->owner,
        'lot_number' => $request->lot_number,
        'address' => $request->address,
        'property_type' => $request->type,
        'status' => "Under Review",
        'area' => $request->area,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'created_at' => now(),
        'previous_owner' => $request->previous_owner,
        'brgy' => $request->brgy,
        'street' => $request->street,
        'municipality'=> "Inopacan",
        'provincial'=> "Leyte",
        'north' => $request->north,
        'south' => $request->south,
        'west' => $request->west,
        'east' => $request->east,
        'tin' => $request->tin
      ]);

      if($property){
        return response()->json(['Error' => 0, 'Message' => 'Successfully added a data']);
      }

    }
    public function update(Request $request){
      $property = Property::where('id', $request->id)->update([
        'owner' => $request->owner,
        'lot_number' => $request->lot_number,
        'address' => $request->address,
        'property_type' => $request->type,
        'area' => $request->area,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'updated_at' => now(),
        'brgy' => $request->brgy,
        'street' => $request->street,
        'north' => $request->north,
        'south' => $request->south,
        'west' => $request->west,
        'east' => $request->east,
        'previous_owner' => $request->previous_owner,
        'tin' => $request->tin
      ]);

      Log::insert([
        'user_id' => Auth::id(),
        'action' => 'Update',
        'table_name' => 'Property',
        'description' => 'Updated a Property',
        'ip_address' => request()->ip(),
        'created_at' => now(),
      ]);

      if($property){
        return response()->json(['Error' => 0, 'Message' => 'Successfully updated a data']);
      }
    }
    public function delete(Request $request){

      $property = Property::where('id', Crypt::decryptString($request->id))->update([
        'deleted_at' => now(),
      ]);

      Log::insert([
        'user_id' => Auth::id(),
        'action' => 'Delete',
        'table_name' => 'Property',
        'description' => 'Deleted a Property',
        'ip_address' => request()->ip(),
        'created_at' => now(),
      ]);

      if($property){
        return response()->json(['Error' => 0, 'Message' => 'Successfully deleted a data']);
      }
    }
}
