<?php

namespace App\Http\Controllers\property;

use App\Models\Log;
use App\Models\PropertyList;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PropertyTypeController extends Controller
{
    public function index(){
      $propertyTypes = PropertyType::leftjoin('property_list', 'property_type.property_list', '=', 'property_list.id')
                          ->whereNull('property_type.deleted_at')
                          ->select('property_type.*', 'property_list.name as type_name', 'property_list.id as list_id')
                          ->orderBy('property_type.created_at', 'Desc')->get();

      return view('content.property.properties-type', compact('propertyTypes'));
    }
    public function store(Request $request){

      Log::insert([
        'user_id' => Auth::id(),
        'action' => 'Add',
        'table_name' => 'Property Type',
        'description' => 'Added a property type',
        'ip_address' => request()->ip(),
        'created_at' => now(),
      ]);

      $list = PropertyList::create([
        'name' => $request->type,
        'created_at' => now(),
        'updated_at' => now(),
      ]);

      $data = [
        'assessment_rate' => $request->rate,
        'property_list' => $list->id,
        'created_at' => now(),
      ];

      $propertyType = PropertyType::insert($data);

      if($propertyType){
        return response()->json(['Error' => 0, 'Message' => 'Successfully added a data']);
      }

    }

    public function update(Request $request){

      Log::insert([
        'user_id' => Auth::id(),
        'action' => 'Update',
        'table_name' => 'Property Type',
        'description' => 'Updated a property type',
        'ip_address' => request()->ip(),
        'created_at' => now(),
      ]);

      $type = PropertyList::where('id', Crypt::decryptString($request->list_id))->update([
        'name' => $request->type,
        'updated_at' => now(),
      ]);

      $data = [
        'assessment_rate' => $request->rate,
        'updated_at' => now(),
      ];

      $propertyType = PropertyType::where('id', Crypt::decryptString($request->type_id))->update($data);

      if($propertyType){
        return response()->json(['Error' => 0, 'Message' => 'Successfully updated a data']);
      }

    }
}
